@extends('layouts.app')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-lg-8">

        <div class="card card-pink shadow-lg border-0 rounded-4 animate-pop">

            {{-- HEADER --}}
            <div class="card-header bg-white border-0 pb-0">
                <h4 class="fw-bold text-pink mb-1">
                    ✏️ Edit Buku
                </h4>
                <small class="text-muted">
                    Perbarui data buku dengan benar
                </small>
            </div>

            <div class="card-body p-4">

                <form action="{{ route('admin.books.update', $book) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-pink">Judul Buku</label>
                        <input type="text"
                               name="title"
                               class="form-control input-pink @error('title') is-invalid @enderror"
                               value="{{ old('title', $book->title) }}"
                               required>

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-pink">Kategori</label>
                        <select name="category_id"
                                class="form-select input-pink @error('category_id') is-invalid @enderror"
                                required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- PENULIS --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text"
                                   name="author"
                                   class="form-control input-pink"
                                   value="{{ old('author', $book->author) }}">
                        </div>

                        {{-- ISBN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text"
                                   name="isbn"
                                   class="form-control input-pink"
                                   value="{{ old('isbn', $book->isbn) }}">
                        </div>
                    </div>

                    <div class="row">
                        {{-- PENERBIT --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text"
                                   name="publisher"
                                   class="form-control input-pink"
                                   value="{{ old('publisher', $book->publisher) }}">
                        </div>

                        {{-- TAHUN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number"
                                   name="year"
                                   class="form-control input-pink"
                                   value="{{ old('year', $book->year) }}"
                                   min="1900"
                                   max="{{ date('Y') }}">
                        </div>
                    </div>

                    {{-- TOTAL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-pink">Total Buku</label>
                        <input type="number"
                               name="total_copies"
                               class="form-control input-pink @error('total_copies') is-invalid @enderror"
                               value="{{ old('total_copies', $book->total_copies) }}"
                               min="1"
                               required>

                        @error('total_copies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- COVER --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-pink">Cover Buku</label>

                        @if ($book->cover_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $book->cover_path) }}"
                                     alt="Cover Buku"
                                     class="rounded-3 shadow-sm"
                                     style="height: 120px;">
                            </div>
                        @endif

                        <input type="file"
                               name="cover"
                               accept="image/*"
                               class="form-control input-pink @error('cover') is-invalid @enderror">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti cover
                        </small>

                        @error('cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description"
                                  class="form-control input-pink"
                                  rows="4">{{ old('description', $book->description) }}</textarea>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.books.index') }}"
                           class="btn btn-outline-pink rounded-pill px-4">
                            ← Kembali
                        </a>

                        <button type="submit"
                                class="btn btn-pink-gradient rounded-pill px-5">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@section('styles')
<style>
:root {
    --pink-main: #ff4f9a;
    --pink-dark: #d93676;
    --pink-soft: #ffe0ef;
    --pink-gradient: linear-gradient(135deg, #ff5fa2, #e84393);
}

/* TEXT */
.text-pink {
    color: var(--pink-main);
}

/* CARD */
.card-pink {
    border-left: 6px solid var(--pink-main);
}

/* INPUT */
.input-pink:focus {
    border-color: var(--pink-main);
    box-shadow: 0 0 0 0.25rem rgba(255,79,154,.25);
}

/* BUTTON */
.btn-outline-pink {
    border: 2px solid var(--pink-main);
    color: var(--pink-main);
}
.btn-outline-pink:hover {
    background: var(--pink-main);
    color: white;
}

.btn-pink-gradient {
    background: var(--pink-gradient);
    color: white;
    border: none;
    box-shadow: 0 10px 25px rgba(255,79,154,.35);
}
.btn-pink-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 30px rgba(255,79,154,.5);
}

/* ANIMATION */
.fade-in {
    animation: fadeIn .6s ease;
}
.animate-pop {
    animation: popUp .6s ease;
}

@keyframes fadeIn {
    from { opacity: 0 }
    to { opacity: 1 }
}
@keyframes popUp {
    from { transform: scale(.96); opacity: 0 }
    to { transform: scale(1); opacity: 1 }
}
</style>
@endsection
