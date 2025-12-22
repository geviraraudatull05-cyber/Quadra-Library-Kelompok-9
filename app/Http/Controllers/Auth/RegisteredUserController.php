<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // =========================
        // VALIDASI INPUT
        // =========================
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // =========================
        // SIMPAN USER (DEFAULT ROLE: SISWA)
        // =========================
        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower($validated['email']), // konsisten & aman
            'password' => $validated['password'], // otomatis di-hash (User model)
            'role' => 'siswa', // ROLE
        ]);

        // =========================
        // EVENT + AUTO LOGIN
        // =========================
        event(new Registered($user));
        Auth::login($user);

        // =========================
        // REDIRECT SETELAH REGISTER
        // =========================
        return redirect(RouteServiceProvider::HOME);
    }
}
