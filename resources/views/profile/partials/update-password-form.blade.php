<section class="card mb-4 shadow-sm">
    <div class="card-body">

        {{-- HEADER --}}
        <h5 class="fw-bold mb-1">
            🔐 Ubah Password
        </h5>
        <p class="text-muted mb-4">
            Gunakan password yang kuat agar akun Anda tetap aman.
        </p>

        {{-- FORM --}}
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            {{-- PASSWORD LAMA --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Password Saat Ini
                </label>
                <input type="password"
                       name="current_password"
                       class="form-control"
                       autocomplete="current-password"
                       placeholder="Masukkan password lama">

                @error('current_password', 'updatePassword')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- PASSWORD BARU --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Password Baru
                </label>
                <input type="password"
                       name="password"
                       class="form-control"
                       autocomplete="new-password"
                       placeholder="Minimal 8 karakter">

                @error('password', 'updatePassword')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Konfirmasi Password Baru
                </label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       autocomplete="new-password"
                       placeholder="Ulangi password baru">

                @error('password_confirmation', 'updatePassword')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- ACTION --}}
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-pink-premium">
                    💾 Simpan Password
                </button>

                @if (session('status') === 'password-updated')
                    <span class="text-success small">
                        ✔️ Password berhasil diperbarui
                    </span>
                @endif
            </div>

        </form>
    </div>
</section>
