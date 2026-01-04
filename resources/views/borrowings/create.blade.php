@extends('layouts.app')

@section('content')

<div class="page-shell">

    {{-- HEADER --}}
    <div class="page-header-modern fade-in position-relative mb-4">
        <div class="floating-shape" style="top:-30px; left:-20px;"></div>
        <div class="floating-shape" style="bottom:-40px; right:-40px; width:120px; height:120px;"></div>

        <div>
            <div class="eyebrow mb-2">Formulir Peminjaman</div>
            <h1 class="hero-title-strong mb-1">📖 Pinjam Buku</h1>
            <p class="hero-subtitle mb-0">Lengkapi informasi untuk meminjam buku pilihan Anda</p>
        </div>

        <div class="d-none d-md-flex align-items-center gap-2">
            <a href="{{ route('books.browse') }}" class="pill-action pill-soft">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- BOOK INFO CARD --}}
            <div class="book-preview-card fade-in mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="preview-cover">
                            <img src="{{ $book->cover_path ? asset('storage/'.$book->cover_path) : 'https://via.placeholder.com/500x650?text=No+Cover' }}"
                                 alt="Cover {{ $book->title }}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="preview-body">
                            <span class="preview-badge">{{ $book->category->name ?? 'Tanpa Kategori' }}</span>
                            <h4 class="preview-title">{{ $book->title }}</h4>
                            <div class="preview-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user-pen"></i>
                                    <span>{{ $book->author ?? '-' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-barcode"></i>
                                    <span>ISBN: {{ $book->isbn ?? '-' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>Tahun: {{ $book->year ?? '-' }}</span>
                                </div>
                                <div class="meta-item stock-info">
                                    <i class="fas fa-boxes"></i>
                                    <span>Stok Tersedia: <b class="text-success">{{ $book->available_copies }}</b> dari {{ $book->total_copies }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="form-card fade-in">
                <div class="form-card-header">
                    <i class="fas fa-edit"></i>
                    <span>Detail Peminjaman</span>
                </div>

                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div class="form-card-body">

                        {{-- TANGGAL PENGEMBALIAN --}}
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-calendar-check"></i>
                                Tanggal Pengembalian
                                <span class="required-star">*</span>
                            </label>
                            <input type="date"
                                   name="due_at"
                                   class="form-control-modern @error('due_at') is-invalid @enderror"
                                   min="{{ now()->addDay()->toDateString() }}"
                                   value="{{ old('due_at') }}"
                                   required>
                            <small class="form-hint">Pilih tanggal saat Anda berencana mengembalikan buku</small>
                            @error('due_at')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- KETERANGAN --}}
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-comment-dots"></i>
                                Alasan Peminjaman
                                <span class="text-muted">(opsional)</span>
                            </label>
                            <textarea name="note"
                                      rows="4"
                                      class="form-control-modern @error('note') is-invalid @enderror"
                                      placeholder="Contoh: Untuk referensi tugas akhir, keperluan belajar mandiri, atau proyek penelitian">{{ old('note') }}</textarea>
                            <small class="form-hint">Bantu kami memahami kebutuhan Anda dengan menjelaskan tujuan peminjaman</small>
                            @error('note')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- INFO BOX --}}
                        <div class="info-box">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="info-content">
                                <strong>Perhatian:</strong>
                                <ul class="mb-0">
                                    <li>Pastikan mengembalikan buku tepat waktu untuk menghindari denda</li>
                                    <li>Jaga kondisi buku tetap baik selama peminjaman</li>
                                    <li>Hubungi petugas jika ingin memperpanjang masa peminjaman</li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="form-card-footer">
                        <a href="{{ route('books.browse') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-check me-2"></i>Konfirmasi Peminjaman
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>

{{-- STYLES --}}
<style>
:root {
    --pink-main: #ff4f9a;
    --pink-dark: #d93676;
    --pink-soft: #ffe0ef;
    --pink-light: #fff3fa;
}

.book-preview-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(255,79,154,0.12);
    border: 2px solid #ffe8f3;
}

.preview-cover {
    height: 100%;
    min-height: 320px;
    background: linear-gradient(135deg, #ffe4f1, #ffd6ea);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.preview-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.preview-body {
    padding: 28px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.preview-badge {
    display: inline-block;
    background: linear-gradient(135deg, #ff6fb1, #ff3f8f);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 20px rgba(255,79,154,0.25);
}

.preview-title {
    font-size: 24px;
    font-weight: 800;
    color: #2d3436;
    margin: 0;
    line-height: 1.3;
}

.preview-meta {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #636e72;
    font-size: 14px;
}

.meta-item i {
    color: var(--pink-main);
    width: 20px;
    text-align: center;
}

.meta-item.stock-info {
    padding: 10px 14px;
    background: var(--pink-light);
    border-radius: 10px;
    border: 1px dashed var(--pink-main);
    font-weight: 600;
}

.form-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(255,79,154,0.12);
    border: 2px solid #ffe8f3;
    overflow: hidden;
}

.form-card-header {
    background: linear-gradient(135deg, #ff4f9a, #ff85b3);
    color: #fff;
    padding: 20px 28px;
    font-size: 18px;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 12px;
}

.form-card-body {
    padding: 32px 28px;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.form-group-modern {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label-modern {
    font-weight: 700;
    color: #2d3436;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label-modern i {
    color: var(--pink-main);
}

.required-star {
    color: #ff3838;
    font-weight: 800;
}

.form-control-modern {
    border: 2px solid #e1e8ed;
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 15px;
    transition: all .25s ease;
    background: #fff;
}

.form-control-modern:focus {
    border-color: var(--pink-main);
    box-shadow: 0 0 0 4px rgba(255,79,154,0.12);
    outline: none;
}

.form-control-modern.is-invalid {
    border-color: #ff3838;
}

.form-hint {
    color: #95a5a6;
    font-size: 13px;
    font-style: italic;
}

.info-box {
    background: linear-gradient(135deg, #fff9e6, #fff3cc);
    border: 2px solid #ffd93d;
    border-radius: 14px;
    padding: 18px;
    display: flex;
    gap: 14px;
}

.info-icon {
    color: #f39c12;
    font-size: 24px;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
    color: #7f6c00;
}

.info-content strong {
    display: block;
    margin-bottom: 8px;
    color: #5a4a00;
}

.info-content ul {
    padding-left: 18px;
    margin-top: 8px;
}

.info-content li {
    margin-bottom: 4px;
    font-size: 14px;
}

.form-card-footer {
    padding: 24px 28px;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    border-top: 2px solid #ffe8f3;
}

.btn-cancel {
    background: #fff;
    color: #636e72;
    border: 2px solid #dfe6e9;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 700;
    transition: all .25s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-cancel:hover {
    background: #dfe6e9;
    border-color: #b2bec3;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.btn-submit {
    background: linear-gradient(135deg, #ff4f9a, #ff85b3);
    color: #fff;
    border: none;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 800;
    font-size: 15px;
    transition: all .25s ease;
    box-shadow: 0 12px 28px rgba(255,79,154,0.35);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 36px rgba(255,79,154,0.45);
}

.fade-in { animation: fadeIn .5s ease; }
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .preview-cover { min-height: 250px; }
    .preview-body { padding: 20px; }
    .form-card-body { padding: 24px 20px; }
    .form-card-footer { flex-direction: column; }
    .btn-cancel, .btn-submit { width: 100%; justify-content: center; }
}
</style>

@endsection
