<?php

namespace App\Http\Controllers\SPENG;

use App\Models\M_School_Transfer_Letters;
use App\Models\RefStudentAcademicYear;
use App\Models\RefClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class SchoolTransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolTransfers = M_School_Transfer_Letters::with([
            'student.student',
            'createdby'
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.SPENG.schoolTransfers.index', compact('schoolTransfers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all classes
        $classes = RefClass::orderBy('academic_level')
            ->orderBy('name')
            ->get();

        // Generate nomor surat otomatis
        $year = now()->year;

        $lastLetter = M_School_Transfer_Letters::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastLetter) {
            $lastNumber = (int) explode('/', $lastLetter->letter_number)[0];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $letterNumber = $formattedNumber . '/AR.03.01.01/SMK-Tlg/CADISDIKWIL.IX/' . $year;


        return view('pages.SPENG.schoolTransfers.create', compact('classes', 'letterNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:ref_student_academic_years,id',
            'letter_number' => 'required|string|max:255|unique:m_school_transfer_letters,letter_number',
            'issue_date' => 'required|date',
            'destination_school' => 'required|string|max:255',
            'reason' => 'nullable|string',
        ], [
            'student_id.required' => 'Siswa harus dipilih',
            'student_id.exists' => 'Siswa tidak valid',
            'letter_number.required' => 'Nomor surat harus diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'issue_date.required' => 'Tanggal surat harus diisi',
            'destination_school.required' => 'Sekolah tujuan harus diisi',
        ]);

        try {
            M_School_Transfer_Letters::create([
                'student_id' => $validated['student_id'],
                'letter_number' => $validated['letter_number'],
                'issue_date' => $validated['issue_date'],
                'destination_school' => $validated['destination_school'],
                'reason' => $validated['reason'] ?? null,
                'created_by' => Auth::id(),
            ]);

            return redirect()
                ->route('s_peng.schoolTransfers.index')
                ->with('success', 'Surat Pindah Sekolah berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transferLetter = M_School_Transfer_Letters::with([
            'student.student',
            'student.class'
        ])->findOrFail($id);

        // Get all classes
        $classes = RefClass::orderBy('academic_level')
            ->orderBy('name')
            ->get();

        return view('pages.SPENG.schooLTransfers.edit', compact('transferLetter', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transferLetter = M_School_Transfer_Letters::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:ref_student_academic_years,id',
            'letter_number' => 'required|string|max:255|unique:m_school_transfer_letters,letter_number,' . $id,
            'issue_date' => 'required|date',
            'destination_school' => 'required|string|max:255',
            'reason' => 'nullable|string',
        ], [
            'student_id.required' => 'Siswa harus dipilih',
            'student_id.exists' => 'Siswa tidak valid',
            'letter_number.required' => 'Nomor surat harus diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'issue_date.required' => 'Tanggal surat harus diisi',
            'destination_school.required' => 'Sekolah tujuan harus diisi',
        ]);

        try {
            $transferLetter->update([
                'student_id' => $validated['student_id'],
                'letter_number' => $validated['letter_number'],
                'issue_date' => $validated['issue_date'],
                'destination_school' => $validated['destination_school'],
                'reason' => $validated['reason'] ?? null,
            ]);

            return redirect()
                ->route('su.schoolTransfers.index')
                ->with('success', 'Surat Pindah Sekolah berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $transferLetter = M_School_Transfer_Letters::findOrFail($id);
            $letterNumber = $transferLetter->letter_number;

            $transferLetter->delete();

            return redirect()
                ->route('su.schoolTransfers.index')
                ->with('success', "Surat Pindah Sekolah nomor {$letterNumber} berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Print/Preview transfer letter
     */
    public function print(string $id)
    {
        $schoolTransfers = M_School_Transfer_Letters::with([
            'student.student',
            'student.class',
            'createdby'
        ])->findOrFail($id);

        return view('preview.SPENG.schoolTransfers.print', compact('schoolTransfers'));
    }

    public function searchStudents(Request $request)
    {
        $search = $request->q;
        $classId = $request->class_id;

        $refstudents = RefStudentAcademicYear::query()
            ->when($classId, function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('student_number', 'like', "%{$search}%");
                });
            })
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'results' => $refstudents->map(function ($academicYear) {
                return [
                    'id'   => $academicYear->id,
                    'text' => trim($academicYear->student->full_name) . ' (' . $academicYear->student->student_number . ')',
                ];
            }),
            'pagination' => [
                'more' => $refstudents->hasMorePages()
            ]
        ]);
    }
}
