<?php

namespace App\Http\Controllers;

use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil buku terbaru untuk preview
        $books = Book::latest()->limit(8)->get();

        return view('dashboard', compact('books'));
    }
}
