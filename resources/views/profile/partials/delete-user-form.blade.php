<section class="card border-danger shadow-sm">
    <div class="card-body">

        {{-- HEADER --}}
        <h5 class="fw-bold text-danger mb-1">
            🗑️ Hapus Akun
        </h5>

        <p class="text-muted mb-4">
            Tindakan ini <strong>tidak dapat dibatalkan</strong>.
            Semua data, peminjaman, dan favorit Anda akan dihapus secara permanen.
        </p>

        {{-- BUTTON TRIGGER --}}
        <button
            class="btn btn-outline-danger"
            x-data
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            Hapus Akun Saya
        </button>

        {{-- MODAL --}}
        <x-modal name="confirm-user-deletion"
                 :show="$errors->userDeletion->isNotEmpty()"
                 focusable>

            <form method="POST"
                  action="{{ route('profile.destroy') }}"
                  class="p-4">
                @csrf
                @method('DELETE')

                <h5 class="fw-bold text-danger mb-2">
                    ⚠️ Konfirmasi Penghapusan Akun
                </h5>

                <p class="text-muted small mb-4">
                    Masukkan password Anda untuk mengonfirmasi bahwa
                    Anda benar-benar ingin <strong>menghapus akun ini secara permanen</strong>.
                </p>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password Anda">

                    @error('password', 'userDeletion')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- ACTION --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button"
                            class="btn btn-light"
                            x-on:click="$dispatch('close')">
                        Batal
                    </button>

                    <button class="btn btn-danger">
                        Ya, Hapus Akun
                    </button>
                </div>

            </form>
        </x-modal>

    </div>
</section>
