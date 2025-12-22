<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- NAMA --}}
        <div class="mb-3">
            <label for="name" class="form-label form-label-auth">
                Nama Lengkap
            </label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control form-control-auth @error('name') is-invalid @enderror"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label for="email" class="form-label form-label-auth">
                Email
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control form-control-auth @error('email') is-invalid @enderror"
                required
                autocomplete="username"
            >
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label for="password" class="form-label form-label-auth">
                Password
            </label>

            <div class="input-group-auth">
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control form-control-auth @error('password') is-invalid @enderror"
                    required
                    autocomplete="new-password"
                >

                <button type="button" class="toggle-password">
                    <i class="fas fa-eye"></i>
                </button>

                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label form-label-auth">
                Konfirmasi Password
            </label>

            <div class="input-group-auth">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control form-control-auth"
                    required
                    autocomplete="new-password"
                >

                <button type="button" class="toggle-password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        {{-- SUBMIT --}}
        <button type="submit" class="btn-auth-primary mt-2">
            <i class="fas fa-user-plus me-2"></i> Register
        </button>

    </form>

</x-guest-layout>
