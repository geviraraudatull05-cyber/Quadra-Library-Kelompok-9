@extends('layouts.app')

@section('content')

<div class="page-shell">

<style>
    :root {
        --pink-main: #ff4f9a;
        --pink-soft: #ff9ecb;
        --pink-bg: #fff3fa;
        --pink-dark: #d93676;
    }

    .filter-card {
        background: #fff;
        border: 1px solid #ffe0ef;
        border-radius: 16px;
        padding: 16px 18px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.06);
        margin-bottom: 18px;
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
        background: rgba(255,255,255,0.82);
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
    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 38px rgba(255,79,154,0.4);
    }

    .btn-search-primary {
        background: linear-gradient(135deg, #ff4f9a 0%, #ff85b3 100%);
        color: #fff;
        font-weight: 800;
        border: none;
        border-radius: 14px;
        padding: 12px 24px;
        box-shadow: 0 12px 28px rgba(255,79,154,0.35);
        transition: all .25s ease;
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .btn-search-primary::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.3), transparent);
        opacity: 0;
        transition: opacity .25s ease;
    }
    .btn-search-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(255,79,154,0.45);
    }
    .btn-search-primary:hover::before {
        opacity: 1;
    }

    .btn-search-reset {
        background: #fff;
        color: #ff4f9a;
        font-weight: 800;
        border: 2px solid #ffd0e4;
        border-radius: 14px;
        padding: 12px 24px;
        box-shadow: 0 10px 24px rgba(255,79,154,0.12);
        transition: all .25s ease;
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .btn-search-reset::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #ff6fb1, #ff3f8f);
        opacity: 0;
        transition: opacity .25s ease;
    }
    .btn-search-reset:hover {
        color: #fff;
        border-color: #ff4f9a;
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(255,79,154,0.3);
    }
    .btn-search-reset:hover::before {
        opacity: 1;
    }
    .btn-search-reset i {
        position: relative;
        z-index: 1;
    }
    .btn-search-reset span {
        position: relative;
        z-index: 1;
    }

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

{{-- ===================== HEADER ===================== --}}
<div class="page-header-modern fade-in position-relative mb-4">
    <div class="floating-shape" style="top:-30px; left:-20px;"></div>
    <div class="floating-shape" style="bottom:-40px; right:-40px; width:120px; height:120px;"></div>

    <div>
        <div class="eyebrow mb-2">Jelajahi Buku</div>
        <h1 class="hero-title-strong mb-1">📚 Koleksi Buku</h1>
        <p class="hero-subtitle mb-0">Temukan buku favoritmu berdasarkan judul atau kategori</p>
    </div>

    <div class="d-none d-md-flex align-items-center gap-2">
        <span class="pill-action pill-soft">Total: {{ ($books instanceof \Illuminate\Pagination\LengthAwarePaginator || $books instanceof \Illuminate\Pagination\Paginator) ? $books->total() : $books->count() }}</span>
    </div>
</div>

{{-- ===================== FILTER ===================== --}}
<div class="filter-card">
    <form method="GET" action="{{ route('books.browse') }}">
        <div class="row g-3 align-items-end">

            {{-- SEARCH --}}
            <div class="col-md-5">
                <label class="form-label fw-semibold text-muted">Cari Judul Buku</label>
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Contoh: Pemrograman Web"
                       value="{{ request('search') }}">
            </div>

            {{-- CATEGORY --}}
            <div class="col-md-4">
                <label class="form-label fw-semibold text-muted">Kategori</label>
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-search-primary" type="submit">
                    <i class="fas fa-search me-1"></i> Cari Buku
                </button>
                <a href="{{ route('books.browse') }}" class="btn btn-search-reset">
                    <i class="fas fa-redo me-1"></i> Reset
                </a>
            </div>

        </div>
    </form>
</div>

{{-- ===================== BOOK LIST ===================== --}}
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
    @forelse ($books as $book)
        <div class="col card-animate">
            <div class="book-card-premium h-100">

                {{-- COVER --}}
                <div class="book-cover-premium">
                    <img src="{{ $book->cover_path ? asset('storage/'.$book->cover_path) : 'https://via.placeholder.com/500x650?text=No+Cover' }}" alt="Cover {{ $book->title }}">
                    <span class="badge-glass">{{ $book->category->name ?? 'Tanpa Kategori' }}</span>
                    @if(($book->available_copies ?? 0) <= 0)
                        <span class="badge-stock badge-danger">Stok Habis</span>
                    @elseif(($book->available_copies ?? 0) < 3)
                        <span class="badge-stock badge-warning">Stok Terbatas</span>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">

                    {{-- TITLE --}}
                    <h6 class="fw-bold mb-1" style="color: var(--pink-dark);">{{ $book->title }}</h6>

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

                        {{-- PINJAM --}}
                        <a href="{{ route('borrowings.create', $book) }}"
                           class="btn btn-gradient btn-sm">
                            📖 Pinjam Buku
                        </a>

                        {{-- FAVORIT --}}
                        <form action="{{ route('favorites.toggle', $book) }}"
                              method="POST">
                            @csrf
                            <button class="btn btn-ghost-light btn-sm w-100">
                                ❤️ Favorit
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    @empty
        <p class="text-center text-muted">
            Tidak ada buku yang ditemukan 😢
        </p>
    @endforelse
</div>

{{-- ===================== PAGINATION ===================== --}}
<div class="d-flex justify-content-center mt-4 page-fade">
    {{ $books->withQueryString()->links('vendor.pagination.default') }}
</div>
</div>

@endsection
