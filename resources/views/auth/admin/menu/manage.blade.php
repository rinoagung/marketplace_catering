@extends('auth.layouts.main')
@section('isi')
    @if (session()->has('success'))
        <div class="d-flex text-black fs-5 fw-bold align-items-center alert alert-success alert-dismissible fade show p-2"
            role="alert">
            &ensp; {{ session('success') }}
            <button type="button" class="btn-close px-3" style="padding-top: 5px" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="col-12 shadow-sm p-3 mb-5 bg-body-tertiary rounded border border-1">
        <div class="d-flex justify-content-between">
            <h3 class="ms-2 fw-semibold">Manajemen Menu</h3>
            <a href="/menu/create" class="text-decoration-none btn btn-primary ms-auto py-2 px-3 mb-4">
                <span>
                    Tambah
                </span>
            </a>
        </div>

        <div class="input-group ms-auto my-3" style="max-width: 250px">
            <form id="searchForm" action="/menu" method="GET">
                <div class="input-group">
                    @if (request('data_quantity'))
                        <input type="hidden" name="data_quantity" value="{{ request('data_quantity') }}">
                    @endif
                    <input type="text" class="form-control fw-bold fs-5 rounded-start-4"
                        style="background-color: #E6E8ED;" name="search">
                    <button class="btn px-3 btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search me-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>Cari
                    </button>
                </div>
            </form>
        </div>
        <table class="table table-striped rounded-4 overflow-hidden text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $m)
                    <tr>
                        <td class="fw-bold">{{ $menu->firstItem() + $loop->iteration - 1 }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>{{ Str::limit($m->deskripsi, 50, '...') }}</td>
                        <td>{{ $m->harga }}</td>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue"
                                onclick="location.href='/menu/{{ $m->id }}/edit'" role="button"
                                class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                            <form action="/menu/{{ $m->id }}" method="post" class="d-inline ms-2">
                                @method('delete')
                                @csrf
                                <button type="submit" class="border-0" onclick="return confirm('Yakin ingin menghapus?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex mb-4 mt-5 mx-3">
            <div class="flex-grow-1 d-flex align-items-center">
                <p class="m-0">Tampilkan:</p>
                <div>
                    <form id="dataQuantityForm" action="/menu" method="GET">
                        <select class="form-select ms-2" name="data_quantity" style="background-color: #E6E8ED;"
                            onchange="document.getElementById('dataQuantityForm').submit();">
                            @foreach ($data_quantity as $q)
                                <option value="{{ $q }}" {{ request()->data_quantity == $q ? 'selected' : '' }}>
                                    {{ $q }}
                                </option>
                            @endforeach
                        </select>
                        <noscript><input type="submit" value="Submit"></noscript>
                    </form>
                </div>
            </div>
        </div>
        <div>
            {{ $menu->links() }}
        </div>
    </div>
@endsection
