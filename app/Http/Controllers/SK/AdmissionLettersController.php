<?php

namespace App\Http\Controllers\SK;

use App\Http\Controllers\Controller;
use App\Models\M_Admission_Letters;
use App\Models\RefStudentAcademicYear;
use App\Models\RefStudent;
use App\Models\RefClass;
use App\Models\CoreEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdmissionLettersController extends Controller
{
    public function index()
    {
        $admissions = M_Admission_Letters::with([
            'student',
            'headmaster',
        ])->latest()->get();

        return view('pages.SK.admissionLetters.index', compact('admissions'));
    }

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

    public function create()
    {
        // Data kepala sekolah statis
        $headmaster = [
            'id' => 'static-headmaster-id',
            'name' => 'MUCHAMAD EKI S.A., S.Kom',
            'nip' => '197610012006041011',
            'position' => 'Kepala Sekolah'
        ];

        $classes = RefClass::orderBy('academic_level', 'asc')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'academic_level']);

        $year = now()->year;

        $lastLetter = M_Admission_Letters::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastLetter) {
            $lastNumber = (int) explode('/', $lastLetter->letter_number)[0];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $letterNumber = $formattedNumber . '/TU.01.02/SMK-Tlg/CADISDIKWIL.IX/' . $year;

        return view('pages.SK.admissionLetters.create', compact('headmaster', 'classes', 'letterNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_admission_letters,letter_number',
            'admission_date' => 'required|date',
            'academic_year' => 'required|string|max:20',
            'previous_school' => 'required|string|max:255',
        ]);

        // Get headmaster ID
        $headmaster = CoreEmployee::where('job_name', 'like', '%kepala sekolah%')->first();

        $admission = M_Admission_Letters::create([
            'id' => Str::uuid()->toString(),
            'student_id' => $validated['student_id'],
            'headmaster_id' => $headmaster->id ?? 'e8d5b988-5c06-11f0-87ba-c3c79bb1a62b',
            'letter_number' => $validated['letter_number'],
            'admission_date' => $validated['admission_date'],
            'academic_year' => $validated['academic_year'],
            'previous_school' => $validated['previous_school'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('sk.admissionLetters.preview', $admission->id)
            ->with('success', 'Surat Keterangan Penerimaan Siswa berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admission = M_Admission_Letters::with([
            'headmaster',
            'student.student',
        ])->findOrFail($id);

        return view('pages.SK.admissionLetters.show', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admission = M_Admission_Letters::findOrFail($id);

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

        if (class_exists('\App\Models\RefClass')) {
            $classes = \App\Models\RefClass::orderBy('academic_level')
                ->orderBy('name')
                ->get();
        } else {
            $classes = collect();
        }

        return view('pages.SK.admissionLetters.edit', compact(
            'admission',
            'headmasters',
            'students',
            'classes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admission = M_Admission_Letters::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_admission_letters,letter_number,' . $id . ',id',
            'admission_date' => 'required|date',
            'academic_year' => 'required|string|max:20',
            'previous_school' => 'required|string|max:255',
        ]);

        $admission->update($validated);

        return redirect()->route('sk.admissionLetters.index')
            ->with('success', 'Surat Keterangan Penerimaan Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admission = M_Admission_Letters::findOrFail($id);
        $admission->delete();

        return redirect()->route('sk.admissionLetters.index')
            ->with('success', 'Surat Keterangan Penerimaan Siswa berhasil dihapus.');
    }

    /**
     * Preview surat
     */
    public function preview(string $id)
    {
        $admission = M_Admission_Letters::with([
            'headmaster',
            'student.student'
        ])->findOrFail($id);

        return view('preview.SK.admissionLetters.print', compact('admission'));
    }

    /**
     * Download surat
     */
    public function download(string $id)
    {
        $admission = M_Admission_Letters::findOrFail($id);

        // Tambah download count
        $admission->increment('download_count');

        return response()->json([
            'success' => true,
            'download_count' => $admission->download_count,
            'message' =>  'Download Count Update'
        ]);
    }
}
