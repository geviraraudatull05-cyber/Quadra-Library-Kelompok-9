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
    bottom: 20px;
    width: 380px;
    opacity: 0.18;
}

.hero-title {
    font-size: 48px;
    font-weight: 900;
    color: #fff;
    text-shadow: 0 8px 25px rgba(0,0,0,0.18);
}

.hero-subtitle {
    font-size: 20px;
    opacity: 0.95;
    color: #ffeef8;
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

.btn-hero-primary {
    background: #fff;
    color: #d12b71;
    font-weight: 850;
    letter-spacing: 0.2px;
    border-radius: 999px;
    padding: 12px 24px;
    box-shadow: 0 14px 32px rgba(0, 0, 0, 0.16);
    border: 1px solid rgba(255, 255, 255, 0.4);
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}
.btn-hero-primary::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 40% 40%, rgba(255, 79, 154, 0.18), transparent 60%);
    opacity: 0;
    transition: opacity 0.25s ease;
}
.btn-hero-primary:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
    color: #b31f61;
}
.btn-hero-primary:hover::after {
    opacity: 1;
}

.btn-hero-ghost {
    background: linear-gradient(120deg, #ff4f9a 0%, #ff7fbc 45%, #ffb5d8 100%);
    background-size: 200% 200%;
    color: white;
    font-weight: 850;
    border-radius: 999px;
    padding: 12px 24px;
    border: 1px solid rgba(255, 255, 255, 0.35);
    box-shadow: 0 16px 34px rgba(255, 79, 154, 0.35);
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}
.btn-hero-ghost::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.35), transparent 55%);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.btn-hero-ghost:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 20px 44px rgba(255, 79, 154, 0.45);
    background-position: 100% 0;
}
.btn-hero-ghost:hover::after {
    opacity: 1;
}

.btn-hero-solid {
    background: linear-gradient(120deg, #ff4f9a 0%, #ff7fbc 45%, #ffbfe0 100%);
    background-size: 220% 220%;
    color: #fff;
    font-weight: 850;
    letter-spacing: 0.15px;
    border-radius: 999px;
    padding: 13px 26px;
    border: none;
    box-shadow: 0 18px 42px rgba(255, 79, 154, 0.35);
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}
.btn-hero-solid::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.35), transparent 55%);
    opacity: 0;
    transition: opacity 0.3s ease, background-position 0.3s ease;
}
.btn-hero-solid:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 22px 48px rgba(255, 79, 154, 0.45);
    background-position: 100% 0;
}
.btn-hero-solid:hover::after { opacity: 1; }

.btn-hero-soft {
    background: #fff;
    color: #d12b71;
    font-weight: 800;
    letter-spacing: 0.1px;
    border-radius: 999px;
    padding: 13px 24px;
    border: 1px solid rgba(255, 79, 154, 0.25);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}
.btn-hero-soft::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 40% 40%, rgba(255, 79, 154, 0.12), transparent 60%);
    opacity: 0;
    transition: opacity 0.25s ease;
}
.btn-hero-soft:hover {
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 18px 36px rgba(0, 0, 0, 0.18);
    color: #b21f63;
}
.btn-hero-soft:hover::after { opacity: 1; }

.btn-hero-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.25);
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.35);
    animation: pulseGlow 2s ease-in-out infinite;
}

@keyframes pulseGlow {
    0% { box-shadow: inset 0 0 0 1px rgba(255,255,255,0.25); opacity: 0.9; }
    50% { box-shadow: inset 0 0 0 2px rgba(255,255,255,0.4); opacity: 1; }
    100% { box-shadow: inset 0 0 0 1px rgba(255,255,255,0.25); opacity: 0.9; }
}

/* ========================= BOOK SECTION ========================= */
.section-title {
    font-weight: 800;
    font-size: 26px;
    color: var(--pink-dark);
    margin-bottom: 28px;
}

.book-card-premium {
    background: #fff;
    border-radius: 18px;
    border: 2px solid #ffe0ef;
    box-shadow: 0 18px 38px rgba(0,0,0,0.08);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
}
.book-card-premium:hover {
    transform: translateY(-6px);
    border-color: var(--pink-main);
    box-shadow: 0 24px 52px rgba(255,79,154,0.18);
}

.book-cover-premium {
    position: relative;
    aspect-ratio: 4 / 5;
    overflow: hidden;
    background: linear-gradient(135deg, #ffe4f1, #ffd6ea);
}
.book-cover-premium img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}
.book-card-premium:hover .book-cover-premium img { transform: scale(1.05); }

.badge-glass {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(255,255,255,0.8);
    color: #c02866;
    padding: 6px 10px;
    border-radius: 12px;
    font-weight: 700;
    backdrop-filter: blur(4px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.06);
}
.badge-stock {
    position: absolute;
    bottom: 12px;
    left: 12px;
    padding: 6px 10px;
    border-radius: 12px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 10px 22px rgba(0,0,0,0.1);
}
.badge-warning { background: linear-gradient(135deg, #ffb347, #ff6f61); }
.badge-danger  { background: linear-gradient(135deg, #ff7b7b, #ff3d6f); }

.chips { display: flex; flex-wrap: wrap; gap: 6px; }
.chip {
    background: var(--pink-soft);
    color: #7a2a57;
    padding: 6px 10px;
    border-radius: 12px;
    font-size: 12px;
    border: 1px dashed rgba(217,54,118,0.25);
}

.btn-gradient {
    background: linear-gradient(135deg, #ff6fb1, #ff3f8f);
    color: #fff;
    font-weight: 800;
    border: none;
    border-radius: 12px;
    box-shadow: 0 14px 30px rgba(255,79,154,0.3);
    transition: all .2s ease;
}
.btn-gradient:hover { transform: translateY(-1px); }

.btn-ghost-light {
    background: #fff;
    color: var(--pink-main);
    border: 1px solid #ffd0e4;
    font-weight: 800;
    border-radius: 12px;
    box-shadow: 0 8px 18px rgba(255,79,154,0.08);
    transition: all .2s ease;
}
.btn-ghost-light:hover {
    background: linear-gradient(135deg, #ff6fb1, #ff3f8f);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 14px 28px rgba(255,79,154,0.25);
    transform: translateY(-1px);
}

.card-animate { animation: fadeUp .45s ease both; }
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
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
            <a href="{{ route('login') }}" class="btn-hero-primary me-2">
                <span class="btn-hero-icon"><i class="fas fa-sign-in-alt"></i></span> Login
            </a>
            <a href="{{ route('register') }}" class="btn-hero-ghost">
                <span class="btn-hero-icon"><i class="fas fa-user-plus"></i></span> Register
            </a>
        @endguest

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.books.index') }}" class="btn-hero-solid me-2">
                    <span class="btn-hero-icon"><i class="fas fa-layer-group"></i></span> Kelola Koleksi Buku
                </a>
            @else
                <a href="{{ route('books.browse') }}" class="btn-hero-solid me-2">
                    <span class="btn-hero-icon"><i class="fas fa-compass"></i></span> Jelajahi Buku
                </a>
                <a href="{{ route('favorites.index') }}" class="btn-hero-soft">
                    <span class="btn-hero-icon"><i class="fas fa-heart"></i></span> Buku Favorit
                </a>
            @endif
        @endauth
    </div>
</div>

{{-- ========================= BOOK LIST ========================= --}}
<h3 class="section-title">📖 Koleksi Buku Terbaru</h3>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
@forelse ($books as $book)
    <div class="col card-animate">
        <div class="book-card-premium h-100">

            {{-- COVER --}}
            <div class="book-cover-premium">
                <img src="{{ $book->cover_path
                    ? asset('storage/'.$book->cover_path)
                    : 'https://via.placeholder.com/500x650?text=No+Cover' }}" alt="Cover {{ $book->title }}">
                <span class="badge badge-glass">{{ $book->category->name ?? 'Tanpa Kategori' }}</span>
                @if(($book->available_copies ?? 0) <= 0)
                    <span class="badge badge-stock badge-danger">Stok Habis</span>
                @elseif(($book->available_copies ?? 0) < 3)
                    <span class="badge badge-stock badge-warning">Stok Terbatas</span>
                @endif
            </div>

            <div class="card-body d-flex flex-column">

                {{-- TITLE --}}
                <h6 class="fw-bold mb-1 text-dark text-truncate">{{ $book->title }}</h6>

                {{-- AUTHOR --}}
                <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                    <i class="fas fa-user-pen"></i>
                    <span class="text-truncate">{{ $book->author ?? '-' }}</span>
                </div>

                {{-- META --}}
                <div class="chips mb-3">
                    <span class="chip">ISBN: {{ $book->isbn ?? '-' }}</span>
                    <span class="chip">Tahun: {{ $book->year ?? '-' }}</span>
                    <span class="chip">Stok: <b class="{{ ($book->available_copies ?? 0) > 0 ? 'text-success' : 'text-danger' }}">{{ $book->available_copies }}</b></span>
                </div>

                {{-- ACTION --}}
                <div class="mt-auto d-grid gap-2">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-gradient w-100">Login untuk Meminjam</a>
                    @endguest

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.books.index') }}" class="btn btn-ghost-light w-100">Kelola Koleksi</a>
                        @else
                            <a href="{{ route('borrowings.create', $book) }}" class="btn btn-gradient w-100">📖 Pinjam Buku</a>
                            <form action="{{ route('favorites.toggle', $book) }}" method="POST">
                                @csrf
                                <button class="btn btn-ghost-light w-100">❤️ Favorit</button>
                            </form>
                        @endif
                    @endauth
                </div>

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
        {{ $books->links('vendor.pagination.default') }}
    </div>
@endif

@endsection
