@extends('layouts.app')

@section('content')

<style>
    :root {
        --pink-main: #ff4f9a;
        --pink-soft: #ff9ecb;
        --pink-bg: #fff3fa;
        --pink-dark: #d93676;
    }

    .filter-box {
        background: white;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(255, 79, 154, 0.15);
        margin-bottom: 30px;
    }

    .book-card {
        background: white;
        border-radius: 18px;
        padding: 18px;
        border: 2px solid #ffe0ef;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: 0.3s ease;
        height: 100%;
    }

    .book-card:hover {
        transform: translateY(-6px);
        border-color: var(--pink-main);
        box-shadow: 0 18px 35px rgba(255, 79, 154, 0.25);
    }

    .book-cover {
        height: 200px;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 12px;
        width: 100%;
    }

    .badge-category {
        background: var(--pink-soft);
        color: #000;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-pink {
        background: var(--pink-main);
        color: white;
        border-radius: 12px;
        font-weight: 600;
        transition: 0.25s ease;
    }

    .btn-pink:hover {
        background: var(--pink-dark);
        transform: translateY(-2px);
    }
</style>

{{-- ===================== HEADER ===================== --}}
<div class="mb-4">
    <h2 class="fw-bold" style="color: var(--pink-dark);">
        📚 Jelajahi Koleksi Buku
    </h2>
    <p class="text-muted">
        Temukan buku favoritmu berdasarkan judul atau kategori
    </p>
</div>

{{-- ===================== FILTER ===================== --}}
<div class="filter-box">
    <form method="GET" action="{{ route('books.browse') }}">
        <div class="row g-3 align-items-end">

            {{-- SEARCH --}}
            <div class="col-md-5">
                <label class="form-label fw-semibold">Cari Judul Buku</label>
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Contoh: Pemrograman Web"
                       value="{{ request('search') }}">
            </div>

            {{-- CATEGORY --}}
            <div class="col-md-4">
                <label class="form-label fw-semibold">Kategori</label>
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
            <div class="col-md-3">
                <button class="btn btn-pink w-100">
                    🔍 Cari Buku
                </button>
            </div>

        </div>
    </form>
</div>

{{-- ===================== BOOK LIST ===================== --}}
<div class="row">
    @forelse ($books as $book)
        <div class="col-6 col-md-3 mb-4">
            <div class="book-card">

                {{-- COVER --}}
                @if($book->cover_path)
                    <img src="{{ asset('storage/'.$book->cover_path) }}"
                         class="book-cover">
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Cover"
                         class="book-cover">
                @endif

                {{-- CATEGORY --}}
                <span class="badge-category mb-2 d-inline-block">
                    {{ $book->category->name ?? 'Tanpa Kategori' }}
                </span>

                {{-- TITLE --}}
                <h6 class="fw-bold mt-2" style="color: var(--pink-dark);">
                    {{ $book->title }}
                </h6>

                {{-- AUTHOR --}}
                <p class="text-muted small mb-1">
                    ✍️ {{ $book->author ?? '-' }}
                </p>

                {{-- STOCK --}}
                <p class="small">
                    📦 Tersedia:
                    <strong>{{ $book->available_copies }}</strong>
                </p>

                {{-- ACTION --}}
                <div class="d-grid gap-2">



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
<div class="d-flex justify-content-center mt-4">
    {{ $books->withQueryString()->links() }}
</div>

@endsection
