<?php

namespace App\Http\Controllers\SP;

use App\Http\Controllers\Controller;
use App\Models\CoreEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\M_Official_Travel_Orders;
use Carbon\Carbon;
use App\Models\M_Travel_Order_Participans;
use App\Models\M_Travel_Order_Followers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class TravelOrdersController extends Controller
{
    public function index()
    {
        $travelOrders = M_Official_Travel_Orders::with('employees.employee')->get();
        return view('pages.SP.travelOrders.index', compact('travelOrders'));
    }

    public function search(Request $request)
    {
        $search = $request->q;

        $employees = CoreEmployee::query()
            ->when($search, function ($query) use ($search) {
                $query->search($search);
            })
            ->select('id', 'full_name', 'nip')
            ->orderBy('full_name')
            ->paginate(10);

        return response()->json([
            'results' => $employees->map(function ($employee) {
                return [
                    'id'   => $employee->id,
                    'text' => trim($employee->full_name),
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

        $letterNumber = $formattedNumber . '/KPG.11.01/SMKN1Tlg/CADISDIKWIL.IX/' . $year;

        return view('pages.SP.travelOrders.create', compact('letterNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'letter_number' => 'required|string|max:255|unique:m_official_travel_orders,letter_number',
            'petugas_id' => 'required|array|min:1',
            'petugas_id.*' => 'required|exists:core_employees,id',
            'pengikut_ids' => 'nullable|array',
            'pengikut_ids.*' => 'exists:core_employees,id',
            'purpose' => 'nullable|string|max:255',
            'departure_from' => 'nullable|string|max:255',
            'departure_place' => 'nullable|string|max:255',
            'departure_to' => 'nullable|string|max:255',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'duration_days' => 'nullable|string|max:100',
            'budget_resources' => 'nullable|string|max:255',
            'acc' => 'nullable|string|max:100',
            'code' => 'nullable|string|max:100',
            'issue_date' => 'nullable|date',
        ], [
            'letter_number.required' => 'Nomor surat wajib diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'petugas_id.required' => 'Minimal satu petugas harus dipilih',
            'petugas_id.min' => 'Minimal satu petugas harus dipilih',
            'petugas_id.*.exists' => 'Petugas yang dipilih tidak valid',
            'pengikut_ids.*.exists' => 'Pengikut yang dipilih tidak valid',
            'return_date.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal keberangkatan',
        ]);

        DB::beginTransaction();

        try {
            $travelOrder = M_Official_Travel_Orders::create([
                'headmaster_id' => Auth::id(),
                'letter_number' => $validated['letter_number'],
                'purpose' => $request->purpose,
                'departure_from' => $request->departure_from,
                'departure_place' => $request->departure_place,
                'departure_to' => $request->departure_to,
                'departure_date' => $request->departure_date,
                'return_date' => $request->return_date,
                'duration_days' => $request->duration_days,
                'issue_date' => $request->issue_date,
                'budget_resource' => $request->budget_resources,
                'code' => $request->code,
                'acc' => $request->acc,
                'created_by' => Auth::id(),
            ]);

            foreach ($validated['petugas_id'] as $petugasId) {
                M_Travel_Order_Participans::create([
                    'travel_order_id' => $travelOrder->id,
                    'employee_id' => $petugasId,
                ]);
            }

            if (!empty($request->pengikut_ids)) {
                foreach ($request->pengikut_ids as $pengikutId) {
                    M_Travel_Order_Followers::create([
                        'travel_order_id' => $travelOrder->id,
                        'follower_id' => $pengikutId,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data Surat Perintah Perjalanan Dinas berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $travelOrder = M_Official_Travel_Orders::with(['employees.employee', 'followers.follower'])
            ->findOrFail($id);

        // Get selected petugas IDs
        $selectedPetugas = $travelOrder->employees->pluck('employee_id')->toArray();

        // Get selected pengikut IDs
        $selectedPengikut = $travelOrder->followers->pluck('follower_id')->toArray();

        // Get employee details for pre-selected options
        $petugasData = CoreEmployee::whereIn('id', $selectedPetugas)
            ->select('id', 'full_name')
            ->get();

        $pengikutData = CoreEmployee::whereIn('id', $selectedPengikut)
            ->select('id', 'full_name')
            ->get();

        return view('pages.SP.travelOrders.edit', compact(
            'travelOrder',
            'selectedPetugas',
            'selectedPengikut',
            'petugasData',
            'pengikutData'
        ));
    }

    public function update(Request $request, $id)
    {
        $travelOrder = M_Official_Travel_Orders::findOrFail($id);

        $validated = $request->validate([
            'letter_number' => 'required|string|max:255|unique:m_official_travel_orders,letter_number,' . $id,
            'petugas_id' => 'required|array|min:1',
            'petugas_id.*' => 'required|exists:core_employees,id',
            'pengikut_ids' => 'nullable|array',
            'pengikut_ids.*' => 'exists:core_employees,id',
            'purpose' => 'nullable|string|max:255',
            'departure_from' => 'nullable|string|max:255',
            'departure_place' => 'nullable|string|max:255',
            'departure_to' => 'nullable|string|max:255',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'duration_days' => 'nullable|string|max:100',
            'budget_resources' => 'nullable|string|max:255',
            'acc' => 'nullable|string|max:100',
            'code' => 'nullable|string|max:100',
            'issue_date' => 'nullable|date',
        ], [
            'letter_number.required' => 'Nomor surat wajib diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'petugas_id.required' => 'Minimal satu petugas harus dipilih',
            'petugas_id.min' => 'Minimal satu petugas harus dipilih',
            'petugas_id.*.exists' => 'Petugas yang dipilih tidak valid',
            'pengikut_ids.*.exists' => 'Pengikut yang dipilih tidak valid',
            'return_date.after_or_equal' => 'Tanggal kembali harus setelah atau sama dengan tanggal keberangkatan',
        ]);

        DB::beginTransaction();

        try {
            // Update travel order
            $travelOrder->update([
                'letter_number' => $validated['letter_number'],
                'purpose' => $request->purpose,
                'departure_from' => $request->departure_from,
                'departure_place' => $request->departure_place,
                'departure_to' => $request->departure_to,
                'departure_date' => $request->departure_date,
                'return_date' => $request->return_date,
                'duration_days' => $request->duration_days,
                'issue_date' => $request->issue_date,
                'budget_resource' => $request->budget_resource,
                'code' => $request->code,
                'acc' => $request->acc,
            ]);

            // Delete existing participants and insert new ones
            M_Travel_Order_Participans::where('travel_order_id', $travelOrder->id)->delete();

            foreach ($validated['petugas_id'] as $petugasId) {
                M_Travel_Order_Participans::create([
                    'travel_order_id' => $travelOrder->id,
                    'employee_id' => $petugasId,
                ]);
            }

            // Delete existing followers and insert new ones
            M_Travel_Order_Followers::where('travel_order_id', $travelOrder->id)->delete();

            if (!empty($request->pengikut_ids)) {
                foreach ($request->pengikut_ids as $pengikutId) {
                    M_Travel_Order_Followers::create([
                        'travel_order_id' => $travelOrder->id,
                        'follower_id' => $pengikutId,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data Surat Perintah Perjalanan Dinas berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
