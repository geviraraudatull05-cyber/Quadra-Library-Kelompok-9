<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * =====================================================
     * SISWA: DAFTAR PEMINJAMAN MILIK SENDIRI
     * =====================================================
     */
    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * =====================================================
     * ADMIN: MELIHAT SEMUA DATA PEMINJAMAN
     * =====================================================
     */
    public function adminIndex()
    {
        $borrowings = Borrowing::with(['book', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * =====================================================
     * SISWA: FORM PEMINJAMAN BUKU
     * =====================================================
     */
    public function borrowForm(Book $book)
    {
        if ($book->available_copies < 1) {
            return redirect()
                ->route('books.browse')
                ->with('error', 'Stok buku sedang habis');
        }

        return view('borrowings.create', compact('book'));
    }

    /**
     * =====================================================
     * SISWA: PROSES PEMINJAMAN BUKU
     * =====================================================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'due_at'  => 'required|date|after:today',
            'note'    => 'nullable|string|max:255', // ✅ FIX PENTING
        ]);

        $book = Book::findOrFail($data['book_id']);

        if ($book->available_copies < 1) {
            return back()->with('error', 'Stok buku tidak mencukupi');
        }

        Borrowing::create([
            'user_id'     => Auth::id(),
            'book_id'     => $book->id,
            'borrowed_at' => now(),
            'due_at'      => $data['due_at'],
            'note'        => $data['note'] ?? null, // ✅ FIX UTAMA
            'status'      => 'borrowed',
        ]);

        $book->decrement('available_copies');

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    /**
     * =====================================================
     * SISWA: PENGEMBALIAN BUKU
     * =====================================================
     */
    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        if ($borrowing->status === 'returned') {
            return back()->with('info', 'Buku sudah dikembalikan');
        }

        $borrowing->update([
            'returned_at' => now(),
            'status'      => 'returned',
        ]);

        $borrowing->book->increment('available_copies');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
