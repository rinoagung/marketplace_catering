@extends('auth.layouts.main')
@section('isi')
    @if (session()->has('success'))
        <div class="d-flex text-black fs-5 fw-bold align-items-center alert alert-success alert-dismissible fade show p-2"
            role="alert">
            <i class="bi bi-exclamation-circle fs-3"></i>
            &ensp; {{ session('success') }}
            <button type="button" class="btn-close px-3" style="padding-top: 5px" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="col-12 shadow-sm p-3 mb-5 rounded border border-1" style="background-color: #e7eaed">
        <form class="m-5" method="POST" action="/displayConfig" enctype="multipart/form-data">
            @method('put')
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @if ($konfigurasi->gambar_iklan)
                <input type="hidden" name="old_foto" value="{{ $konfigurasi->gambar_iklan }}">
            @endif

            @if ($konfigurasi->video_singkat)
                <input type="hidden" name="old_video" value="{{ $konfigurasi->video_singkat }}">
            @endif

            <div class="mb-3 position-relative">
                <label for="alamat" class="form-label fw-bold fs-5">Alamat</label>
                <input type="text" value="{{ old('alamat', $konfigurasi->alamat) }}"
                    class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">
                @error('alamat')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 position-relative">
                <label for="no_telp" class="form-label fw-bold fs-5">Nomor Telepon</label>
                <input type="text" value="{{ old('no_telp', $konfigurasi->no_telp) }}"
                    class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp">
                @error('no_telp')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 position-relative">
                <label for="email" class="form-label fw-bold fs-5">Email</label>
                <input type="text" value="{{ old('email', $konfigurasi->email) }}"
                    class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 position-relative">
                <label for="situs_web" class="form-label fw-bold fs-5">Alamat Situs Web</label>
                <input type="text" value="{{ old('situs_web', $konfigurasi->situs_web) }}"
                    class="form-control @error('situs_web') is-invalid @enderror" id="situs_web" name="situs_web">
                @error('situs_web')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- 
            <label for="waktu_slide" class="form-label fw-bold fs-5">Set waktu slide display Antrian</label>
            <div class="mb-3 position-relative input-group" style="width: 25%">
                <input type="number" value="{{ old('waktu_slide', $konfigurasi->waktu_slide) }}"
                    class="form-control @error('waktu_slide') is-invalid @enderror" id="waktu_slide" name="waktu_slide">
                <span class="input-group-text bg-primary text-white">Detik</span>

                @error('waktu_slide')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 position-relative">
                <label for="teks_berjalan" class="form-label fw-bold fs-5">Running Text</label>
                <textarea name="teks_berjalan" id="teks_berjalan" class="form-control @error('teks_berjalan') is-invalid @enderror"
                    cols="30" rows="10">{{ $konfigurasi->teks_berjalan }}</textarea>
                @error('teks_berjalan')
                    <div class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <img id="imagePreview" class="mb-3 rounded-3" src="{{ asset('storage/' . $konfigurasi->gambar_iklan) }}"
                alt="Advertising Image" style=" max-width: 100px; max-height: 100px;">
            <div class="input-group mb-3">
                <span class="input-group-text">Gambar Iklan</span>
                <div class="form-file rounded-end-5">
                    <input type="file" id="imageInput" class="form-file-input form-control rounded-end-5"
                        name="gambar_iklan">
                </div>
            </div>

            <video width="320" id="videoPreview" controls autoplay loop muted
                src="{{ asset('storage/' . $konfigurasi->video_singkat) }}">
                Your browser does not support the video tag.
            </video>
            <div class="input-group mb-3">
                <span class="input-group-text">Video Singkat</span>
                <div class="form-file rounded-end-5">
                    <input type="file" accept="video/*" id="videoInput"
                        class="form-file-input form-control rounded-end-5" name="video_singkat">
                </div>
            </div> --}}

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
    <script>
        document.getElementById('videoInput').addEventListener('change', function(event) {
            var video = document.getElementById('videoPreview');
            var file = this.files[0]; // Ambil file yang dipilih

            // Buat objek URL untuk file yang dipilih
            var url = URL.createObjectURL(file);

            // Setel URL objek sebagai sumber video
            video.src = url;
        });
    </script>
@endsection
