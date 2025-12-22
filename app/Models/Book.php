<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrowing;
use App\Models\User;
use App\Models\Category;

class Book extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi melalui mass assignment
     */
    protected $fillable = [
        'category_id',       // ✅ WAJIB
        'title',
        'author',
        'isbn',
        'publisher',
        'year',
        'total_copies',
        'available_copies',
        'cover_path',
        'description',
    ];

    /**
     * Relasi: 1 buku bisa dipinjam berkali-kali
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Relasi: Buku bisa difavoritkan oleh banyak user
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Relasi: Buku milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
