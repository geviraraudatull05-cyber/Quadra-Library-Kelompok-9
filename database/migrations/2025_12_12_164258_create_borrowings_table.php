<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration
     */
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();

            // Relasi ke siswa (user)
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Relasi ke buku
            $table->foreignId('book_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Tanggal peminjaman
            $table->date('borrowed_at');

            // Batas pengembalian
            $table->date('due_at');

            // Tanggal dikembalikan (nullable)
            $table->date('returned_at')->nullable();

            // Status peminjaman
            $table->enum('status', [
                'borrowed',   // sedang dipinjam
                'returned',   // sudah dikembalikan
                'late'        // terlambat
            ])->default('borrowed');

            // Catatan admin (opsional)
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Rollback migration
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
