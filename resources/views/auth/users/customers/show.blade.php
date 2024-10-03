@extends('auth.layouts.main')
@section('isi')
    <div class="col-12 shadow-sm p-3 mb-5 bg-body-tertiary rounded border border-1">
        <div class="d-flex justify-content-between">
            <div>
                <a href="/{{ auth()->user()->hak_akses_id }}/dashboard"
                    class="text-decoration-none btn btn-primary ms-auto py-2 px-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                    <span>
                        Kembali
                    </span>
                </a>
            </div>
            <h3 class="me-2 fw-semibold">Detail Service Customer</h3>
        </div>
        <table class="table table-striped rounded-4 overflow-hidden text-center">
            <table class="table table-striped rounded-4 overflow-hidden text-center">
                <tbody>
                    <tr>
                        <th scope="col">Nama</th>
                        <td>{{ $customer->nama }}</td>
                    </tr>
                    <tr>
                        <th scope="col">No Telepon</th>
                        <td>{{ $customer->no_telp }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Perangkat</th>
                        <td>{{ $customer->device }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Kendala</th>
                        <td class="px-5">{{ $customer->kendala }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Waktu Daftar Antrian</th>
                        <td>{{ $customer->created_at->format('H:i _ d-m-Y') }}</td>
                    </tr>
                </tbody>
            </table>
    </div>
@endsection
