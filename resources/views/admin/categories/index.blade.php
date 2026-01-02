@extends('layouts.app')

@section('content')

<div class="page-shell">

    {{-- HEADER --}}
    <div class="page-header-modern fade-in position-relative mb-4">
        <div class="floating-shape" style="top:-35px; left:-30px;"></div>
        <div class="floating-shape" style="bottom:-45px; right:-55px; width:130px; height:130px;"></div>

        <div>
            <div class="eyebrow mb-2">Panel Admin</div>
            <h1 class="hero-title-strong mb-1">Manajemen Kategori</h1>
            <p class="hero-subtitle mb-0">Kelola label pengelompokan koleksi buku</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="pill-action pill-soft">Total: {{ $categories->total() }}</span>
            <a href="{{ route('admin.categories.create') }}" class="pill-action pill-gradient">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card surface-card border-0 shadow-sm fade-in">
        <div class="card-body p-0">

            <table class="table table-modern align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th style="width: 70px;">#</th>
                        <th class="text-start">Nama Kategori</th>
                        <th style="width: 150px;">Jumlah Buku</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($categories as $category)
                        <tr>
                            <td class="text-center fw-bold text-pink">
                                {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                            </td>

                            <td class="fw-semibold">
                                <i class="fas fa-tag text-pink me-2"></i>
                                {{ $category->name }}
                            </td>

                            <td class="text-center">
                                <span class="badge badge-pink rounded-pill text-white">
                                    {{ $category->books_count }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-chip btn-outline-pink me-1">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                            class="btn btn-chip btn-outline-danger">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon">📂</div>
                                    <div class="fw-semibold">Belum ada kategori ditambahkan</div>
                                    <small class="text-muted">Tambahkan kategori untuk mengelompokkan koleksi</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-center page-fade">
        {{ $categories->links('vendor.pagination.default') }}
    </div>

</div>

{{-- STYLES --}}
<style>
:root {
    --pink-main: #ff4f9a;
    --pink-soft: #ffe0ef;
    --pink-bg: #fff5fb;
    --pink-dark: #d93676;
    --pink-border: #ffd1e4;
}

.text-pink { color: var(--pink-main); }

.surface-card {
    border-radius: 18px;
    border: 2px solid #ffe8f3;
    overflow: hidden;
}

.table-modern thead {
    background: linear-gradient(120deg, #ff4f9a, #ff85b3);
    color: #fff;
}

.table-modern th {
    font-weight: 800;
    letter-spacing: 0.2px;
    border: none !important;
    padding: 14px 16px;
    text-transform: uppercase;
    font-size: 12px;
}

.table-modern td {
    padding: 14px 16px;
    vertical-align: middle;
    border-color: #f7dceb;
}

.table-modern tbody tr { transition: all .2s ease; }
.table-modern tbody tr:hover {
    background: #fff7fb;
    transform: translateY(-1px);
}

.badge-pink {
    background: linear-gradient(135deg, #ff6fb1, #ff3f8f);
    font-size: 13px;
    font-weight: 700;
    padding: 7px 14px;
    box-shadow: 0 12px 24px rgba(255,79,154,0.25);
}

.btn-chip {
    border-radius: 12px;
    padding: 8px 12px;
    font-weight: 800;
    border: 1px solid var(--pink-border);
    transition: all .2s ease;
    box-shadow: 0 8px 18px rgba(255,79,154,0.08);
}
.btn-chip:hover { transform: translateY(-1px); }
.btn-outline-pink { color: var(--pink-main); border-color: var(--pink-border); }
.btn-outline-pink:hover { background: linear-gradient(135deg, #ff6fb1, #ff3f8f); color: #fff; border-color: transparent; }

.btn-outline-danger { border-radius: 12px; }

.empty-state {
    background: #fff7fb;
    border: 2px dashed #ffcce5;
    border-radius: 14px;
    padding: 24px;
    display: inline-block;
}
.empty-icon { font-size: 28px; margin-bottom: 8px; }

.page-fade { animation: fadeUp .4s ease; }
@keyframes fadeUp { from { opacity:0; transform: translateY(10px);} to { opacity:1; transform: translateY(0);} }
</style>
@endsection
