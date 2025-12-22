<x-guest-layout>

    {{-- STATUS SESSION (misal: password reset berhasil) --}}
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

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
                autofocus
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
                    autocomplete="current-password"
                >

                {{-- toggle password --}}
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

        {{-- REMEMBER ME --}}
        <div class="form-check mb-3">
            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember_me"
            >
            <label class="form-check-label" for="remember_me">
                Remember me
            </label>
        </div>

        {{-- SUBMIT --}}
        <button type="submit" class="btn-auth-primary">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </button>

    </form>

</x-guest-layout>
