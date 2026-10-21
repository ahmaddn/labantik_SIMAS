<?php

namespace App\Http\Controllers\SP;

use App\Http\Controllers\Controller;
use App\Models\CoreEmployee;
use App\Models\M_Treasurer;
use Illuminate\Http\Request;
use Exception;

class TreasurersController extends Controller
{
    public function index()
    {
        $treasurers = M_Treasurer::with('employee')->latest()->get();
        return view('pages.SP.treasurers.index', compact('treasurers'));
    }

    public function create()
    {
        $employees = CoreEmployee::select('id', 'full_name', 'nip')->orderBy('full_name')->get();
        return view('pages.SP.treasurers.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'nullable|exists:core_employees,id',
            'name'        => 'required|string|max:255',
            'nip'         => 'nullable|string|max:255',
            'position'    => 'required|string|max:255',
            'is_active'   => 'required|boolean',
        ], [
            'name.required'     => 'Nama bendahara wajib diisi',
            'position.required' => 'Jabatan wajib diisi',
            'is_active.required' => 'Status aktif wajib dipilih',
        ]);

        try {
            // Jika memilih employee, sinkronkan data jika nama/nip kosong
            if (!empty($validated['employee_id'])) {
                $employee = CoreEmployee::find($validated['employee_id']);
                if ($employee) {
                    $validated['name'] = $validated['name'] ?: $employee->full_name;
                    $validated['nip'] = $validated['nip'] ?: $employee->nip;
                }
            }

            M_Treasurer::create($validated);

            return redirect()
                ->route('sp.treasurers.index')
                ->with('success', 'Data Bendahara berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $treasurer = M_Treasurer::findOrFail($id);
        $employees = CoreEmployee::select('id', 'full_name', 'nip')->orderBy('full_name')->get();
        return view('pages.SP.treasurers.edit', compact('treasurer', 'employees'));
    }

    public function update(Request $request, string $id)
    {
        $treasurer = M_Treasurer::findOrFail($id);

        $validated = $request->validate([
            'employee_id' => 'nullable|exists:core_employees,id',
            'name'        => 'required|string|max:255',
            'nip'         => 'nullable|string|max:255',
            'position'    => 'required|string|max:255',
            'is_active'   => 'required|boolean',
        ], [
            'name.required'     => 'Nama bendahara wajib diisi',
            'position.required' => 'Jabatan wajib diisi',
            'is_active.required' => 'Status aktif wajib dipilih',
        ]);

        try {
            if (!empty($validated['employee_id'])) {
                $employee = CoreEmployee::find($validated['employee_id']);
                if ($employee) {
                    $validated['name'] = $validated['name'] ?: $employee->full_name;
                    $validated['nip'] = $validated['nip'] ?: $employee->nip;
                }
            }

            $treasurer->update($validated);

            return redirect()
                ->route('sp.treasurers.index')
                ->with('success', 'Data Bendahara berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $treasurer = M_Treasurer::findOrFail($id);
            $treasurer->delete();

            return redirect()
                ->route('sp.treasurers.index')
                ->with('success', 'Data Bendahara berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
