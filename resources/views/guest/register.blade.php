@extends('guest.layouts.main')
@section('isi')
    @if (session()->has('loginError'))
        <div class="d-flex align-items-center alert alert-danger alert-dismissible fade show p-2" role="alert">
            <i class="bi bi-exclamation-circle fs-3"></i>
            &ensp;{{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-5">
            <main class="form-signin">
                <form action="/signup" method="POST">
                    @csrf
                    <img src="/logo/logo_markat.png" class="d-block mx-auto mt-5" alt="" style="max-height: 200px">
                    <h1 class="h3 mb-3 fw-normal text-center">Please sign up</h1>

                    <div class="form-floating mb-3">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" placeholder="Nama" autofocus>
                        <label for="nama">Nama</label>
                        @error('nama')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="Username">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select py-3 @error('hak_akses_id') is-invalid @enderror" name="hak_akses_id">
                            <option value="" selected>-- Anda mendaftar sebagai --</option>
                            @foreach ($hak_akses as $item)
                                @if (old('hak_akses_id') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->nama_hak_akses }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->nama_hak_akses }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('hak_akses_id')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select id="kota" class="form-select py-3 @error('id_kota') is-invalid @enderror"
                            name="id_kota">
                            <option value="" selected>-- Pilih Kota --</option>
                            <option value="1">Jakarta</option>
                            <option value="2">Bandung</option>
                        </select>
                        @error('id_kota')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="8"></textarea>
                        @error('alamat')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="alamat" class="form-label fw-bold">Detail Alamat</label>
                    </div>
                    <div class="ms-auto d-block">
                        <a href="/login" class="text-decoration-none btn ms-auto mb-4 text-white"
                            style="background-color: #FF7E00">
                            <span>
                                Kembali
                            </span>
                        </a>
                        <button class="ms-auto my-0 d-inline-block btn mb-4" style="background-color: #c7c7c7"
                            type="submit">Sign
                            up</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script>
        (function() {
            // $.ajax({
            //     url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', // URL API
            //     dataType: 'json',
            //     success: function(data) {
            //         console.log(data);

            //     },
            //     error: function(jqXHR, textStatus, errorThrown) {
            //         console.error("Error: " + textStatus, errorThrown);
            //     }
            // });
        })();
    </script>
@endsection
