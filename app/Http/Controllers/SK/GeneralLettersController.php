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
use Carbon\Carbon;

class GeneralLettersController extends Controller
{
    public function index()
    {
        $letters = M_General_Letters::with([
            'student',
            'headmaster',
            //'creator'
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

        $year = now()->year;

        $lastLetter = M_General_Letters::whereYear('created_at', $year)
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
        return view('pages.SK.generalLetters.create', compact('headmaster', 'classes', 'letterNumber'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|uuid|exists:ref_student_academic_years,id',
            'letter_number' => 'nullable|string|max:100|unique:m_general_letters,letter_number',
            'content' => 'required|string|max:5000',
            'issue_date' => 'required|date',
        ]);

        // Get headmaster ID
        $headmaster = CoreEmployee::where('job_name', 'like', '%kepala sekolah%')->first();

        $letter = M_General_Letters::create([
            'id' => Str::uuid()->toString(),
            'student_academic_year_id' => $validated['student_id'],
            'student_id' => $validated['student_id'],
            'headmaster_id' => $headmaster->id ?? 'e8d5b988-5c06-11f0-87ba-c3c79bb1a62b',
            'letter_number' => $validated['letter_number'],
            'content' => $validated['content'],
            'issue_date' => $validated['issue_date'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('sk.generalLetters.preview', $letter->id)
            ->with('success', 'Surat Keterangan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $letter = M_General_Letters::with([
            'headmaster',
            'student', // nested relation jika perlu
            //  'creator'
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

        return view('pages.SK.generalLetters.edit', compact(
            'letter',
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
        $letter = M_General_Letters::findOrFail($id);

        $validated = $request->validate([
            // 'headmaster_id' => 'required|uuid|exists:core_users,id',
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
     * Preview surat
     */
    public function preview(string $id)
    {
        $letter = M_General_Letters::with([
            'headmaster',
            'student.student'
        ])->findOrFail($id);

        return view('preview.SK.generalLetters.print', compact('letter'));
    }

    /**
     * Download surat
     */
    public function incrementDownload(string $id)
    {
        $letter = M_General_Letters::findOrFail($id);

        // Tambah download count
        $letter->increment('download_count');

        return response()->json([
            'success' => true,
            'download_count' => $letter->download_count,
            'message' =>  'Download Count Update'
        ]);

        return redirect()->back()
            ->with('success', 'Surat berhasil didownload.');
    }
}
