<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Book $book)
    {
        $user = auth()->user();

        if ($user->favorites()->where('book_id', $book->id)->exists()) {
            $user->favorites()->detach($book->id);
        } else {
            $user->favorites()->attach($book->id);
        }

        return back()->with('success', 'Favorit diperbarui');
    }

    public function index()
    {
        $favorites = auth()->user()->favorites()->paginate(12);

        return view('favorites.index', compact('favorites'));
    }
}
