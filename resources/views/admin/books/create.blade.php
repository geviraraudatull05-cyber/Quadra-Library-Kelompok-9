@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
            {{-- HEADER --}}
            <div class="card-header bg-white border-0">
                <h4 class="fw-bold text-pink mb-0">
                    ✨ Tambah Buku Baru
                </h4>
                <small class="text-muted">
                    Lengkapi data buku dengan benar
                </small>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.books.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Buku</label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               required>

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id"
                                class="form-select @error('category_id') is-invalid @enderror"
                                required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                   class="form-control"
                                   value="{{ old('author') }}">
                        </div>

                        {{-- ISBN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text"
                                   name="isbn"
                                   class="form-control"
                                   value="{{ old('isbn') }}">
                        </div>
                    </div>

                    <div class="row">
                        {{-- PENERBIT --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text"
                                   name="publisher"
                                   class="form-control"
                                   value="{{ old('publisher') }}">
                        </div>

                        {{-- TAHUN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number"
                                   name="year"
                                   class="form-control"
                                   value="{{ old('year') }}"
                                   min="1900"
                                   max="{{ date('Y') }}"
                                   placeholder="Contoh: 2024">
                        </div>
                    </div>

                    {{-- TOTAL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Total Buku</label>
                        <input type="number"
                               name="total_copies"
                               class="form-control @error('total_copies') is-invalid @enderror"
                               value="{{ old('total_copies') }}"
                               min="1"
                               required>

                        @error('total_copies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- COVER --}}
                    <div class="mb-3">
                        <label class="form-label">Cover Buku</label>
                        <input type="file"
                               name="cover"
                               accept="image/*"
                               class="form-control @error('cover') is-invalid @enderror">

                        <small class="text-muted">
                            JPG / PNG, maksimal 20MB
                        </small>

                        @error('cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Deskripsi singkat buku...">{{ old('description') }}</textarea>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.books.index') }}"
                           class="btn btn-outline-secondary">
                            Kembali
                        </a>

                        <button type="submit"
                                class="btn btn-pink px-4">
                            <i class="fas fa-save me-1"></i> Simpan Buku
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
