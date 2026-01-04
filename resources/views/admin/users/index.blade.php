@extends('layouts.app')

@section('content')

<div class="page-shell">

    {{-- HEADER --}}
    <div class="page-header-modern fade-in position-relative mb-4">
        <div class="floating-shape" style="top:-35px; left:-30px;"></div>
        <div class="floating-shape" style="bottom:-40px; right:-50px; width:130px; height:130px;"></div>

        <div>
            <div class="eyebrow mb-2">Panel Admin</div>
            <h1 class="hero-title-strong mb-1">Manajemen User</h1>
            <p class="hero-subtitle mb-0">Kelola akun, role, dan akses sistem perpustakaan</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="pill-action pill-soft">Total: {{ $users->total() }}</span>
            <a href="{{ route('admin.users.create') }}" class="pill-action pill-gradient">
                <i class="fas fa-plus me-1"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card surface-card border-0 shadow-sm fade-in">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern align-middle mb-0">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 60px;">#</th>
                            <th class="text-start">Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-center fw-bold text-pink">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>

                                <td>
                                    <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                    <div class="text-muted small">ID: {{ $user->id }}</div>
                                </td>

                                <td>
                                    <div class="fw-semibold text-muted">{{ $user->email }}</div>
                                </td>

                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge badge-role badge-admin">
                                            <i class="fas fa-shield-alt me-1"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge badge-role badge-siswa">
                                            <i class="fas fa-user me-1"></i> Siswa
                                        </span>
                                    @endif
                                </td>

                                <td class="text-muted small text-center">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-chip btn-outline-pink me-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    @if ($user->id !== auth()->id())
                                        <form method="POST"
                                              action="{{ route('admin.users.destroy', $user) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-chip btn-outline-danger">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-chip btn-secondary" disabled>
                                            <i class="fas fa-lock me-1"></i> Dikunci
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">📂</div>
                                        <div class="fw-semibold">Belum ada user terdaftar</div>
                                        <small class="text-muted">Tambahkan user baru untuk mulai mengelola</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4 page-fade">
        {{ $users->links('vendor.pagination.default') }}
    </div>

</div>

{{-- STYLES --}}
<style>
:root {
    --pink-main: #ff4f9a;
    --pink-dark: #d93676;
    --pink-soft: #ffe0ef;
    --pink-border: #ffd9ea;
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

.badge-role {
    font-weight: 800;
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 12px;
    border: 1px dashed rgba(255,79,154,0.25);
}
.badge-admin { background: rgba(255,79,154,0.12); color: var(--pink-dark); }
.badge-siswa { background: #e3f2fd; color: #1976d2; }

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
@keyframes fadeUp { from { opacity: 0; transform: translateY(10px);} to { opacity: 1; transform: translateY(0);} }
</style>

@endsection
