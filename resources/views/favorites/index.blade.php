@extends('layouts.app')

@section('content')

<div class="page-shell">

    {{-- HEADER --}}
    <div class="page-header-modern fade-in position-relative mb-4">
        <div class="floating-shape" style="top:-30px; left:-20px;"></div>
        <div class="floating-shape" style="bottom:-40px; right:-40px; width:120px; height:120px;"></div>

        <div>
            <div class="eyebrow mb-2">Koleksi Pribadi</div>
            <h1 class="hero-title-strong mb-1">❤️ Buku Favorit Saya</h1>
            <p class="hero-subtitle mb-0">Buku yang kamu simpan untuk dibaca atau dipinjam nanti</p>
        </div>

        <div class="d-none d-md-flex align-items-center gap-2">
            <span class="pill-action pill-soft">Total: {{ $favorites->count() }}</span>
        </div>
    </div>

    {{-- LIST --}}
    @if($favorites->isEmpty())
        <div class="alert alert-info shadow-sm">Belum ada buku favorit.</div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
            @foreach($favorites as $book)
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
                                <a href="{{ route('borrowings.create', $book) }}" class="btn btn-gradient w-100">📖 Pinjam Buku</a>
                                <form action="{{ route('favorites.toggle', $book) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-ghost-light w-100">❌ Hapus dari Favorit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- PAGINATION (if paginated) --}}
    @if ($favorites instanceof \Illuminate\Pagination\Paginator || $favorites instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-4 page-fade">
            {{ $favorites->links('vendor.pagination.default') }}
        </div>
    @endif

</div>

{{-- STYLES --}}
<style>
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
@keyframes fadeUp { from { opacity: 0; transform: translateY(12px);} to { opacity: 1; transform: translateY(0);} }
</style>

@endsection
