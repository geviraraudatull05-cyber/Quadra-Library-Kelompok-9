<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat model di-serialize (API / JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting attribute khusus
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * =========================
     * RELATIONS
     * =========================
     */

    /**
     * 1 User (siswa) punya banyak peminjaman
     */
    public function borrowings()
    {
        return $this->hasMany(\App\Models\Borrowing::class);
    }

    /**
     * =========================
     * HELPER METHODS (ROLE)
     * =========================
     */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }
    public function favorites()
    {
        return $this->belongsToMany(Book::class, 'favorites')
                    ->withTimestamps();
    }

}
