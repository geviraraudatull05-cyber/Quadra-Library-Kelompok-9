<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * ============================
     * LIST SEMUA USER
     * ============================
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * ============================
     * FORM TAMBAH USER BARU
     * ============================
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * ============================
     * SIMPAN USER BARU
     * ============================
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required', 'in:admin,siswa'],
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin atau siswa',
        ]);

        // Buat user baru
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', "User '{$validated['name']}' berhasil ditambahkan");
    }

    /**
     * ============================
     * FORM EDIT USER
     * ============================
     */
    public function edit(User $user)
    {
        // Hindari admin mengedit admin lain (opsional, sesuai kebijakan)
        // Atau allow semua, tergantung kebutuhan

        return view('admin.users.edit', compact('user'));
    }

    /**
     * ============================
     * UPDATE USER
     * ============================
     */
    public function update(Request $request, User $user)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,{$user->id}"],
            'role' => ['required', 'in:admin,siswa'],
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan user lain',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin atau siswa',
        ]);

        // Update user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', "User '{$validated['name']}' berhasil diperbarui");
    }

    /**
     * ============================
     * HAPUS USER
     * ============================
     */
    public function destroy(User $user)
    {
        // Jangan biarkan menghapus user sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', "User '{$userName}' berhasil dihapus");
    }
}
