<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Category extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi:
     * 1 kategori memiliki banyak buku
     * Category -> Books (one to many)
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
