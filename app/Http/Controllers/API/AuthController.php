<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // -------------------------
    // REGISTER API USER
    // -------------------------
    public function register(Request $request)
    {
        // Validasi data input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // email harus unik
            'password' => 'required|string|min:6|confirmed'
            // "confirmed" artinya harus ada field password_confirmation
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']) // password di-hash
        ]);

        // Membuat token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        // Response API
        return response()->json([
            'message' => 'User berhasil register',
            'user' => $user,
            'token' => $token
        ], 201);
    }


    // -------------------------
    // LOGIN USER API
    // -------------------------
    public function login(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah user ada
        $user = User::where('email', $data['email'])->first();

        // Cek password benar atau tidak
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Buat token API
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token
        ]);
    }


    // -------------------------
    // LOGOUT API (hapus token)
    // -------------------------
    public function logout(Request $request)
    {
        // Menghapus token yang sedang dipakai user
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }
}
