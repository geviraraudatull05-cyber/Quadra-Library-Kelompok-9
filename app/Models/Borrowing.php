<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_at',
        'returned_at',
        'status',
        'note',
    ];

    /**
     * Casting otomatis ke Carbon (Laravel modern)
     */
    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_at'      => 'datetime',
        'returned_at' => 'datetime',
    ];

    /**
     * Relasi: peminjaman → user (siswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: peminjaman → buku
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
