<?php

namespace App\Http\Controllers\SK;

use App\Http\Controllers\Controller;
use App\Models\M_General_Letters;
use App\Models\RefStudentAcademicYear;
use App\Models\RefStudent;
use App\Models\RefClass;
use App\Models\CoreEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GeneralLettersController extends Controller
{
    public function index()
    {
        $letters = M_General_Letters::with([
            'student',
            'headmaster',
            'creator'
        ])->latest()->get();

        return view('pages.SK.generalLetters.index', compact('letters'));
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

        return view('pages.SK.generalLetters.create', compact('headmaster', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_general_letters,letter_number',
            'content' => 'required|string',
            'issue_date' => 'required|date',
        ]);

        $validated['headmaster_id'] = 'e8d5b988-5c06-11f0-87ba-c3c79bb1a62b'; // ID kepala sekolah, saya ambil dari database
        $validated['id'] = Str::uuid()->toString();

        if (empty($validated['letter_number'])) {
            $year = date('Y');
            $count = M_General_Letters::whereYear('created_at', $year)->count() + 1;
            $validated['letter_number'] = sprintf('%03d/TU.01.02/SMK-Tlg.CADISWIL.IX/%d', $count, $year);
        }

        $validated['created_by'] = auth()->id();

        // Simpan
        $letter = M_General_Letters::create($validated);

        return redirect()->route('sk.generalLetters.index')
            ->with('success', 'Surat Keterangan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $letter = M_General_Letters::with([
            'headmaster',
            'student.student', // nested relation jika perlu
            'creator'
        ])->findOrFail($id);

        return view('pages.SK.generalLetters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $letter = M_General_Letters::findOrFail($id);

        // Ambil data kepala sekolah
        $headmasters = CoreEmployee::whereHas('roles', function ($query) {
            $query->whereIn('name', ['kepala_sekolah', 'headmaster', 'admin']);
        })->orWhere('position', 'like', '%kepala%sekolah%')
            ->orderBy('name')
            ->get();

        // Ambil data siswa
        $students = RefStudent::with('student')
            ->whereHas('student')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.SK.generalLetters.edit', compact('letter', 'headmasters', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $letter = M_General_Letters::findOrFail($id);

        $validated = $request->validate([
            'headmaster_id' => 'required|uuid|exists:core_users,id',
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_general_letters,letter_number,' . $id . ',id',
            'content' => 'required|string',
            'issue_date' => 'required|date',
        ]);

        $letter->update($validated);

        return redirect()->route('sk.generalLetters.index')
            ->with('success', 'Surat Keterangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter = M_General_Letters::findOrFail($id);
        $letter->delete();

        return redirect()->route('sk.generalLetters.index')
            ->with('success', 'Surat Keterangan berhasil dihapus.');
    }

    /**
     * Cetak/Print surat
     */
    public function print(string $id)
    {
        $letter = M_General_Letters::with([
            'headmaster',
            'student.student'
        ])->findOrFail($id);

        // Tambah download count
        $letter->increment('download_count');

        return view('pages.SK.generalLetters.print', compact('letter'));
    }

    /**
     * Preview surat
     */
    public function preview(string $id)
    {
        $letter = M_General_Letters::with([
            'headmaster',
            'student.student'
        ])->findOrFail($id);

        return view('pages.SK.generalLetters.preview', compact('letter'));
    }

    /**
     * Download surat
     */
    public function download(string $id)
    {
        $letter = M_General_Letters::findOrFail($id);

        // Tambah download count
        $letter->increment('download_count');

        // Logika untuk download file jika ada
        // return response()->download($path);

        return redirect()->back()
            ->with('success', 'Surat berhasil didownload.');
    }
}
