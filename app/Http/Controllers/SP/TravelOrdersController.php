<?php

namespace App\Http\Controllers\SP;

use App\Http\Controllers\Controller;
use App\Models\CoreEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\M_Official_Travel_Orders;
use App\Exports\PerjalananDinasExport;
use Carbon\Carbon;
use App\Models\M_Travel_Order_Participans;
use App\Models\M_Travel_Order_Followers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class TravelOrdersController extends Controller
{
    public function index()
    {
        $travelOrders = M_Official_Travel_Orders::with('employees.employee')->get();

        $travelCosts = M_Official_Travel_Orders::with([
            'employees.employee',
            'pocketMoney',
            'dailyAllowances',
            'representativeAllowance',
            'transports',
            'accommodations',
        ])
            ->where(function ($query) {
                $query->whereHas('pocketMoney')
                    ->orWhereHas('dailyAllowances')
                    ->orWhereHas('representativeAllowance')
                    ->orWhereHas('transports')
                    ->orWhereHas('accommodations');
            })
            ->get();

        return view('pages.SP.travelOrders.index', compact('travelOrders', 'travelCosts'));
    }

    public function search(Request $request)
    {
        $search = $request->q;

        $employees = CoreEmployee::query()
            ->when($search, function ($query) use ($search) {
                $query->search($search);
            })
            ->select('id', 'full_name', 'nip', 'pns_position', 'functional_position', 'job_name')
            ->orderBy('full_name')
            ->paginate(10);

        return response()->json([
            'results' => $employees->map(function ($employee) {
                $jabatan = $employee->pns_position ?: ($employee->functional_position ?: ($employee->job_name ?: ''));
                $text = trim($employee->full_name);
                if ($employee->nip) {
                    $text .= ' (NIP: ' . $employee->nip . ')';
                } elseif ($jabatan) {
                    $text .= ' (' . $jabatan . ')';
                }
                return [
                    'id'   => $employee->id,
                    'text' => $text,
                    'name' => trim($employee->full_name),
                ];
            }),
            'pagination' => [
                'more' => $employees->hasMorePages()
            ]
        ]);
    }

    public function create()
    {
        $year = now()->year;

        $lastLetter = M_Official_Travel_Orders::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastLetter) {
            $lastNumber = (int) explode('/', $lastLetter->letter_number)[0];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $letterNumber    = $formattedNumber . '/KPG.11.01/SMKN1Tlg/CADISDIKWIL.IX/' . $year;

        return view('pages.SP.travelOrders.create', compact('letterNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_number'    => 'required|string|max:255|unique:m_official_travel_orders,letter_number',
            'petugas_id'       => 'required|array|min:1',
            'petugas_id.*'     => 'required|exists:core_employees,id',
            'petugas_positions' => 'nullable|array',
            'pengikut_ids'     => 'nullable|array',
            'pengikut_ids.*'   => 'exists:core_employees,id',
            'base'             => 'required|string|max:500',
            'purpose'          => 'required|string|max:255',
            'departure_from'   => 'required|string|max:255',
            'departure_place'  => 'required|string|max:255',
            'departure_to'     => 'required|string|max:255',
            'departure_date'   => 'required|date',
            'departure_time'   => 'nullable',
            'return_date'      => 'required|date|after_or_equal:departure_date',
            'duration_days'    => 'required|string|max:100',
            'budget_resources' => 'nullable|string|max:255',
            'acc'              => 'nullable|string|max:100',
            'code'             => 'nullable|string|max:100',
            'issue_date'       => 'required|date',
        ], [
            'letter_number.required'          => 'Nomor surat wajib diisi',
            'letter_number.unique'            => 'Nomor surat sudah digunakan',
            'petugas_id.required'             => 'Minimal satu petugas harus dipilih',
            'petugas_id.min'                  => 'Minimal satu petugas harus dipilih',
            'petugas_id.*.exists'             => 'Petugas yang dipilih tidak valid',
            'pengikut_ids.*.exists'           => 'Pengikut yang dipilih tidak valid',
            'base.required'                   => 'Dasar surat perintah wajib diisi',
            'purpose.required'                => 'Tujuan penugasan wajib diisi',
            'departure_from.required'         => 'Tempat surat dikeluarkan wajib diisi',
            'departure_place.required'        => 'Tempat keberangkatan wajib diisi',
            'departure_to.required'           => 'Tempat tujuan wajib diisi',
            'departure_date.required'         => 'Tanggal keberangkatan wajib diisi',
            'return_date.required'            => 'Tanggal kembali wajib diisi',
            'return_date.after_or_equal'      => 'Tanggal kembali harus setelah atau sama dengan tanggal keberangkatan',
            'duration_days.required'          => 'Lama perjalanan dinas wajib diisi',
            'issue_date.required'             => 'Tanggal surat dikeluarkan wajib diisi',
        ]);

        DB::beginTransaction();

        // Cari kepala sekolah aktif yang memiliki NIP
        $headmaster = User::whereHas('roles', function ($query) {
                $query->where('name', 'Kepala Sekolah')
                    ->orWhere('code', 'kepala-sekolah');
            })
            ->whereHas('employee', function ($query) {
                $query->whereNotNull('nip')->where('nip', '!=', '');
            })
            ->first();

        if (!$headmaster) {
            $headmaster = User::whereHas('roles', function ($query) {
                $query->where('name', 'Kepala Sekolah')
                    ->orWhere('code', 'kepala-sekolah');
            })->first();
        }

        try {
            $travelOrder = M_Official_Travel_Orders::create([
                'headmaster_id'   => $headmaster?->id,
                'letter_number'   => $validated['letter_number'],
                'base'            => $request->base,
                'purpose'         => $request->purpose,
                'departure_from'  => $request->departure_from,
                'departure_place' => $request->departure_place,
                'departure_to'    => $request->departure_to,
                'departure_date'  => $request->departure_date,
                'departure_time'  => $request->departure_time,
                'return_date'     => $request->return_date,
                'duration_days'   => $request->duration_days,
                'issue_date'      => $request->issue_date,
                'budget_resource' => $request->budget_resources,
                'code'            => $request->code,
                'acc'             => $request->acc,
                'created_by'      => Auth::id(),
            ]);

            foreach ($validated['petugas_id'] as $petugasId) {
                $position = $request->input("petugas_positions.{$petugasId}");
                M_Travel_Order_Participans::create([
                    'travel_order_id' => $travelOrder->id,
                    'employee_id'     => $petugasId,
                    'position'        => $position,
                ]);
            }

            if (!empty($request->pengikut_ids)) {
                foreach ($request->pengikut_ids as $pengikutId) {
                    M_Travel_Order_Followers::create([
                        'travel_order_id' => $travelOrder->id,
                        'follower_id'     => $pengikutId,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.preview', $travelOrder->id)
                ->with('success', 'Data Surat Perintah Perjalanan Dinas berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $travelOrder = M_Official_Travel_Orders::with(['employees.employee', 'followers.follower'])
            ->findOrFail($id);

        $selectedPetugas = $travelOrder->employees->pluck('employee_id')->toArray();
        $selectedPengikut = $travelOrder->followers->pluck('follower_id')->toArray();

        $petugasData = CoreEmployee::whereIn('id', $selectedPetugas)->select('id', 'full_name', 'nip')->get();
        $pengikutData = CoreEmployee::whereIn('id', $selectedPengikut)->select('id', 'full_name', 'nip')->get();

        // Siapkan map posisi jabatan yang tersimpan
        $petugasPositions = $travelOrder->employees->pluck('position', 'employee_id')->toArray();

        return view('pages.SP.travelOrders.edit', compact(
            'travelOrder',
            'selectedPetugas',
            'selectedPengikut',
            'petugasData',
            'pengikutData',
            'petugasPositions'
        ));
    }

    public function update(Request $request, $id)
    {
        $travelOrder = M_Official_Travel_Orders::findOrFail($id);

        $validated = $request->validate([
            'letter_number'    => 'required|string|max:255|unique:m_official_travel_orders,letter_number,' . $id,
            'petugas_id'       => 'required|array|min:1',
            'petugas_id.*'     => 'required|exists:core_employees,id',
            'petugas_positions' => 'nullable|array',
            'pengikut_ids'     => 'nullable|array',
            'pengikut_ids.*'   => 'exists:core_employees,id',
            'base'             => 'required|string|max:500',
            'purpose'          => 'required|string|max:255',
            'departure_from'   => 'required|string|max:255',
            'departure_place'  => 'required|string|max:255',
            'departure_to'     => 'required|string|max:255',
            'departure_date'   => 'required|date',
            'departure_time'   => 'nullable',
            'return_date'      => 'required|date|after_or_equal:departure_date',
            'duration_days'    => 'required|string|max:100',
            'budget_resources' => 'nullable|string|max:255',
            'acc'              => 'nullable|string|max:100',
            'code'             => 'nullable|string|max:100',
            'issue_date'       => 'required|date',
        ], [
            'letter_number.required'      => 'Nomor surat wajib diisi',
            'letter_number.unique'        => 'Nomor surat sudah digunakan',
            'petugas_id.required'         => 'Minimal satu petugas harus dipilih',
            'petugas_id.min'              => 'Minimal satu petugas harus dipilih',
            'petugas_id.*.exists'         => 'Petugas yang dipilih tidak valid',
            'pengikut_ids.*.exists'       => 'Pengikut yang dipilih tidak valid',
            'base.required'               => 'Dasar surat perintah wajib diisi',
            'purpose.required'            => 'Tujuan penugasan wajib diisi',
            'departure_from.required'     => 'Tempat surat dikeluarkan wajib diisi',
            'departure_place.required'    => 'Tempat keberangkatan wajib diisi',
            'departure_to.required'       => 'Tempat tujuan wajib diisi',
            'departure_date.required'     => 'Tanggal keberangkatan wajib diisi',
            'return_date.required'        => 'Tanggal kembali wajib diisi',
            'return_date.after_or_equal'  => 'Tanggal kembali harus setelah atau sama dengan tanggal keberangkatan',
            'duration_days.required'      => 'Lama perjalanan dinas wajib diisi',
            'issue_date.required'         => 'Tanggal surat dikeluarkan wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            // Update headmaster bila saat ini belum ber-NIP
            $headmaster = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Kepala Sekolah')
                        ->orWhere('code', 'kepala-sekolah');
                })
                ->whereHas('employee', function ($query) {
                    $query->whereNotNull('nip')->where('nip', '!=', '');
                })
                ->first();

            $updateData = [
                'letter_number'   => $validated['letter_number'],
                'base'            => $request->base,
                'purpose'         => $request->purpose,
                'departure_from'  => $request->departure_from,
                'departure_place' => $request->departure_place,
                'departure_to'    => $request->departure_to,
                'departure_date'  => $request->departure_date,
                'departure_time'  => $request->departure_time,
                'return_date'     => $request->return_date,
                'duration_days'   => $request->duration_days,
                'issue_date'      => $request->issue_date,
                'budget_resource' => $request->budget_resources,
                'code'            => $request->code,
                'acc'             => $request->acc,
            ];

            if ($headmaster) {
                $updateData['headmaster_id'] = $headmaster->id;
            }

            $travelOrder->update($updateData);

            M_Travel_Order_Participans::where('travel_order_id', $travelOrder->id)->delete();
            foreach ($validated['petugas_id'] as $petugasId) {
                $position = $request->input("petugas_positions.{$petugasId}");
                M_Travel_Order_Participans::create([
                    'travel_order_id' => $travelOrder->id,
                    'employee_id'     => $petugasId,
                    'position'        => $position,
                ]);
            }

            M_Travel_Order_Followers::where('travel_order_id', $travelOrder->id)->delete();
            if (!empty($request->pengikut_ids)) {
                foreach ($request->pengikut_ids as $pengikutId) {
                    M_Travel_Order_Followers::create([
                        'travel_order_id' => $travelOrder->id,
                        'follower_id'     => $pengikutId,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data Surat Perintah Perjalanan Dinas berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $travelOrder = M_Official_Travel_Orders::findOrFail($id);

            M_Travel_Order_Participans::where('travel_order_id', $id)->delete();
            M_Travel_Order_Followers::where('travel_order_id', $id)->delete();
            $travelOrder->delete();

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data Surat Perintah Perjalanan Dinas berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function incrementDownload($id)
    {
        $travelOrder = M_Official_Travel_Orders::findOrFail($id);
        $travelOrder->increment('download_count');

        return response()->json([
            'success'        => true,
            'download_count' => $travelOrder->download_count,
            'message'        => 'Download count updated'
        ]);
    }

    public function preview($id)
    {
        $travelOrder = M_Official_Travel_Orders::with([
            'employees.employee',
            'followers.follower',
            'headmaster.employee'
        ])->findOrFail($id);

        return view('preview.SP.travelOrder.print', compact('travelOrder'));
    }
    // ================================================================
    // EXPORT EXCEL - Rekap Perjadin berdasarkan rentang tanggal
    // ================================================================

    /**
     * Export rekap perjalanan dinas ke Excel sesuai format template
     * Route: GET /sp/travelOrders/export-excel
     */
    public function exportExcel(Request $request)
    {
        $request->validate([
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
        ], [
            'date_from.required'     => 'Tanggal mulai wajib diisi',
            'date_from.date'         => 'Format tanggal mulai tidak valid',
            'date_to.required'       => 'Tanggal akhir wajib diisi',
            'date_to.date'           => 'Format tanggal akhir tidak valid',
            'date_to.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal mulai',
        ]);

        $dateFrom = Carbon::parse($request->date_from)->startOfDay();
        $dateTo   = Carbon::parse($request->date_to)->endOfDay();

        $travelOrders = M_Official_Travel_Orders::with([
            'employees.employee',
            'dailyAllowances',
            'accommodations',
            'transports.category',
            'representativeAllowance',
        ])
            ->whereBetween('departure_date', [$dateFrom, $dateTo])
            ->orderBy('departure_date', 'asc')
            ->get();

        $filename = 'Rekap_Perjadin_'
            . $dateFrom->format('dmY')
            . '_sd_'
            . $dateTo->format('dmY')
            . '.xlsx';

        return Excel::download(
            new PerjalananDinasExport($travelOrders, $dateFrom->format('d/m/Y'), $dateTo->format('d/m/Y')),
            $filename
        );
    }
}
