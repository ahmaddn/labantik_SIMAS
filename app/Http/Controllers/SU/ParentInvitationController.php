<?php

namespace App\Http\Controllers\SU;

use App\Http\Controllers\Controller;
use App\Models\M_Parent_Invitation_Letters;
use App\Models\RefStudentAcademicYear;
use App\Models\Student;
use App\Models\Headmaster;
use App\Models\RefClass;
use App\Models\CoreEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ParentInvitationController extends Controller
{
    public function index()
    {
        // Data kategori INDIVIDU → Tab Individual
        $parentInvitations = M_Parent_Invitation_Letters::with([
            'student' => function ($query) {
                $query->with('student'); // Nested eager load
            },
            'createdBy'
        ])
            ->where('categories', 'Individu')
            ->orderBy('created_at', 'desc')
            ->get();

        // Data kategori JAMAK → Tab Umum
        $generalInvitation = M_Parent_Invitation_Letters::with(['createdBy'])
            ->where('categories', 'Jamak')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.SU.parentInvitation.index', compact('parentInvitations', 'generalInvitation'));
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
        $classes = RefClass::orderBy('academic_level', 'asc')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'academic_level']);

        // Generate letter number menggunakan logika yang sama dengan GeneralLetters
        $year = now()->year;

        $lastLetter = M_Parent_Invitation_Letters::whereYear('created_at', $year)
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

        return view('pages.SU.parentInvitation.create', compact('classes', 'letterNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'nullable|uuid|exists:ref_student_academic_years,id',
            'to' => 'nullable|string|max:500',
            'letter_number' => 'required|string|max:100|unique:m_parent_invitation_letters,letter_number',
            'purpose' => 'required|string|max:5000',
            'categories' => 'required|in:Individu,Jamak',
            'meeting_day' => 'nullable|string|max:255',
            'meeting_date' => 'nullable|date',
            'meeting_time' => 'nullable',
            'meeting_place' => 'nullable|string|max:255',
            'meeting_with' => 'nullable|string|max:255',
            'issue_date' => 'required|date',
        ]);

        // Create parent invitation
        $invitation = M_Parent_Invitation_Letters::create([
            'id' => Str::uuid()->toString(),
            'student_id' => $validated['student_id'] ?? null,
            'headmaster_id' => null, // Add logic to get headmaster if needed
            'letter_number' => $validated['letter_number'],
            'to' => $validated['to'],
            'purpose' => $validated['purpose'],
            'categories' => $validated['categories'],
            'meeting_day' => $validated['meeting_day'] ?? null,
            'meeting_date' => $validated['meeting_date'] ?? null,
            'meeting_time' => $validated['meeting_time'] ?? null,
            'meeting_place' => $validated['meeting_place'] ?? null,
            'meeting_with' => $validated['meeting_with'] ?? null,
            'issue_date' => $validated['issue_date'],
            'created_by' => Auth::id(),
        ]);

        // Redirect to print preview based on category
        return redirect()->route('su.parentInvitations.preview', $invitation->id);
    }


    public function edit($id)
    {
        $invitation = M_Parent_Invitation_Letters::with('student.student')->findOrFail($id);

        $classes = RefClass::orderBy('academic_level', 'asc')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'academic_level']);

        return view('pages.SU.parentInvitation.edit', compact('invitation', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $invitation = M_Parent_Invitation_Letters::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'nullable|uuid|exists:ref_student_academic_years,id',
            'kepada' => 'nullable|string|max:500',
            'letter_number' => 'nullable|string|max:100|unique:m_parent_invitation_letters,letter_number,' . $id . ',id',
            'purpose' => 'required|string|max:5000',
            'to' => 'required|string|max:250',
            'categories' => 'required|in:Individu,Jamak',
            'meeting_day' => 'nullable|string|max:255',
            'meeting_date' => 'nullable|date',
            'meeting_time' => 'nullable',
            'meeting_place' => 'nullable|string|max:255',
            'meeting_with' => 'nullable|string|max:255',
            'issue_date' => 'required|date',
        ]);

        $invitation->update($validated);

        return redirect()
            ->route('su.parentInvitations.index')
            ->with('success', 'Surat undangan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $invitation = M_Parent_Invitation_Letters::findOrFail($id);
        $invitation->delete();

        return redirect()
            ->route('su.parentInvitations.index')
            ->with('success', 'Surat undangan berhasil dihapus!');
    }

    public function show($id)
    {
        $invitation = M_Parent_Invitation_Letters::with([
            'student.student',
            'headmaster'
        ])->findOrFail($id);

        return view('pages.SU.parentInvitation.show', compact('invitation'));
    }

    public function preview($id)
    {
        $invitation = M_Parent_Invitation_Letters::with([
            'student.student',
            'headmaster'
        ])->findOrFail($id);

        // Tentukan view berdasarkan kategori
        if ($invitation->categories === 'Individu') {
            $view = 'preview.SU.parentInvitation.printIndividu';
        } elseif ($invitation->categories === 'Jamak') {
            $view = 'preview.SU.parentInvitation.printJamak';
        } else {
            abort(404, 'Kategori tidak dikenali');
        }

        return view($view, compact('invitation'));
    }
}
