<?php

namespace App\Http\Controllers\SP;

use App\Http\Controllers\Controller;
use App\Models\M_TravelCostCategory;
use Illuminate\Http\Request;
use Exception;

class TravelCostCategoriesController extends Controller
{
    public function index()
    {
        $categories = M_TravelCostCategory::withCount(['accommodations', 'transports'])
            ->ordered()
            ->get();

        return view('pages.SP.travelOrders.costCategory.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.SP.travelOrders.costCategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:accommodation,transport',
            'description' => 'nullable|string|max:500',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'required|in:0,1',
        ], [
            'name.required'   => 'Nama kategori wajib diisi',
            'type.required'   => 'Tipe kategori wajib dipilih',
            'type.in'         => 'Tipe tidak valid',
            'is_active.required' => 'Status wajib dipilih',
        ]);

        try {
            M_TravelCostCategory::create([
                'name'        => $request->name,
                'type'        => $request->type,
                'description' => $request->description,
                'sort_order'  => $request->sort_order ?? 0,
                'is_active'   => (bool) $request->is_active,
            ]);

            return redirect()
                ->route('sp.travelCostCategories.index')
                ->with('success', 'Kategori biaya berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = M_TravelCostCategory::findOrFail($id);

        return view('pages.SP.travelOrders.costCategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = M_TravelCostCategory::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:accommodation,transport',
            'description' => 'nullable|string|max:500',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'required|in:0,1',
        ], [
            'name.required'      => 'Nama kategori wajib diisi',
            'type.required'      => 'Tipe kategori wajib dipilih',
            'type.in'            => 'Tipe tidak valid',
            'is_active.required' => 'Status wajib dipilih',
        ]);

        try {
            $category->update([
                'name'        => $request->name,
                'type'        => $request->type,
                'description' => $request->description,
                'sort_order'  => $request->sort_order ?? 0,
                'is_active'   => (bool) $request->is_active,
            ]);

            return redirect()
                ->route('sp.travelCostCategories.index')
                ->with('success', 'Kategori biaya berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Toggle status aktif/nonaktif langsung dari tabel
     */
    public function toggle($id)
    {
        $category = M_TravelCostCategory::findOrFail($id);

        try {
            $category->update(['is_active' => !$category->is_active]);

            $status = $category->is_active ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()
                ->route('sp.travelCostCategories.index')
                ->with('success', "Kategori \"{$category->name}\" berhasil {$status}");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $category = M_TravelCostCategory::findOrFail($id);

        try {
            $category->delete();

            return redirect()
                ->route('sp.travelCostCategories.index')
                ->with('success', "Kategori \"{$category->name}\" berhasil dihapus");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dalam data biaya.');
        }
    }
}
