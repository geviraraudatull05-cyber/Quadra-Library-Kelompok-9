<x-guest-layout>

    {{-- Title --}}
    <div class="mb-4 text-center">
        <h5 class="fw-semibold mb-2">Konfirmasi Password</h5>
        <p class="text-muted small">
            Demi keamanan, silakan masukkan kembali password
            untuk melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        {{-- Password --}}
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" class="mb-1"/>
            <x-text-input
                id="password"
                class="form-control-auth w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Submit --}}
        <div class="d-grid mt-4">
            <button type="submit" class="btn-auth-primary">
                Konfirmasi & Lanjutkan
            </button>
        </div>


    </form>

</x-guest-layout>
