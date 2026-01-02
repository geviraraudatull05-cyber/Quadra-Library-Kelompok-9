@extends('layouts.app')

@section('content')

<div class="page-shell">

    {{-- HEADER --}}
    <div class="page-header-modern fade-in position-relative mb-4">
        <div class="floating-shape" style="top:-30px; left:-30px;"></div>
        <div class="floating-shape" style="bottom:-40px; right:-50px; width:130px; height:130px;"></div>

        <div>
            <div class="eyebrow mb-2">Panel Admin</div>
            <h1 class="hero-title-strong mb-1">Manajemen Buku</h1>
            <p class="hero-subtitle mb-0">Kelola koleksi, stok, dan detail buku perpustakaan</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="pill-action pill-soft">Total: {{ $books->total() }}</span>
            <a href="{{ route('admin.books.create') }}" class="pill-action pill-gradient">
                <i class="fas fa-plus me-1"></i> Tambah Buku
            </a>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-card shadow-sm">
        <form method="GET" action="{{ route('admin.books.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-semibold text-muted">Cari judul / penulis / ISBN</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Contoh: Algoritma" />
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted">Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ ($categoryId ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-pink w-100" type="submit">
                        🔍 Cari
                    </button>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-ghost-pink w-100">Reset</a>
                </div>
            </div>
        </form>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-soft page-fade">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    {{-- GRID --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
    @foreach ($books as $book)
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

                    {{-- AUTHOR & META --}}
                    <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                        <i class="fas fa-user-pen"></i>
                        <span class="text-truncate">{{ $book->author ?? '-' }}</span>
                    </div>

                    <div class="chips mb-3">
                        <span class="chip">ISBN: {{ $book->isbn ?? '-' }}</span>
                        <span class="chip">Tahun: {{ $book->year ?? '-' }}</span>
                        <span class="chip">Stok: <b class="{{ ($book->available_copies ?? 0) > 0 ? 'text-success' : 'text-danger' }}">{{ $book->available_copies }}</b> / {{ $book->total_copies ?? '-' }}</span>
                    </div>

                    {{-- ACTION --}}
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('admin.books.edit',$book) }}" class="btn btn-sm btn-outline-pink w-100">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <form method="POST" action="{{ route('admin.books.destroy',$book) }}" class="w-100">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus buku ini?')"
                                    class="btn btn-sm btn-outline-danger w-100">
                                <i class="fas fa-trash me-1"></i> Hapus
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
        {{ $books->links('vendor.pagination.default') }}
    </div>

</div>

{{-- STYLE --}}
<style>
:root {
    --pink-main: #ff4f9a;
    --pink-dark: #d93676;
    --pink-soft: #ffe4f1;
    --card-border: #ffe0ef;
}

.alert-soft {
    background: rgba(255,79,154,0.08);
    border: 1px solid rgba(255,79,154,0.2);
    color: #c02866;
}

.book-card-premium {
    background: #fff;
    border-radius: 18px;
    border: 2px solid var(--card-border);
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
.book-card-premium:hover .book-cover-premium img {
    transform: scale(1.05);
}

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

.btn-outline-pink {
    border: 1px solid var(--pink-main);
    color: var(--pink-main);
    font-weight: 700;
    border-radius: 12px;
}
.btn-outline-pink:hover {
    background: var(--pink-main);
    color: #fff;
    box-shadow: 0 12px 26px rgba(255,79,154,0.35);
}

.btn-ghost-pink {
    background: #fff;
    color: var(--pink-main);
    border: 1px solid #ffd0e4;
    font-weight: 800;
    border-radius: 12px;
    box-shadow: 0 8px 18px rgba(255,79,154,0.08);
    transition: all .2s ease;
}
.btn-ghost-pink:hover {
    background: linear-gradient(135deg, #ff6fb1, #ff3f8f);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 14px 28px rgba(255,79,154,0.25);
    transform: translateY(-1px);
}

.btn-outline-danger {
    border-radius: 12px;
}

.filter-card {
    background: #fff;
    border: 1px solid #ffe0ef;
    border-radius: 16px;
    padding: 16px 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    margin-bottom: 18px;
}

.card-animate { animation: fadeUp .45s ease both; }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>

@endsection
