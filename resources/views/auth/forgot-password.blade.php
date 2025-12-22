<x-guest-layout>

    {{-- Info Text --}}
    <div class="mb-4 text-center">
        <h5 class="fw-semibold mb-2">Lupa Password?</h5>
        <p class="text-muted small">
            Masukkan email yang terdaftar, kami akan mengirimkan link
            untuk mengatur ulang password kamu.
        </p>
    </div>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-3 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" class="mb-1"/>
            <x-text-input
                id="email"
                class="form-control-auth w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                placeholder="contoh@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Submit --}}
        <div class="d-grid mt-4">
            <button type="submit" class="btn-auth-primary">
                Kirim Link Reset Password
            </button>
        </div>

    </form>

</x-guest-layout>
