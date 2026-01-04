@extends('layouts.app')

@section('content')

<div class="page-shell">
    <div class="page-header-modern fade-in position-relative mb-4">
        <div class="floating-shape" style="top:-30px; left:-20px;"></div>
        <div class="floating-shape" style="bottom:-40px; right:-40px; width:120px; height:120px;"></div>

        <div>
            <div class="eyebrow mb-2">Riwayat Peminjaman</div>
            <h1 class="hero-title-strong mb-1">📖 Data Peminjaman Buku</h1>
            <p class="hero-subtitle mb-0">Pantau buku yang sedang kamu pinjam dan status pengembaliannya</p>
        </div>

        <div class="d-none d-md-flex align-items-center gap-2">
            <span class="pill-action pill-soft">Total: {{ ($borrowings instanceof \Illuminate\Pagination\LengthAwarePaginator || $borrowings instanceof \Illuminate\Pagination\Paginator) ? $borrowings->total() : $borrowings->count() }}</span>
        </div>
    </div>

    <div class="card surface-card border-0 shadow-sm fade-in">
        <div class="card-body p-0">

            <table class="table table-modern align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th style="width:60px;">#</th>
                        <th>Buku</th>
                        <th>Dipinjam</th>
                        <th>Jatuh Tempo</th>
                        <th style="width:220px;">Alasan Peminjaman</th>
                        <th>Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($borrowings as $b)
                        <tr>
                            <td class="text-center fw-bold text-pink">
                                {{ ($borrowings instanceof \Illuminate\Pagination\LengthAwarePaginator || $borrowings instanceof \Illuminate\Pagination\Paginator) ? ($borrowings->firstItem() + $loop->index) : $loop->iteration }}
                            </td>

                            {{-- BUKU --}}
                            <td>
                                <div class="fw-semibold">{{ $b->book->title }}</div>
                                <small class="text-muted">
                                    {{ $b->book->author ?? '-' }}
                                </small>
                            </td>

                            {{-- TANGGAL --}}
                            <td class="text-center text-muted">
                                {{ $b->borrowed_at->format('d M Y') }}
                            </td>

                            <td class="text-center text-muted">
                                {{ $b->due_at->format('d M Y') }}
                            </td>

                            {{-- ALASAN PEMINJAMAN --}}
                            <td>
                                @if($b->note)
                                    <div class="note-pill">{{ $b->note }}</div>
                                @else
                                    <small class="text-muted fst-italic">
                                        Tidak ada keterangan
                                    </small>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if($b->status === 'borrowed')
                                    <span class="badge status-pill bg-warning text-dark">
                                        ⏳ Dipinjam
                                    </span>
                                @elseif($b->status === 'returned')
                                    <span class="badge status-pill bg-success">
                                        ✅ Dikembalikan
                                    </span>
                                @else
                                    <span class="badge status-pill bg-danger">
                                        ⚠️ Terlambat
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                @if ($b->status !== 'returned')
                                    <form method="POST" action="{{ route('borrowings.return', $b) }}">
                                        @csrf
                                        <button
                                            class="btn btn-sm btn-outline-pink px-3"
                                            onclick="return confirm('Yakin ingin menandai buku ini sebagai dikembalikan?')">
                                            <i class="fas fa-undo me-1"></i> Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-success fw-semibold">
                                        ✔ Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon">📂</div>
                                    <div class="fw-semibold">Belum ada data peminjaman</div>
                                    <small class="text-muted">Mulai pinjam buku untuk melihat riwayat di sini</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($borrowings instanceof \Illuminate\Pagination\Paginator || $borrowings instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-4 page-fade">
            {{ $borrowings->links('vendor.pagination.default') }}
        </div>
    @endif
</div>

{{-- ================= STYLES ================= --}}
<style>
:root {
    --pink-main: #ff4f9a;
    --pink-dark: #d93676;
    --pink-soft: #ffe0ef;
}

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

.note-pill {
    background: var(--pink-soft);
    color: #7a2a57;
    padding: 10px 12px;
    border-radius: 14px;
    font-size: 13px;
    line-height: 1.4;
    border: 1px dashed rgba(217,54,118,0.25);
}

.status-pill {
    padding: 8px 12px;
    border-radius: 999px;
    font-weight: 700;
    box-shadow: 0 10px 20px rgba(0,0,0,0.08);
}

.empty-state {
    background: #fff7fb;
    border: 2px dashed #ffcce5;
    border-radius: 14px;
    padding: 28px;
    display: inline-block;
}

.empty-icon {
    font-size: 28px;
    margin-bottom: 6px;
}

.page-fade { animation: fadeUp .4s ease; }
@keyframes fadeUp { from { opacity:0; transform: translateY(10px);} to { opacity:1; transform: translateY(0);} }
</style>

@endsection
