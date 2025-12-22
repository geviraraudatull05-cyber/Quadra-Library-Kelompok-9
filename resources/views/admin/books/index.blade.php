@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4 page-fade">
    <div>
        <h3 class="fw-semibold text-pink mb-1 page-title">
    Manajemen Buku
        </h3>
        <small class="text-muted">Kelola koleksi buku perpustakaan</small>
    </div>

    <a href="{{ route('admin.books.create') }}" class="btn btn-pink shadow-sm">
        <i class="fas fa-plus me-1"></i> Tambah Buku
    </a>
</div>

{{-- ALERT --}}
@if (session('success'))
    <div class="alert alert-success alert-soft page-fade">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
    </div>
@endif

{{-- GRID --}}
<div class="row g-4">
@foreach ($books as $book)
    <div class="col-lg-3 col-md-4 col-sm-6 card-animate">
        <div class="card book-card h-100 border-0">

            {{-- COVER --}}
            <div class="book-cover">
                <img src="{{ $book->cover_path
                    ? asset('storage/'.$book->cover_path)
                    : 'https://via.placeholder.com/300x230?text=No+Cover' }}">
            </div>

            <div class="card-body d-flex flex-column">

                {{-- KATEGORI --}}
                <span class="badge badge-pink mb-2">
                    {{ $book->category->name ?? 'Tanpa Kategori' }}
                </span>

                {{-- TITLE --}}
                <h6 class="fw-semibold text-dark mb-1 text-truncate">
                    {{ $book->title }}
                </h6>

                {{-- AUTHOR --}}
                <small class="text-muted mb-2">
                    <i class="fas fa-user-edit me-1"></i>
                    {{ $book->author ?? '-' }}
                </small>

                {{-- STOCK --}}
                <small class="mb-3">
                    Stok tersedia:
                    <b class="{{ $book->available_copies > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $book->available_copies }}
                    </b>
                </small>

                {{-- ACTION --}}
                <div class="mt-auto d-flex gap-2">
                    <a href="{{ route('admin.books.edit',$book) }}"
                       class="btn btn-sm btn-outline-pink w-100">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('admin.books.destroy',$book) }}"
                          class="w-100">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus buku ini?')"
                                class="btn btn-sm btn-outline-danger w-100">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach
</div>

{{-- PAGINATION --}}
<div class="mt-5 d-flex justify-content-center page-fade">
    {{ $books->links() }}
</div>

{{-- STYLE --}}
<style>
/* =====================
   COLOR SYSTEM
===================== */
:root {
    --pink-main: #e83e8c;
    --pink-hover: #d63384;
    --pink-soft: rgba(232,62,140,.08);
    --pink-border: rgba(232,62,140,.25);
    --pink-shadow: rgba(232,62,140,.18);
}

/* =====================
   HEADER
===================== */
.text-pink {
    color: var(--pink-main);
}

.page-title {
    border-left: 4px solid var(--pink-main);
    padding-left: 12px;
}

/* =====================
   BUTTON
===================== */
.btn-pink {
    background: var(--pink-main);
    color: #fff;
    border-radius: 8px;
    padding: 8px 16px;
}
.btn-pink:hover {
    background: var(--pink-hover);
    color: #fff;
}

.btn-outline-pink {
    border: 1px solid var(--pink-main);
    color: var(--pink-main);
}
.btn-outline-pink:hover {
    background: var(--pink-main);
    color: #fff;
}

/* =====================
   CARD
===================== */
.book-card {
    border-radius: 14px;
    border: 1px solid var(--pink-border);
    box-shadow: 0 10px 28px rgba(0,0,0,.06);
    transition: all .25s ease;
}
.book-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 38px var(--pink-shadow);
    border-color: var(--pink-main);
}

/* =====================
   COVER
===================== */
.book-cover {
    aspect-ratio: 4 / 5;
    overflow: hidden;
    background: var(--pink-soft);
}


.book-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
}

.book-card:hover .book-cover img {
    transform: scale(1.04);
}


/* =====================
   BADGE
===================== */
.badge-pink {
    background: var(--pink-soft);
    color: var(--pink-main);
    font-weight: 600;
    border-radius: 12px;
    padding: 5px 10px;
}

/* =====================
   ALERT
===================== */
.alert-soft {
    background: rgba(232,62,140,.1);
    border: none;
    color: var(--pink-hover);
}

/* =====================
   ANIMATION
===================== */
.page-fade {
    animation: fade .4s ease both;
}
.card-animate {
    animation: fadeUp .45s ease both;
}

@keyframes fade {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>

@endsection
