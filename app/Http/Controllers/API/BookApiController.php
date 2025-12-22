<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookApiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /* =========================
     * GET /api/books
     * ========================= */
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $books
        ]);
    }

    /* =========================
     * POST /api/books (ADMIN)
     * ========================= */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'author'       => 'nullable|string|max:255',
            'isbn'         => 'nullable|string|max:50|unique:books,isbn',
            'publisher'    => 'nullable|string|max:255',
            'year'         => 'nullable|digits:4',
            'total_copies' => 'required|integer|min:1',
            'cover'        => 'nullable|image|max:20480',
            'description'  => 'nullable|string',
        ]);

        $data['available_copies'] = $data['total_copies'];

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')
                ->store('covers', 'public');
        }

        $book = Book::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data'    => $book
        ], 201);
    }

    /* =========================
     * GET /api/books/{id}
     * ========================= */
    public function show(Book $book)
    {
        return response()->json([
            'success' => true,
            'data'    => $book->load('category')
        ]);
    }

    /* =========================
     * PUT /api/books/{id}
     * ========================= */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'author'       => 'nullable|string|max:255',
            'isbn'         => 'nullable|string|max:50|unique:books,isbn,' . $book->id,
            'publisher'    => 'nullable|string|max:255',
            'year'         => 'nullable|digits:4',
            'total_copies' => 'required|integer|min:1',
            'cover'        => 'nullable|image|max:20480',
            'description'  => 'nullable|string',
        ]);

        $delta = $data['total_copies'] - $book->total_copies;
        $data['available_copies'] = max(0, $book->available_copies + $delta);

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }

            $data['cover_path'] = $request->file('cover')
                ->store('covers', 'public');
        }

        $book->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diperbarui',
            'data'    => $book
        ]);
    }

    /* =========================
     * DELETE /api/books/{id}
     * ========================= */
    public function destroy(Book $book)
    {
        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
