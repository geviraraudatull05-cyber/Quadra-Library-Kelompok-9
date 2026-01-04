<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * =====================================================
     * GET /api/favorites
     * Ambil daftar buku favorit user
     * =====================================================
     */
    public function index()
    {
        $favorites = auth()->user()
            ->favorites()
            ->with('category')
            ->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $favorites
        ]);
    }

    /**
     * =====================================================
     * POST /api/favorites/{book}
     * Toggle favorit (tambah / hapus)
     * =====================================================
     */
    public function toggle(Book $book)
    {
        $user = auth()->user();

        if ($user->favorites()->where('book_id', $book->id)->exists()) {
            $user->favorites()->detach($book->id);

            return response()->json([
                'success' => true,
                'message' => 'Buku dihapus dari favorit',
                'is_favorite' => false
            ]);
        }

        $user->favorites()->attach($book->id);

        return response()->json([
            'success' => true,
            'message' => 'Buku ditambahkan ke favorit',
            'is_favorite' => true
        ]);
    }
}
