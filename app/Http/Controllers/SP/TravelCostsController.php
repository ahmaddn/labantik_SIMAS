<?php

namespace App\Http\Controllers\SP;

use App\Http\Controllers\Controller;
use App\Models\M_Official_Travel_Orders;
use App\Models\M_TravelCostCategory;
use App\Models\M_TravelDailyAllowance;
use App\Models\M_TravelPocketMoney;
use App\Models\M_TravelAccommodation;
use App\Models\M_TravelTransport;
use App\Models\M_TravelRepresentativeAllowance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TravelCostsController extends Controller
{
    /**
     * Tampilkan form tambah biaya — menerima travel_order_id dari tombol di index
     */

    public function create($travelOrderId)
    {
        $travelOrder = M_Official_Travel_Orders::with(['employees.employee'])
            ->findOrFail($travelOrderId);

        $accommodationCategories = M_TravelCostCategory::accommodation()->active()->ordered()->get();
        $transportCategories     = M_TravelCostCategory::transport()->active()->ordered()->get();

        // Ambil user bendahara dari role
        $treasurers = User::withRole('Bendahara')->with('employee')->get();

        // Ambil kepala sekolah otomatis dari role
        $headmaster = User::withRole('Kepala sekolah')->first();

        // Simpan headmaster_id otomatis ke travel order jika belum ada
        if ($headmaster && !$travelOrder->headmaster_id) {
            $travelOrder->update(['headmaster_id' => $headmaster->id]);
        }

        return view('pages.SP.travelOrders.create-cost', compact(
            'travelOrder',
            'accommodationCategories',
            'transportCategories',
            'treasurers',
            'headmaster',
        ));
    }


    /**
     * Simpan semua data biaya perjalanan dinas
     */
    public function store(Request $request)
    {
        $request->validate([
            'travel_order_id' => 'required|exists:m_official_travel_orders,id',
            'treasurer_id'    => 'required|exists:core_users,id',
            'daily'                            => 'nullable|array',
            'daily.*.employee_name'            => 'nullable|string|max:255',
            'daily.*.amount_per_day'           => 'nullable|numeric|min:0',
            'daily.*.days'                     => 'nullable|integer|min:1',
            'daily.*.total_amount'             => 'nullable|numeric|min:0',
            'pocket_money.amount'              => 'nullable|numeric|min:0',
            'pocket_money.note'                => 'nullable|string|max:255',
            'accommodations'                   => 'nullable|array',
            'accommodations.*.category_id'     => 'nullable|exists:m_travel_cost_categories,id',
            'accommodations.*.hotel_name'      => 'nullable|string|max:255',
            'accommodations.*.price_per_night' => 'nullable|numeric|min:0',
            'accommodations.*.duration_nights' => 'nullable|integer|min:1',
            'accommodations.*.total_amount'    => 'nullable|numeric|min:0',
            'transports'                       => 'nullable|array',
            'transports.*.category_id'         => 'nullable|exists:m_travel_cost_categories,id',
            'transports.*.amount'              => 'nullable|numeric|min:0',
            'transports.*.airline_name'        => 'nullable|string|max:255',
            'transports.*.booking_code'        => 'nullable|string|max:255',
            'transports.*.ticket_number'       => 'nullable|string|max:255',
            'transports.*.note'                => 'nullable|string|max:255',
            'representative.amount'            => 'nullable|numeric|min:0',
            'representative.note'              => 'nullable|string|max:255',
        ], [
            'travel_order_id.required' => 'Surat Perintah wajib dipilih',
            'travel_order_id.exists'   => 'Surat Perintah tidak valid',
        ]);

        DB::beginTransaction();
        try {
            $travelOrderId = $request->travel_order_id;

            // Simpan treasurer_id ke travel order
            $travelOrder = M_Official_Travel_Orders::findOrFail($travelOrderId);
            $travelOrder->update(['treasurer_id' => $request->treasurer_id]);

            // 1. Uang Harian
            if ($request->filled('daily')) {
                foreach ($request->daily as $row) {
                    if (empty($row['employee_name']) && empty($row['amount_per_day'])) continue;
                    M_TravelDailyAllowance::create([
                        'travel_order_id' => $travelOrderId,
                        'employee_name'   => $row['employee_name']  ?? null,
                        'amount_per_day'  => $row['amount_per_day'] ?? null,
                        'days'            => $row['days']           ?? null,
                        'total_amount'    => $row['total_amount']   ?? null,
                    ]);
                }
            }

            // 2. Uang Saku
            if ($request->filled('pocket_money.amount')) {
                M_TravelPocketMoney::create([
                    'travel_order_id' => $travelOrderId,
                    'amount'          => $request->input('pocket_money.amount'),
                    'note'            => $request->input('pocket_money.note'),
                ]);
            }

            // 3. Penginapan
            if ($request->filled('accommodations')) {
                foreach ($request->accommodations as $row) {
                    if (empty($row['hotel_name']) && empty($row['price_per_night'])) continue;
                    M_TravelAccommodation::create([
                        'travel_order_id' => $travelOrderId,
                        'category_id'     => $row['category_id']    ?? null,
                        'hotel_name'      => $row['hotel_name']      ?? null,
                        'price_per_night' => $row['price_per_night'] ?? null,
                        'duration_nights' => $row['duration_nights'] ?? null,
                        'total_amount'    => $row['total_amount']    ?? null,
                    ]);
                }
            }

            // 4. Transport
            if ($request->filled('transports')) {
                foreach ($request->transports as $row) {
                    if (empty($row['category_id']) && empty($row['amount'])) continue;
                    M_TravelTransport::create([
                        'travel_order_id' => $travelOrderId,
                        'category_id'     => $row['category_id']  ?? null,
                        'amount'          => $row['amount']        ?? null,
                        'airline_name'    => $row['airline_name']  ?? null,
                        'booking_code'    => $row['booking_code']  ?? null,
                        'ticket_number'   => $row['ticket_number'] ?? null,
                        'note'            => $row['note']          ?? null,
                    ]);
                }
            }

            // 5. Uang Representatif
            if ($request->filled('representative.amount')) {
                M_TravelRepresentativeAllowance::create([
                    'travel_order_id' => $travelOrderId,
                    'amount'          => $request->input('representative.amount'),
                    'note'            => $request->input('representative.note'),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data biaya perjalanan dinas berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form edit biaya untuk satu travel order
     */
    public function edit($travelOrderId)
    {
        $travelOrder = M_Official_Travel_Orders::with([
            'employees.employee',
            'dailyAllowances',
            'pocketMoney',
            'accommodations.category',
            'transports.category',
            'representativeAllowance',
            'treasurer',
            'headmaster',
        ])->findOrFail($travelOrderId);

        $accommodationCategories = M_TravelCostCategory::accommodation()->active()->ordered()->get();
        $transportCategories     = M_TravelCostCategory::transport()->active()->ordered()->get();

        $treasurers = User::withRole('bendahara')->with('employee')->get();
        $headmaster = User::withRole('kepala sekolah')->first();

        return view('pages.SP.travelOrders.edit-cost', compact(
            'travelOrder',
            'accommodationCategories',
            'transportCategories',
            'treasurers',
            'headmaster',
        ));
    }

    /**
     * Update semua data biaya — hapus data lama lalu simpan ulang
     */
    public function update(Request $request, $travelOrderId)
    {
        M_Official_Travel_Orders::findOrFail($travelOrderId);

        $request->validate([
            'treasurer_id' => 'required|exists:core_users,id',
            'daily'                            => 'nullable|array',
            'daily.*.employee_name'            => 'nullable|string|max:255',
            'daily.*.amount_per_day'           => 'nullable|numeric|min:0',
            'daily.*.days'                     => 'nullable|integer|min:1',
            'daily.*.total_amount'             => 'nullable|numeric|min:0',
            'pocket_money.amount'              => 'nullable|numeric|min:0',
            'pocket_money.note'                => 'nullable|string|max:255',
            'accommodations'                   => 'nullable|array',
            'accommodations.*.category_id'     => 'nullable|exists:m_travel_cost_categories,id',
            'accommodations.*.hotel_name'      => 'nullable|string|max:255',
            'accommodations.*.price_per_night' => 'nullable|numeric|min:0',
            'accommodations.*.duration_nights' => 'nullable|integer|min:1',
            'accommodations.*.total_amount'    => 'nullable|numeric|min:0',
            'transports'                       => 'nullable|array',
            'transports.*.category_id'         => 'nullable|exists:m_travel_cost_categories,id',
            'transports.*.amount'              => 'nullable|numeric|min:0',
            'transports.*.airline_name'        => 'nullable|string|max:255',
            'transports.*.booking_code'        => 'nullable|string|max:255',
            'transports.*.ticket_number'       => 'nullable|string|max:255',
            'transports.*.note'                => 'nullable|string|max:255',
            'representative.amount'            => 'nullable|numeric|min:0',
            'representative.note'              => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $travelOrder = M_Official_Travel_Orders::findOrFail($travelOrderId);
            $travelOrder->update(['treasurer_id' => $request->treasurer_id]);
            // Hapus semua data biaya lama
            M_TravelDailyAllowance::where('travel_order_id', $travelOrderId)->delete();
            M_TravelPocketMoney::where('travel_order_id', $travelOrderId)->delete();
            M_TravelAccommodation::where('travel_order_id', $travelOrderId)->delete();
            M_TravelTransport::where('travel_order_id', $travelOrderId)->delete();
            M_TravelRepresentativeAllowance::where('travel_order_id', $travelOrderId)->delete();

            // 1. Uang Harian
            if ($request->filled('daily')) {
                foreach ($request->daily as $row) {
                    if (empty($row['employee_name']) && empty($row['amount_per_day'])) continue;
                    M_TravelDailyAllowance::create([
                        'travel_order_id' => $travelOrderId,
                        'employee_name'   => $row['employee_name']  ?? null,
                        'amount_per_day'  => $row['amount_per_day'] ?? null,
                        'days'            => $row['days']           ?? null,
                        'total_amount'    => $row['total_amount']   ?? null,
                    ]);
                }
            }

            // 2. Uang Saku
            if ($request->filled('pocket_money.amount')) {
                M_TravelPocketMoney::create([
                    'travel_order_id' => $travelOrderId,
                    'amount'          => $request->input('pocket_money.amount'),
                    'note'            => $request->input('pocket_money.note'),
                ]);
            }

            // 3. Penginapan
            if ($request->filled('accommodations')) {
                foreach ($request->accommodations as $row) {
                    if (empty($row['hotel_name']) && empty($row['price_per_night'])) continue;
                    M_TravelAccommodation::create([
                        'travel_order_id' => $travelOrderId,
                        'category_id'     => $row['category_id']    ?? null,
                        'hotel_name'      => $row['hotel_name']      ?? null,
                        'price_per_night' => $row['price_per_night'] ?? null,
                        'duration_nights' => $row['duration_nights'] ?? null,
                        'total_amount'    => $row['total_amount']    ?? null,
                    ]);
                }
            }

            // 4. Transport
            if ($request->filled('transports')) {
                foreach ($request->transports as $row) {
                    if (empty($row['category_id']) && empty($row['amount'])) continue;
                    M_TravelTransport::create([
                        'travel_order_id' => $travelOrderId,
                        'category_id'     => $row['category_id']  ?? null,
                        'amount'          => $row['amount']        ?? null,
                        'airline_name'    => $row['airline_name']  ?? null,
                        'booking_code'    => $row['booking_code']  ?? null,
                        'ticket_number'   => $row['ticket_number'] ?? null,
                        'note'            => $row['note']          ?? null,
                    ]);
                }
            }

            // 5. Uang Representatif
            if ($request->filled('representative.amount')) {
                M_TravelRepresentativeAllowance::create([
                    'travel_order_id' => $travelOrderId,
                    'amount'          => $request->input('representative.amount'),
                    'note'            => $request->input('representative.note'),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data biaya perjalanan dinas berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus semua biaya untuk satu travel order
     */
    public function destroy($travelOrderId)
    {
        DB::beginTransaction();

        try {
            M_TravelDailyAllowance::where('travel_order_id', $travelOrderId)->delete();
            M_TravelPocketMoney::where('travel_order_id', $travelOrderId)->delete();
            M_TravelAccommodation::where('travel_order_id', $travelOrderId)->delete();
            M_TravelTransport::where('travel_order_id', $travelOrderId)->delete();
            M_TravelRepresentativeAllowance::where('travel_order_id', $travelOrderId)->delete();

            DB::commit();

            return redirect()
                ->route('sp.travelOrders.index')
                ->with('success', 'Data biaya perjalanan dinas berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function preview($travelOrderId)
    {
        $travelOrder = M_Official_Travel_Orders::with([
            'headmaster.employee',
            'employees.employee',
            'treasurer.employee',   // tambah ini
            'dailyAllowances',
            'pocketMoney',
            'accommodations.category',
            'transports.category',
            'representativeAllowance',
        ])->findOrFail($travelOrderId);

        return view('preview.SP.travelOrder.travelCost.print', compact('travelOrder'));
    }
}
