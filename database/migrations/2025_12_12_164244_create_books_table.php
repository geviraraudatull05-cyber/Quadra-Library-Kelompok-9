<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Relasi kategori
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();
            // Mengacu ke tabel categories

            $table->string('title');
            // Judul buku

            $table->string('author')->nullable();
            // Penulis

            $table->string('isbn')->nullable()->unique();
            // ISBN unik

            $table->string('publisher')->nullable();
            // Penerbit

            $table->year('year')->nullable();
            // Tahun terbit

            $table->integer('total_copies')->default(1);
            // Total buku

            $table->integer('available_copies')->default(1);
            // Buku tersedia

            $table->string('cover_path')->nullable();
            // Cover buku

            $table->text('description')->nullable();
            // Deskripsi

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
