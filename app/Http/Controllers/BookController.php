<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])
            ->except(['browse']);
    }

    /* =========================
     * ADMIN AREA
     * ========================= */

    public function index()
    {
        $books = Book::with('category')
            ->latest()
            ->paginate(12);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.create', compact('categories'));
    }

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

        // ✅ stok awal
        $data['available_copies'] = $data['total_copies'];

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')
                ->store('covers', 'public');
        }

        Book::create($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'categories'));
    }

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

        // ✅ HITUNG PERUBAHAN STOK
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

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Data buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    /* =========================
     * SISWA AREA
     * ========================= */

    public function browse(Request $request)
    {
        $query = Book::with('category')
            ->where('available_copies', '>', 0);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(12);
        $categories = Category::orderBy('name')->get();

        return view('books.browse', compact('books', 'categories'));
    }
}
