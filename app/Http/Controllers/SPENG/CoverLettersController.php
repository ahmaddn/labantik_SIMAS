<?php

namespace App\Http\Controllers\SPENG;

use App\Http\Controllers\Controller;
use App\Models\M_Cover_Letters;
use App\Models\M_Detail_Cover_Letters;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoverLettersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coverLetters = M_Cover_Letters::with(['details', 'createdBy'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.SPENG.coverLetters.index', compact('coverLetters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validasi jumlah naskah dari query parameter
        $jumlahNaskah = $request->query('jumlah_naskah', 1);

        // Validasi range
        if ($jumlahNaskah < 1) {
            $jumlahNaskah = 1;
        } elseif ($jumlahNaskah > 20) {
            $jumlahNaskah = 20;
        }

        // Generate nomor surat otomatis
        $year = now()->year;

        $lastLetter = M_Cover_Letters::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastLetter) {
            $lastNumber = (int) explode('/', $lastLetter->letter_number)[0];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $letterNumber = $formattedNumber . '/AR.03.01/SMK-Tlg.CADISDIKWIL.IX/' . $year;

        // Get list headmasters (users dengan role kepala sekolah)
        // $headmasters = User::where('role')
        //     ->orWhere('role', 'kepala_sekolah')
        //     ->orderBy('name', 'asc')
        //     ->get();

        return view('pages.SPENG.coverLetters.create', compact('jumlahNaskah', 'letterNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'letter_number' => 'required|string|max:255|unique:m_cover_letters,letter_number',
            'issue_date' => 'required|date',
            'towards' => 'required|string|max:255',
            'details' => 'required|array|min:1',
            'details.*.document_sent' => 'required|string|max:255',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.notes' => 'nullable|string',
        ], [
            'letter_number.required' => 'Nomor surat wajib diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'issue_date.required' => 'Tanggal surat wajib diisi',
            'towards.required' => 'Kepada wajib diisi',
            'details.required' => 'Detail naskah wajib diisi',
            'details.*.document_sent.required' => 'Dokumen yang dikirim wajib diisi',
            'details.*.qty.required' => 'Jumlah wajib diisi',
            'details.*.qty.min' => 'Jumlah minimal 1',
        ]);

        DB::beginTransaction();

        try {
            // Create cover letter
            $coverLetter = M_Cover_Letters::create([
                'id' => Str::uuid(),
                'letter_number' => $validated['letter_number'],
                'issue_date' => $validated['issue_date'],
                'towards' => $validated['towards'],
                'created_by' => Auth::id(),
                'download_count' => 0,
            ]);

            // Create details
            foreach ($validated['details'] as $detail) {
                M_Detail_Cover_Letters::create([
                    'id' => Str::uuid(),
                    'cover_letter_id' => $coverLetter->id,
                    'document_sent' => $detail['document_sent'],
                    'qty' => $detail['qty'],
                    'notes' => $detail['notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('s_peng.coverLetters.index')
                ->with('success', 'Surat Pengantar berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();

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
        $coverLetter = M_Cover_Letters::with(['details', 'createdBy'])
            ->findOrFail($id);

        // Get list headmasters
        // $headmasters = User::where('role')
        //     ->orWhere('role', 'kepala_sekolah')
        //     ->orderBy('name', 'asc')
        //     ->get();

        return view('pages.SPENG.coverLetters.edit', compact('coverLetter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coverLetter = M_Cover_Letters::findOrFail($id);

        // Validasi data
        $validated = $request->validate([
            'letter_number' => 'required|string|max:255|unique:m_cover_letters,letter_number,' . $id,
            'issue_date' => 'required|date',
            'towards' => 'required|string|max:255',
            'details' => 'required|array|min:1',
            'details.*.id' => 'nullable|exists:m_detail_cover_letters,id',
            'details.*.document_sent' => 'required|string|max:255',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.notes' => 'nullable|string',
        ], [
            'letter_number.required' => 'Nomor surat wajib diisi',
            'letter_number.unique' => 'Nomor surat sudah digunakan',
            'issue_date.required' => 'Tanggal surat wajib diisi',
            'towards.required' => 'Kepada wajib diisi',
            'details.required' => 'Detail naskah wajib diisi',
            'details.*.document_sent.required' => 'Dokumen yang dikirim wajib diisi',
            'details.*.qty.required' => 'Jumlah wajib diisi',
            'details.*.qty.min' => 'Jumlah minimal 1',
        ]);

        DB::beginTransaction();

        try {
            // Update cover letter
            $coverLetter->update([
                'letter_number' => $validated['letter_number'],
                'issue_date' => $validated['issue_date'],
                'towards' => $validated['towards'],
                'headmaster_id' => $validated['headmaster_id'] ?? null,
            ]);

            // Get existing detail IDs
            $existingDetailIds = $coverLetter->details->pluck('id')->toArray();
            $submittedDetailIds = [];

            // Update or create details
            foreach ($validated['details'] as $detail) {
                if (isset($detail['id']) && in_array($detail['id'], $existingDetailIds)) {
                    // Update existing detail
                    M_Detail_Cover_Letters::where('id', $detail['id'])->update([
                        'document_sent' => $detail['document_sent'],
                        'qty' => $detail['qty'],
                        'notes' => $detail['notes'] ?? null,
                    ]);
                    $submittedDetailIds[] = $detail['id'];
                } else {
                    // Create new detail
                    $newDetail = M_Detail_Cover_Letters::create([
                        'id' => Str::uuid(),
                        'cover_letter_id' => $coverLetter->id,
                        'document_sent' => $detail['document_sent'],
                        'qty' => $detail['qty'],
                        'notes' => $detail['notes'] ?? null,
                    ]);
                    $submittedDetailIds[] = $newDetail->id;
                }
            }

            // Delete details that are not in the submitted data
            $detailsToDelete = array_diff($existingDetailIds, $submittedDetailIds);
            if (!empty($detailsToDelete)) {
                M_Detail_Cover_Letters::whereIn('id', $detailsToDelete)->delete();
            }

            DB::commit();

            return redirect()
                ->route('s_peng.coverLetters.index')
                ->with('success', 'Surat Pengantar berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();

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
        DB::beginTransaction();

        try {
            $coverLetter = M_Cover_Letters::findOrFail($id);

            // Delete all details first
            $coverLetter->details()->delete();

            // Delete cover letter
            $coverLetter->delete();

            DB::commit();

            return redirect()
                ->route('s_peng.coverLetters.index')
                ->with('success', 'Surat Pengantar berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Print the cover letter.
     */
    public function print(string $id)
    {
        $coverLetter = M_Cover_Letters::with(['details', 'createdBy'])
            ->findOrFail($id);

        return view('preview.SPENG.coverLetters.print', compact('coverLetter'));
    }

    public function incrementDownload(string $id)
    {
        $coverLetter = M_Cover_Letters::with(['details', 'createdBy'])
            ->findOrFail($id);

        // Increment download count
        $coverLetter->increment(column: 'download_count');

        return view('preview.SPENG.coverLetters.print', compact('coverLetter'));
    }
}
