<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\API\BorrowingApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\FavoriteApiController;

/*
|--------------------------------------------------------------------------
| AUTH (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED API (SANCTUM)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES (READ ONLY)
    |--------------------------------------------------------------------------
    */
    Route::get('/categories', [CategoryApiController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | BOOKS
    |--------------------------------------------------------------------------
    */

    // 👨‍🎓 SISWA & ADMIN → lihat buku
    Route::get('/books', [BookApiController::class, 'index']);
    Route::get('/books/{book}', [BookApiController::class, 'show']);

    // 🔐 ADMIN ONLY → CRUD buku
    Route::middleware('role:admin')->group(function () {
        Route::post('/books', [BookApiController::class, 'store']);
        Route::put('/books/{book}', [BookApiController::class, 'update']);
        Route::delete('/books/{book}', [BookApiController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | BORROWINGS (SISWA)
    |--------------------------------------------------------------------------
    */

    // 👨‍🎓 lihat peminjaman sendiri
    Route::get('/borrowings', [BorrowingApiController::class, 'index']);

    // 👨‍🎓 pinjam buku
    Route::post('/borrowings', [BorrowingApiController::class, 'store']);

    // 👨‍🎓 kembalikan buku
    Route::patch(
        '/borrowings/{borrowing}/return',
        [BorrowingApiController::class, 'returnBook']
    );

    /*
    |--------------------------------------------------------------------------
    | BORROWINGS (ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('/borrowings', [BorrowingApiController::class, 'adminIndex']);
        Route::get('/borrowings/{borrowing}', [BorrowingApiController::class, 'show']);
        Route::delete('/borrowings/{borrowing}', [BorrowingApiController::class, 'destroy']);

    });

    /*
    |--------------------------------------------------------------------------
    | FAVORITES (SISWA)
    |--------------------------------------------------------------------------
    */
    Route::get('/favorites', [FavoriteApiController::class, 'index']);
    Route::post('/favorites/{book}', [FavoriteApiController::class, 'toggle']);

});
