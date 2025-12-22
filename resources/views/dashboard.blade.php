@extends('layouts.app')

@section('content')

<style>
/* ========================= THEME COLORS ========================= */
:root {
    --pink-main: #ff4f9a;
    --pink-soft: #ff9ecb;
    --pink-bg: #fff3fa;
    --pink-light: #ffd1e8;
    --pink-dark: #d93676;
}

/* ========================= GLOBAL ========================= */
body {
    background: var(--pink-bg);
}

.text-pink {
    color: var(--pink-main);
}

/* ========================= HERO ========================= */
.hero {
    background: linear-gradient(135deg, #ff4f9a, #ff89bc, #ffbfe0);
    border-radius: 35px;
    padding: 70px 50px;
    color: white;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(255, 77, 128, 0.25);
    margin-bottom: 60px;
}

.hero-logo-img {
    position: absolute;
    right: -40px;
    bottom: -10px;
    width: 480px;
    opacity: 0.18;
}

.hero-title {
    font-size: 48px;
    font-weight: 800;
}

.hero-subtitle {
    font-size: 20px;
    opacity: 0.95;
}

.team-name {
    background: rgba(255,255,255,.25);
    padding: 10px 22px;
    border-radius: 14px;
    display: inline-block;
    margin-top: 10px;
    font-weight: 600;
}

.hero-text {
    margin-top: 20px;
    width: 70%;
    font-size: 15.5px;
    line-height: 1.6;
}

.btn-hero {
    background: white;
    color: var(--pink-main);
    font-weight: 700;
    border-radius: 14px;
    padding: 10px 22px;
    transition: .25s var(--transition-easing, ease);
    box-shadow: 0 8px 20px rgba(255,77,154,0.12);
    transform: translateY(0);
    display: inline-flex;
    gap: 0.5rem;
    align-items: center;
}
.btn-hero:hover {
    background: var(--pink-light);
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 18px 40px rgba(255,77,154,0.18);
}
.btn-hero:active { transform: translateY(-2px) scale(0.99); }

@keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
    100% { transform: translateY(0); }
}

.btn-hero.pulse {
    animation: float 3s ease-in-out infinite;
}

/* Outline variant used for Login (white outline on hero background) */
.btn-hero-outline {
    background: transparent;
    color: white;
    border-radius: 14px;
    padding: 10px 22px;
    border: 2px solid rgba(255,255,255,0.22);
    backdrop-filter: blur(4px);
    font-weight: 700;
    transition: .25s var(--transition-easing, ease);
}
.btn-hero-outline:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

/* ========================= BOOK SECTION ========================= */
.section-title {
    font-weight: 700;
    font-size: 26px;
    color: var(--pink-dark);
    margin-bottom: 28px;
}

.book-card {
    background: white;
    border-radius: 18px;
    padding: 18px;
    border: 2px solid #ffe0ef;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: .3s ease;
    height: 100%;
}
.book-card:hover {
    transform: translateY(-6px);
    border-color: var(--pink-main);
    box-shadow: 0 18px 35px rgba(255,79,154,.25);
}

.book-cover {
    height: 200px;
    width: 100%;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 12px;
}

.badge-category {
    background: var(--pink-soft);
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 10px;
    font-weight: 600;
}

.btn-book {
    background: var(--pink-main);
    color: white;
    border-radius: 12px;
    font-weight: 600;
    transition: .25s;
}
.btn-book:hover {
    background: var(--pink-dark);
}

.btn-admin {
    background: #f1f1f1;
    color: #888;
    border-radius: 12px;
    font-weight: 600;
}
</style>

{{-- ========================= HERO ========================= --}}
<div class="hero">

    <img src="{{ asset('assets/logo.png') }}" class="hero-logo-img">

    <h1 class="hero-title">Quadra Library</h1>
    <p class="hero-subtitle">
        Sistem Informasi Perpustakaan Sekolah — Smart • Modern • Elegant
    </p>

    <p class="mt-3 mb-1">Dikembangkan oleh:</p>
    <div class="team-name">
        Quadra Team — Dealova • Gevira • Riri • Herfiani
    </div>

    <p class="hero-text">
        Quadra Library membantu siswa dan petugas dalam pencarian, pengelolaan,
        serta peminjaman buku dengan antarmuka modern dan nyaman.
    </p>

    <div class="mt-4">
        @guest
            <a href="{{ route('login') }}" class="btn btn-hero-outline px-4 me-2 pulse">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-hero pulse">
                <i class="fa-solid fa-user-plus"></i>
                Register
            </a>
        @endguest

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.books.index') }}" class="btn btn-light px-4">
                    Kelola Koleksi Buku →
                </a>
            @else
                <a href="{{ route('books.browse') }}" class="btn btn-light px-4">
                    Jelajahi Buku
                </a>
            @endif
        @endauth
    </div>
</div>

{{-- ========================= BOOK LIST ========================= --}}
<h3 class="section-title">📖 Koleksi Buku Terbaru</h3>

<div class="row">
@forelse ($books as $book)
    <div class="col-6 col-md-3 mb-4">
        <div class="book-card">

            {{-- COVER --}}
            <img src="{{ $book->cover_path
                ? asset('storage/'.$book->cover_path)
                : 'https://via.placeholder.com/300x200?text=No+Cover' }}"
                 class="book-cover">

            {{-- CATEGORY --}}
            <span class="badge-category">
                {{ $book->category->name ?? 'Tanpa Kategori' }}
            </span>

            {{-- TITLE --}}
            <h6 class="fw-bold mt-2 text-pink">
                {{ $book->title }}
            </h6>

            {{-- AUTHOR --}}
            <p class="text-muted small mb-1">
                ✍️ {{ $book->author ?? '-' }}
            </p>

            {{-- STOCK --}}
            <p class="small">
                📦 Tersedia: <strong>{{ $book->available_copies }}</strong>
            </p>

            {{-- ACTION --}}
            <div class="d-grid gap-2">

                {{-- GUEST --}}
                @guest
                    <a href="{{ route('login') }}" class="btn btn-book btn-sm">
                        Login untuk Meminjam
                    </a>
                @endguest

                {{-- AUTH --}}
                @auth

                    {{-- ADMIN --}}
                    @if(auth()->user()->isAdmin())
                        <button class="btn btn-admin btn-sm" disabled>
                            👀 Mode Admin
                        </button>

                    {{-- SISWA --}}
                    @else
                        <a href="{{ route('books.browse') }}" class="btn btn-book btn-sm">
                            📖 Jelajahi Buku
                        </a>
                    @endif

                @endauth
            </div>

        </div>
    </div>
@empty
    <p class="text-center text-muted">
        Belum ada buku yang ditambahkan 😢
    </p>
@endforelse
</div>

{{-- PAGINATION --}}
@if ($books instanceof \Illuminate\Pagination\Paginator || $books instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
@endif

@endsection
