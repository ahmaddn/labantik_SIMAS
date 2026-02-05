<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use App\Models\M_Student_Return_Letters;
use App\Models\M_Reason_Student_Return_Letters;
use App\Models\RefStudentAcademicYear;
use App\Models\RefClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentReturnsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentReturns = M_Student_Return_Letters::with(['student.student', 'createdby'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.others.studentReturns.index', compact('studentReturns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = RefClass::orderBy('academic_level')
            ->orderBy('name')
            ->get();

        // Generate nomor surat otomatis
        $lastLetter = M_Student_Return_Letters::latest('created_at')->first();
        $lastNumber = $lastLetter ? (int) substr($lastLetter->letter_number, 0, 3) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $letterNumber = $newNumber . '/TU.01.02/ SMK-Tlg/CADISDIKWIL.IX/' . date('Y');

        return view('pages.others.studentReturns.create', compact('classes', 'letterNumber'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:ref_classes,id',
            'student_id' => 'required|exists:ref_student_academic_years,id',
            'letter_number' => 'required|string|unique:m_student_return_letters,letter_number',
            'return_date' => 'required|date',
            'reasons' => 'required|array|min:1',
            'reasons.*' => 'required|string|max:500',
        ], [
            'class_id.required' => 'Kelas harus dipilih',
            'student_id.required' => 'Siswa harus dipilih',
            'letter_number.required' => 'Nomor surat harus diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'return_date.required' => 'Tanggal pengembalian harus diisi',
            'reasons.required' => 'Alasan pengembalian harus diisi minimal 1',
            'reasons.*.required' => 'Alasan tidak boleh kosong',
        ]);

        try {
            DB::beginTransaction();

            // Get headmaster (kepala sekolah)
            // $headmaster = User::where(column: 'role', 'headmaster')->first();

            // Create student return letter
            $studentReturn = M_Student_Return_Letters::create([
                'student_id' => $validated['student_id'],
                'letter_number' => $validated['letter_number'],
                'return_date' => $validated['return_date'],
                'created_by' => Auth::id(),
            ]);

            // Create reasons
            foreach ($validated['reasons'] as $reason) {
                if (!empty(trim($reason))) {
                    M_Reason_Student_Return_Letters::create([
                        'student_return_letter_id' => $studentReturn->id,
                        'reason' => trim($reason),
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('others.studentReturns.index')
                ->with('success', 'Surat Pengembalian Siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studentReturn = M_Student_Return_Letters::with(['student.class', 'reasons'])
            ->findOrFail($id);

        $classes = RefClass::orderBy('academic_level')
            ->orderBy('name')
            ->get();

        // Get current class from student
        $currentClassId = $studentReturn->student->class_id ?? null;

        return view('pages.others.studentReturns.edit', compact(
            'studentReturn',
            'classes',
            'currentClassId'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studentReturn = M_Student_Return_Letters::findOrFail($id);

        $validated = $request->validate([
            'class_id' => 'required|exists:ref_classes,id',
            'student_id' => 'required|exists:ref_student_academic_years,id',
            'letter_number' => 'required|string|unique:m_student_return_letters,letter_number,' . $id,
            'return_date' => 'required|date',
            'reasons' => 'required|array|min:1',
            'reasons.*' => 'required|string|max:500',
        ], [
            'class_id.required' => 'Kelas harus dipilih',
            'student_id.required' => 'Siswa harus dipilih',
            'letter_number.required' => 'Nomor surat harus diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'return_date.required' => 'Tanggal pengembalian harus diisi',
            'reasons.required' => 'Alasan pengembalian harus diisi minimal 1',
            'reasons.*.required' => 'Alasan tidak boleh kosong',
        ]);

        try {
            DB::beginTransaction();

            // Update student return letter
            $studentReturn->update([
                'student_id' => $validated['student_id'],
                'letter_number' => $validated['letter_number'],
                'return_date' => $validated['return_date'],
            ]);

            // Delete old reasons
            M_Reason_Student_Return_Letters::where('student_return_letter_id', $studentReturn->id)->delete();

            // Create new reasons
            foreach ($validated['reasons'] as $reason) {
                if (!empty(trim($reason))) {
                    M_Reason_Student_Return_Letters::create([
                        'student_return_letter_id' => $studentReturn->id,
                        'reason' => trim($reason),
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('others.studentReturns.index')
                ->with('success', 'Surat Pengembalian Siswa berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
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
            DB::beginTransaction();

            $studentReturn = M_Student_Return_Letters::findOrFail($id);

            // Delete reasons first (cascade)
            M_Reason_Student_Return_Letters::where('student_return_letter_id', $id)->delete();

            // Delete student return letter
            $studentReturn->delete();

            DB::commit();

            return redirect()
                ->route('others.studentReturns.index')
                ->with('success', 'Surat Pengembalian Siswa berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Print student return letter
     */
    public function preview(string $id)
    {
        $studentReturn = M_Student_Return_Letters::with([
            'student.student',
            'reasons'
        ])->findOrFail($id);

        return view('preview.others.studentReturns.print', compact('studentReturn'));
    }
}
