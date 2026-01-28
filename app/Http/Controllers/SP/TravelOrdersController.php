<?php

namespace App\Http\Controllers\SP;

use App\Http\Controllers\Controller;
use App\Models\CoreEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\M_Official_Travel_Orders;
use Carbon\Carbon;

class TravelOrdersController extends Controller
{
    public function index()
    {
        return view('pages.SP.travelOrders.index');
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


    public function edit()
    {
        return view('pages.SP.travelOrders.edit');
    }
}
