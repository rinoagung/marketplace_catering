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
    <div class="col-12 shadow-sm p-3 mb-5 bg-body-tertiary rounded border border-1">
        <div class="d-flex justify-content-between">
            <h3 class="ms-2 fw-semibold">Manajemen Hak Akses</h3>
            <div class="input-group" style="max-width: 250px">
                <form action="/hak_akses" method="post" class="d-inline align-bottom">
                    @csrf
                    <div class="input-group">
                        <input type="text"
                            class="form-control fw-bold fs-5 rounded-start-4 @error('nama_hak_akses') is-invalid @enderror"
                            style="background-color: #E6E8ED;" name="nama_hak_akses">
                        @error('nama_hak_akses')
                            <div class="invalid-tooltip rounded-5">
                                {{ $message }}
                            </div>
                        @enderror
                        <button class="btn btn-primary px-3" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bookmark-plus-fill me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5z" />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped rounded-4 text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Edit Nama Hak Akses</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hak_akses as $ha)
                    <tr>
                        <td class="fw-bold">{{ $loop->iteration }}</td>
                        <td>{{ $ha->nama_hak_akses }}</td>
                        <td>
                            @if ($ha->id != 1)
                                <div class="input-group m-auto" style="max-width: 200px">
                                    <form action="/hak_akses/{{ $ha->id }}" method="post"
                                        class="d-inline align-bottom">
                                        @method('put')
                                        @csrf
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control fw-bold fs-5 rounded-start-4 @error('nama_hak_akses') is-invalid @enderror"
                                                style="{{ $loop->iteration % 2 == 0 ? 'background-color: #E6E8ED;' : '' }}"
                                                name="nama_hak_akses">
                                            @error('nama_hak_akses')
                                                <div class="invalid-tooltip rounded-5">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <button class="btn btn-primary px-3" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill me-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg>
                                                Edit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($ha->id != 1)
                                <form action="/hak_akses/{{ $ha->id }}" method="post" class="d-inline ms-2">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="border-0"
                                        onclick="return confirm('Peringatan: User dengan hak akses \'{{ $ha->nama_hak_akses }}\' juga akan terhapus!\nTetap lanjutkan?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
