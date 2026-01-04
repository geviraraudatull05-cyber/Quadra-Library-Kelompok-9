@extends('layouts.app')

@section('content')

<style>
:root {
    --pink-main: #ff4f9a;
    --pink-dark: #d93676;
}

.text-pink {
    color: var(--pink-main);
}

.card-pink {
    border-left: 6px solid var(--pink-main);
}

.input-pink:focus {
    border-color: var(--pink-main);
    box-shadow: 0 0 0 0.25rem rgba(255, 79, 154, 0.25);
}

.btn-pink {
    background: var(--pink-main);
    color: white;
    border-radius: 12px;
    font-weight: 600;
}

.btn-pink:hover {
    background: var(--pink-dark);
}

.btn-secondary {
    border-radius: 12px;
}

.form-label {
    font-weight: 600;
    color: #333;
}

.info-box {
    background: #f9f9f9;
    border-left: 4px solid var(--pink-main);
    padding: 12px 15px;
    border-radius: 4px;
    margin-bottom: 15px;
    font-size: 14px;
}
</style>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 card-pink">
            {{-- HEADER --}}
            <div class="card-header bg-white border-0">
                <h4 class="fw-bold text-pink mb-0">
                    ✏️ Edit User
                </h4>
                <small class="text-muted">
                    Ubah informasi user: nama, email, dan role
                </small>
            </div>

            <div class="card-body">
                {{-- INFO BOX --}}
                <div class="info-box">
                    <i class="fas fa-info-circle text-pink me-2"></i>
                    <strong>Info:</strong> Password tidak bisa diubah di sini. Gunakan menu "Ubah Password" jika perlu mengubah password.
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-1 text-pink"></i> Nama Lengkap
                        </label>
                        <input type="text"
                               class="form-control input-pink @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               placeholder="Masukkan nama lengkap"
                               required>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1 text-pink"></i> Email
                        </label>
                        <input type="email"
                               class="form-control input-pink @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               placeholder="contoh@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- ROLE --}}
                    <div class="mb-4">
                        <label for="role" class="form-label">
                            <i class="fas fa-user-shield me-1 text-pink"></i> Role / Peran
                        </label>
                        <select class="form-select input-pink @error('role') is-invalid @enderror"
                                id="role"
                                name="role"
                                required>
                            <option value="siswa" {{ old('role', $user->role) === 'siswa' ? 'selected' : '' }}>
                                👤 Siswa (Pengguna Biasa)
                            </option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                🔐 Admin (Pengelola Sistem)
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- ACTION BUTTON --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-pink flex-grow-1">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary flex-grow-1">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
