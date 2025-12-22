<section class="card mb-4">
    <div class="card-body">

        <h5 class="fw-bold mb-1">
            👤 Informasi Profil
        </h5>
        <p class="text-muted mb-4">
            Perbarui nama dan email akun Anda.
        </p>

        {{-- FORM VERIFIKASI EMAIL --}}
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        {{-- FORM UPDATE PROFILE --}}
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="form-control"
                       required>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="form-control"
                       required>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

                {{-- EMAIL BELUM VERIFIKASI --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3">
                        Email belum diverifikasi.
                        <button form="send-verification" class="btn btn-sm btn-outline-dark ms-2">
                            Kirim ulang verifikasi
                        </button>
                    </div>
                @endif
            </div>

            {{-- BUTTON --}}
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-pink-premium">
                    💾 Simpan Perubahan
                </button>

                @if (session('status') === 'profile-updated')
                    <span class="text-success small">
                        ✔️ Tersimpan
                    </span>
                @endif
            </div>

        </form>
    </div>
</section>
