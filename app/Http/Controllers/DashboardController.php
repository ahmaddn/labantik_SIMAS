<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Admission_Letters;
use App\Models\M_Cover_Letters;
use App\Models\M_Data_Correction_Letters;
use App\Models\M_General_Letters;
use App\Models\M_Good_Conduct_Letters;
use App\Models\M_Official_Travel_Orders;
use App\Models\M_Parent_Invitation_Letters;
use App\Models\M_School_Transfer_Letters;
use App\Models\M_Student_Return_Letters;

class DashboardController extends Controller
{
    public function index()
    {
        $letterStats = [
            [
                'name' => 'Surat Penerimaan',
                'count' => M_Admission_Letters::count(),
                'download_count' => M_Admission_Letters::sum('download_count'),
                'route' => route('sk.admissionLetters.create'),
                'icon' => 'approval',
                'color' => 'primary'
            ],
            [
                'name' => 'Surat Pengantar',
                'count' => M_Cover_Letters::count(),
                'download_count' => M_Cover_Letters::sum('download_count'),
                'route' => route('s_peng.coverLetters.create'),
                'icon' => 'mail',
                'color' => 'info'
            ],
            [
                'name' => 'Surat Koreksi Data',
                'count' => M_Data_Correction_Letters::count(),
                'download_count' => M_Data_Correction_Letters::sum('download_count'),
                'route' => route('sk.dataCorrections.create'),
                'icon' => 'edit_note',
                'color' => 'warning'
            ],
            [
                'name' => 'Surat Umum',
                'count' => M_General_Letters::count(),
                'download_count' => M_General_Letters::sum('download_count'),
                'route' => route('sk.generalLetters.create'),
                'icon' => 'description',
                'color' => 'success'
            ],
            [
                'name' => 'Surat Kelakuan Baik',
                'count' => M_Good_Conduct_Letters::count(),
                'download_count' => M_Good_Conduct_Letters::sum('download_count'),
                'route' => route('sk.goodConducts.create'),
                'icon' => 'verified',
                'color' => 'primary-50'
            ],
            [
                'name' => 'Surat Perjalanan Dinas',
                'count' => M_Official_Travel_Orders::count(),
                'download_count' => M_Official_Travel_Orders::sum('download_count'),
                'route' => route('sp.travelOrders.create'),
                'icon' => 'flight',
                'color' => 'danger'
            ],
            [
                'name' => 'Surat Undangan Orang Tua',
                'count' => M_Parent_Invitation_Letters::count(),
                'download_count' => M_Parent_Invitation_Letters::sum('download_count'),
                'route' => route('su.parentInvitations.create'),
                'icon' => 'groups',
                'color' => 'info'
            ],
            [
                'name' => 'Surat Pindah Sekolah',
                'count' => M_School_Transfer_Letters::count(),
                'download_count' => M_School_Transfer_Letters::sum('download_count'),
                'route' => route('s_peng.schoolTransfers.create'),
                'icon' => 'school',
                'color' => 'warning'
            ],
            [
                'name' => 'Surat Kembali Siswa',
                'count' => M_Student_Return_Letters::count(),
                'download_count' => M_Student_Return_Letters::sum('download_count'),
                'route' => route('others.studentReturns.create'),
                'icon' => 'person_check',
                'color' => 'success-60'
            ]
        ];

        return view('dashboard', compact('letterStats'));
    }
}
