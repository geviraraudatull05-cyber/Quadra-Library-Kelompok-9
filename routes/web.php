<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTH (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| PROFILE (SEMUA USER LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN / PETUGAS PERPUSTAKAAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        | MANAJEMEN USER
        */
        Route::resource('users', UserController::class)
            ->except(['show']);

        /*
        | KATEGORI BUKU
        */
        Route::resource('categories', CategoryController::class)
            ->except(['show']);

        /*
        | BUKU (CRUD)
        */
        Route::resource('books', BookController::class);

        /*
        | PEMINJAMAN (LIHAT SEMUA SISWA)
        */
        Route::get('/borrowings', [BorrowingController::class, 'adminIndex'])
            ->name('borrowings.index');
    });

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->group(function () {

    /*
    | JELAJAHI BUKU
    */
    Route::get('/jelajahi-buku', [BookController::class, 'browse'])
        ->name('books.browse');

    /*
    | PEMINJAMAN MILIK SISWA
    */
    Route::get('/borrowings', [BorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::get('/borrow/{book}', [BorrowingController::class, 'borrowForm'])
        ->name('borrowings.create');

    Route::post('/borrow', [BorrowingController::class, 'store'])
        ->name('borrowings.store');

    Route::post('/return/{borrowing}', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');

    /*
    | FAVORIT
    */
    Route::post('/favorites/{book}', [FavoriteController::class, 'toggle'])
        ->name('favorites.toggle');

    Route::get('/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');
});
