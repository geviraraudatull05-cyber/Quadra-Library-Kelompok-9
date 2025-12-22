@extends('layouts.app')

@section('content')
<div class="container fade-in py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-pink animate-slide">
            ➕ Tambah Kategori Buku
        </h3>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-outline-pink rounded-pill px-4 animate-fade">
            ← Kembali
        </a>
    </div>

    {{-- CARD --}}
    <div class="card card-pink shadow-lg border-0 rounded-4 animate-pop">
        <div class="card-body p-5">

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                {{-- INPUT --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold text-pink">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control form-control-lg rounded-4
                                  input-pink @error('name') is-invalid @enderror"
                           placeholder="Contoh: Novel, Teknologi, Sejarah"
                           value="{{ old('name') }}"
                           required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ACTION --}}
                <div class="d-flex justify-content-end">
                    <button type="submit"
                            class="btn btn-pink-gradient rounded-pill px-5 py-2 animate-bounce">
                        <i class="fas fa-save me-1"></i> Simpan Kategori
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@section('styles')
<style>
/* ===================== THEME PINK ===================== */
:root {
    --pink-main: #e84393;
    --pink-soft: #ffe3f0;
    --pink-dark: #c2185b;
    --pink-gradient: linear-gradient(135deg, #ff5fa2, #e84393);
}

.text-pink {
    color: var(--pink-main);
}

/* ===================== BUTTON ===================== */
.btn-outline-pink {
    border: 2px solid var(--pink-main);
    color: var(--pink-main);
    transition: 0.3s;
}
.btn-outline-pink:hover {
    background: var(--pink-main);
    color: white;
}

.btn-pink-gradient {
    background: var(--pink-gradient);
    color: white;
    border: none;
    box-shadow: 0 10px 25px rgba(232, 67, 147, 0.35);
    transition: 0.3s ease;
}
.btn-pink-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 30px rgba(232, 67, 147, 0.5);
}

/* ===================== CARD ===================== */
.card-pink {
    background: white;
    border-left: 6px solid var(--pink-main);
}

/* ===================== INPUT ===================== */
.input-pink:focus {
    border-color: var(--pink-main);
    box-shadow: 0 0 0 0.25rem rgba(232, 67, 147, 0.25);
}

/* ===================== ANIMATIONS ===================== */
.fade-in {
    animation: fadeIn 0.6s ease forwards;
}

.animate-slide {
    animation: slideDown 0.6s ease;
}

.animate-pop {
    animation: popUp 0.6s ease;
}

.animate-bounce:hover {
    animation: bounce 0.4s;
}

@keyframes fadeIn {
    from { opacity: 0 }
    to { opacity: 1 }
}

@keyframes slideDown {
    from { transform: translateY(-20px); opacity: 0 }
    to { transform: translateY(0); opacity: 1 }
}

@keyframes popUp {
    from { transform: scale(0.95); opacity: 0 }
    to { transform: scale(1); opacity: 1 }
}

@keyframes bounce {
    0% { transform: translateY(0) }
    50% { transform: translateY(-4px) }
    100% { transform: translateY(0) }
}
</style>
@endsection
