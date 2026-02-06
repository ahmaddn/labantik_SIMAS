<?php

namespace App\Http\Controllers\SK;

use App\Http\Controllers\Controller;
use App\Models\M_Data_Correction_Letters;
use App\Models\RefStudentAcademicYear;
use App\Models\RefStudent;
use App\Models\RefClass;
use App\Models\CoreEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DataCorrectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $corrections = M_Data_Correction_Letters::with([
            'student.student',
            'student.class',
            'headmaster',
            // 'createdby'
        ])->latest()->get();

        return view('pages.SK.dataCorrections.index', compact('corrections'));
    }

    /**
     * AJAX Search untuk Select2 - Cari Siswa
     */
    public function search(Request $request)
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $headmaster = [
            'id' => 'static-headmaster-id',
            'name' => 'MUCHAMAD EKI S.A., S.Kom',
            'nip' => '197610012006041011',
            'position' => 'Kepala Sekolah'
        ];

        // Ambil daftar kelas untuk filter
        $classes = RefClass::orderBy('academic_level', 'asc')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'academic_level']);

        // Auto generate nomor surat
        $year = now()->year;

        $lastCorrection = M_Data_Correction_Letters::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastCorrection) {
            $lastNumber = (int) explode('/', $lastCorrection->letter_number)[0];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $letterNumber = $formattedNumber . '/TU.01.03/SMK-Tlg.CADISDIKWIL.IX/' . $year;

        // Data jenis koreksi
        $correctionTypes = [
            'student_name' => 'Nama Siswa',
            'parent_name' => 'Nama Orang Tua',
            'birth_date' => 'Tanggal Lahir',
        ];

        return view('pages.SK.dataCorrections.create', compact(
            'headmaster',
            'classes',
            'letterNumber',
            'correctionTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_data_correction_letters,letter_number',
            'graduation_year' => 'required|string|max:255',
            'correction_type' => 'required|in:student_name,parent_name,birth_date,birth_place,other',
            'field_name' => 'required|string|max:255',
            'incorrect_data' => 'required|string|max:255',
            'correct_data' => 'required|string|max:255|different:incorrect_data',
            'reference_document' => 'nullable|string|max:255',
            'comparison_note' => 'nullable|string',
            'issue_date' => 'required|date',
        ], [
            'correct_data.different' => 'Data benar harus berbeda dengan data yang salah.',
        ]);

        // Get headmaster ID (dari CoreEmployee)
        $headmaster = CoreEmployee::where('job_name', 'like', '%kepala sekolah%')->first();

        $correction = M_Data_Correction_Letters::create([
            'id' => Str::uuid()->toString(),
            'student_id' => $validated['student_id'],
            'headmaster_id' => $headmaster->user_id ?? 'e8d5b988-5c06-11f0-87ba-c3c79bb1a62b',
            'letter_number' => $validated['letter_number'],
            'graduation_year' => $validated['graduation_year'],
            'correction_type' => $validated['correction_type'],
            'field_name' => $validated['field_name'],
            'incorrect_data' => $validated['incorrect_data'],
            'correct_data' => $validated['correct_data'],
            'reference_document' => $validated['reference_document'] ?? null,
            'comparison_note' => $validated['comparison_note'] ?? null,
            'issue_date' => $validated['issue_date'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('sk.dataCorrections.preview', $correction->id)
            ->with('success', 'Surat Koreksi Data berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $correction = M_Data_Correction_Letters::with([
            'headmaster',
            'student.student',
            'student.class',
            // 'createdby'
        ])->findOrFail($id);

        return view('pages.SK.dataCorrections.show', compact('correction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $correction = M_Data_Correction_Letters::findOrFail($id);

        // Ambil data kepala sekolah
        $headmasters = CoreEmployee::whereHas('user.roles', function ($query) {
            $query->whereIn('name', ['kepala_sekolah', 'headmaster', 'admin']);
        })
            ->orWhere('job_name', 'like', '%kepala%sekolah%')
            ->orWhere('job_name', 'like', '%headmaster%')
            ->orderBy('full_name')
            ->get();

        // Ambil data siswa
        $students = RefStudent::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data kelas
        if (class_exists('\App\Models\RefClass')) {
            $classes = \App\Models\RefClass::orderBy('academic_level')
                ->orderBy('name')
                ->get();
        } else {
            $classes = collect();
        }

        // Data jenis koreksi
        $correctionTypes = [
            'student_name' => 'Nama Siswa',
            'parent_name' => 'Nama Orang Tua',
            'birth_date' => 'Tanggal Lahir',
            'other' => 'Nomor Ijazah',
            'other' => 'Tahun Lulus',
            'other' => 'Kompetensi Keahlian',
            'other' => 'Umum Koreksi'
        ];

        return view('pages.SK.dataCorrections.edit', compact(
            'correction',
            'headmasters',
            'students',
            'classes',
            'correctionTypes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $correction = M_Data_Correction_Letters::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_data_correction_letters,letter_number,' . $id . ',id',
            'graduation_year' => 'required|string|max:255',
            'correction_type' => 'required|in:student_name,parent_name,birth_date,other',
            'field_name' => 'required|string|max:255',
            'incorrect_data' => 'required|string|max:255',
            'correct_data' => 'required|string|max:255|different:incorrect_data',
            'reference_document' => 'nullable|string|max:255',
            'comparison_note' => 'nullable|string',
            'issue_date' => 'required|date',
        ]);

        $correction->update($validated);

        return redirect()->route('sk.dataCorrections.index')
            ->with('success', 'Surat Koreksi Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $correction = M_Data_Correction_Letters::findOrFail($id);
        $correction->delete();

        return redirect()->route('sk.dataCorrections.index')
            ->with('success', 'Surat Koreksi Data berhasil dihapus.');
    }

    /**
     * Preview surat koreksi
     */
    public function preview(string $id)
    {
        $correction = M_Data_Correction_Letters::with([
            'headmaster',
            'student.student',
            'student.class'
        ])->findOrFail($id);

        return view('preview.SK.dataCorrections.print', compact('correction'));
    }

    /**
     * Download surat koreksi (increment download count)
     */
    public function download(string $id)
    {
        $correction = M_Data_Correction_Letters::findOrFail($id);

        // Tambah download count
        $correction->increment('download_count');

        return response()->json([
            'success' => true,
            'download_count' => $correction->download_count,
            'message' => 'Download Count Updated'
        ]);
    }

    /**
     * AJAX: Get class detail by ID (untuk auto-fill expertise program)
     */
    public function getClassDetail(string $id)
    {
        $class = RefClass::with('expertiseConcentration')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'class_name' => $class->name,
                'academic_level' => $class->academic_level,
                'expertiseConcentration' => $class->expertiseConcentration->name ?? '-',
            ]
        ]);
    }
}
