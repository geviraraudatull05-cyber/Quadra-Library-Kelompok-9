<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * GET /api/categories
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Category::withCount('books')->orderBy('name')->get()
        ]);
    }

    /**
     * POST /api/categories (ADMIN)
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        $category = Category::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category
        ], 201);
    }

    /**
     * PUT /api/categories/{category} (ADMIN)
     */
    public function update(Request $request, Category $category)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        $category->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui',
            'data' => $category
        ]);
    }

    /**
     * DELETE /api/categories/{category} (ADMIN)
     */
    public function destroy(Category $category)
    {
        $this->authorizeAdmin();

        if ($category->books()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori masih digunakan oleh buku'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }

    /**
     * Cek role admin
     */
    protected function authorizeAdmin()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Akses admin saja');
        }
    }
}
