@extends('auth.layouts.main')
@section('isi')
    <div class="col-12 shadow-sm p-3 mb-5 rounded border border-1" style="background-color: #e7eaed">
        <form class="m-5" method="POST" action="/menu/{{ $menu->id }}" enctype="multipart/form-data">
            @method('put')
            @csrf

            <input type="hidden" name="id" value="{{ $menu->id }}">
            @if ($menu->foto)
                <input type="hidden" name="old_foto" value="{{ $menu->foto }}">
            @endif

            <img id="imagePreview" class="mb-3 rounded-3"
                src=" {{ $menu->foto ? asset('storage/' . $menu->foto) : '/admin/images/menu.jpg' }}" alt="Preview Image"
                style=" max-width: 100px; max-height: 100px;">
            <div class="input-group mb-3">
                <span class="input-group-text">Foto Profil</span>
                <div class="form-file rounded-end-5">
                    <input type="file" id="imageInput" class="form-file-input form-control rounded-end-5" name="foto">
                </div>
            </div>

            <div class="mb-3 position-relative">
                <label for="nama" class="form-label fw-bold fs-5">Nama menu</label>
                <input type="text" value="{{ old('nama', $menu->nama) }}"
                    class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                @error('nama')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 position-relative">
                <label for="deskripsi" class="form-label fw-bold fs-5">deskripsi</label>
                <input type="text" value="{{ old('deskripsi', $menu->deskripsi) }}"
                    class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">
                @error('deskripsi')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 position-relative">
                <label for="harga" class="form-label fw-bold fs-5">Harga</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                    name="harga" value="{{ old('harga', $menu->harga) }}">
                @error('harga')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="me-2 btn btn-primary py-1 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-floppy-fill mb-1 me-2" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                        <path
                            d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                    </svg>
                    <span>
                        Simpan
                    </span>
                </button>
                <a href="/menu" class="ms-2 text-decoration-none btn btn-danger py-1 ps-2 pe-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-x mb-1" viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                    <span>
                        Batal
                    </span>
                </a>
            </div>
        </form>
    </div>
    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
