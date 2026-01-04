<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * =====================================================
     * SISWA: DAFTAR PEMINJAMAN MILIK SENDIRI
     * GET /api/borrowings
     * =====================================================
     */
    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $borrowings
        ]);
    }

    /**
     * =====================================================
     * ADMIN: MELIHAT SEMUA DATA PEMINJAMAN
     * GET /api/admin/borrowings
     * =====================================================
     */
    public function adminIndex()
    {
        $borrowings = Borrowing::with(['book', 'user'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data'    => $borrowings
        ]);
    }

    /**
     * =====================================================
     * SISWA: PROSES PEMINJAMAN BUKU
     * POST /api/borrowings
     * =====================================================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'due_at'  => 'required|date|after:today',
            'note'    => 'nullable|string|max:255',
        ]);

        $book = Book::findOrFail($data['book_id']);

        if ($book->available_copies < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Stok buku tidak mencukupi'
            ], 400);
        }

        $borrowing = Borrowing::create([
            'user_id'     => Auth::id(),
            'book_id'     => $book->id,
            'borrowed_at' => now(),
            'due_at'      => $data['due_at'],
            'note'        => $data['note'] ?? null,
            'status'      => 'borrowed',
        ]);

        $book->decrement('available_copies');

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dipinjam',
            'data'    => $borrowing
        ], 201);
    }

    /**
     * =====================================================
     * SISWA: PENGEMBALIAN BUKU
     * PATCH /api/borrowings/{borrowing}/return
     * =====================================================
     */
    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses tidak diizinkan'
            ], 403);
        }

        if ($borrowing->status === 'returned') {
            return response()->json([
                'success' => false,
                'message' => 'Buku sudah dikembalikan'
            ], 400);
        }

        $borrowing->update([
            'returned_at' => now(),
            'status'      => 'returned',
        ]);

        $borrowing->book->increment('available_copies');

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dikembalikan'
        ]);
    }

    /**
     * =====================================================
     * ADMIN: DETAIL PEMINJAMAN
     * GET /api/admin/borrowings/{id}
     * =====================================================
     */
    public function show(Borrowing $borrowing)
    {
        return response()->json([
            'success' => true,
            'data'    => $borrowing->load(['book', 'user'])
        ]);
    }

    /**
     * =====================================================
     * ADMIN: HAPUS DATA PEMINJAMAN
     * DELETE /api/admin/borrowings/{id}
     * =====================================================
     */
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed') {
            $borrowing->book->increment('available_copies');
        }

        $borrowing->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman berhasil dihapus'
        ]);
    }
}
