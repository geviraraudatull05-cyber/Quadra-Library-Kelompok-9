<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * ============================
     * LIST KATEGORI
     * ============================
     */
    public function index()
    {
        $categories = Category::withCount('books')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * ============================
     * FORM TAMBAH KATEGORI
     * ============================
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * ============================
     * SIMPAN KATEGORI BARU
     * ============================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * ============================
     * FORM EDIT KATEGORI
     * ============================
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * ============================
     * UPDATE KATEGORI
     * ============================
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * ============================
     * HAPUS KATEGORI
     * ============================
     */
    public function destroy(Category $category)
    {
        if ($category->books()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Kategori masih digunakan oleh buku');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
