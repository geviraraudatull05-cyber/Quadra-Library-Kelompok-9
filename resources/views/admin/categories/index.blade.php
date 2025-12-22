@extends('layouts.app')

@section('content')

<style>
    :root {
        --pink-main: #ff4f9a;
        --pink-soft: #ffe0ef;
        --pink-bg: #fff5fb;
        --pink-dark: #d93676;
        --pink-border: #ffd1e4;
    }

    .text-pink {
        color: var(--pink-main);
    }

    /* ================= BUTTON ================= */
    .btn-pink {
        background: linear-gradient(135deg, var(--pink-main), var(--pink-dark));
        color: #fff;
        border-radius: 14px;
        font-weight: 600;
        padding: 10px 22px;
        transition: all .3s ease;
        border: none;
    }

    .btn-pink:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(255,79,154,.4);
    }

    /* ================= CARD ================= */
    .card-pink {
        border-radius: 22px;
        box-shadow: 0 18px 40px rgba(255,79,154,.18);
        animation: fadeUp .6s ease;
        background: #fff;
        overflow: hidden;
    }

    /* ================= TABLE ================= */
    .table-pink thead {
        background: linear-gradient(135deg, var(--pink-soft), #fff);
    }

    .table-pink th {
        font-weight: 700;
        color: var(--pink-dark);
        border-bottom: 2px solid var(--pink-border);
    }

    .table-pink tbody tr {
        transition: all .25s ease;
    }

    .table-pink tbody tr:hover {
        background: var(--pink-bg);
        transform: scale(1.01);
    }

    .badge-pink {
        background: var(--pink-main);
        font-size: 13px;
        font-weight: 600;
        padding: 6px 14px;
    }

    /* ================= ACTION BUTTON ================= */
    .btn-action {
        border-radius: 10px;
        padding: 6px 10px;
        transition: .25s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    /* ================= EMPTY ================= */
    .empty-state {
        padding: 60px 0;
        animation: fadeUp .5s ease;
    }

    /* ================= ANIMATION ================= */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container fade-in">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-pink mb-1">
                📂 Manajemen Kategori Buku
            </h3>
            <small class="text-muted">
                Kelola kategori untuk pengelompokan buku perpustakaan
            </small>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-pink">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>

    {{-- TABLE --}}
    <div class="card card-pink border-0">
        <div class="card-body p-0">

            <table class="table table-pink align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th width="60">#</th>
                        <th class="text-start">Nama Kategori</th>
                        <th width="150">Jumlah Buku</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($categories as $category)
                        <tr>
                            <td class="text-center fw-semibold">
                                {{ $loop->iteration }}
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
                                   class="btn btn-sm btn-outline-primary btn-action me-1">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                            class="btn btn-sm btn-outline-danger btn-action">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted empty-state">
                                <i class="fas fa-folder-open fa-2x mb-3 text-pink"></i>
                                <p class="mb-0 fw-semibold">
                                    Belum ada kategori ditambahkan
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

</div>
@endsection
