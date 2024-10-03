@extends('auth.layouts.main')
@section('isi')
    @php
        $alert = session()->get('success') ? 'success' : null;
        if (session()->get('success')) {
            $alert = 'success';
        } elseif (session()->get('secondary')) {
            $alert = 'secondary';
        } elseif (session()->get('warning')) {
            $alert = 'warning';
        } else {
            $alert = null;
        }
    @endphp

    @if ($alert)
        <div class="d-flex fs-5 fw-bold align-items-center alert alert-{{ $alert }} alert-dismissible fade show p-2"
            role="alert">
            &ensp; {{ session($alert) }}
            <button type="button" class="btn-close px-3" style="padding-top: 5px" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

    <div class="row col-12 d-flex flex-row justify-content-center">
        @foreach ($hitungAntrian as $ha)
            <div class="col-3">
                <div class="rounded-4 color-1 m-2 d-flex justify-content-between px-4 py-3 align-items-center">
                    <div>
                        <h1 class="fw-bold m-0">{{ $ha['jumlah'] }}</h1>
                        <h4 class="m-0">Sisa Antrian Hari Ini</h4>
                    </div>
                    <div>
                        <h1 class="fw-bold m-0" style="font-size: 3.4rem">{{ $ha['jenis'] }}</h1>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-3">
            <div class="rounded-4 color-1 m-2 d-flex justify-content-between px-4 py-3 align-items-center">
                <div>
                    <h1 class="fw-bold m-0">{{ $totalHariIni }}</h1>
                    <h4 class="m-0">Total Antrian Hari Ini</h4>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-calendar-event" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="rounded-4 color-1 m-2 d-flex justify-content-between px-4 py-3 align-items-center">
                <div>
                    <h1 class="fw-bold m-0">{{ $sisaAntrian }}</h1>
                    <h4 class="m-0">Sisa Antrian Hari Ini</h4>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-hourglass" viewBox="0 0 16 16">
                        <path
                            d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- <div class="col-3 mt-5">
            @foreach ($hak_akses->skip(1) as $ha)
                <div class="shadow border border-1 border-light rounded-4 mb-4 overflow-hidden">
                    <div class="p-2 color-1">
                        <h4 class="ms-3 mb-0 fw-bold">A1</h4>
                    </div>
                    <div class="m-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="fw-bold d-inline ms-3 mb-0">{{ $ha->nama_hak_akses }}</h4>
                        </div>
                        <div class="rounded-circle color-1">
                            <h4 class="mx-3 my-2 fw-bold">2</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
        <div class="col-12 mt-5">
            <div class="shadow border border-1 border-light rounded-4 p-5">
                <div class="d-flex justify-content-between">
                    <h3 class="ms-2 fw-semibold">Daftar Antrian</h3>
                    <form action="/antrian" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class=" btn btn-danger ms-auto py-2 px-3 mb-4"
                            onclick="return confirm('Anda yakin ingin reset antrian ini?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-ban" viewBox="0 0 16 16">
                                <path
                                    d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                            </svg>
                            <span class="ms-2 pt-1">
                                Reset Antrian
                            </span>
                        </button>
                    </form>
                </div>
                <table class="table table-striped rounded-4 overflow-hidden text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th scope="col">No Antrian</th>
                            <th scope="col">Loket</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($antrian as $a)
                            @php
                                if ($a->status == 'menunggu') {
                                    $status_color = 'text-bg-primary';
                                } elseif ($a->status == 'selesai') {
                                    $status_color = 'text-bg-success';
                                } elseif ($a->status == 'proses') {
                                    $status_color = 'text-bg-secondary';
                                } else {
                                    $status_color = 'text-bg-warning';
                                }
                            @endphp
                            <tr>
                                <td>{{ $antrian->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="fw-bold {{ $a->nomor_a ? 'text-danger' : 'text-success' }}">
                                    {{ $a->nomor_a ?: $a->nomor_b }}</td>
                                <td class="fw-bold">{{ $a->nama_loket ?: '-' }}</td>
                                <td class="fw-bold">
                                    <span class="badge {{ $a->created_at->isToday() ? 'bg-success' : 'text-black' }}">
                                        {{ $a->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $status_color }}">
                                        {{ ucfirst($a->status) }}
                                    </span>
                                </td>
                                <td>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="blue"
                                        class="bi bi-eye-fill" onclick="location.href='/service/{{ $a->kode_unik }}'"
                                        role="button" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                    <form class="d-inline" action="/service/{{ $a->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="status" value="tunda">
                                        <button type="submit" class="border-0 bg-transparent"
                                            onclick="return confirm('Anda yakin ingin menunda antrian ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#FDA403" class="bi bi-caret-right-square-fill mx-3"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4z" />
                                            </svg>
                                        </button>
                                    </form>
                                    @if (in_array($a->status, ['menunggu', 'tunda']))
                                        <form class="d-inline" action="/service/{{ $a->id }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="status" value="proses">
                                            <input type="hidden" name="nama_loket"
                                                value="{{ $hak_akses_user->nama_hak_akses }}">
                                            <button type="submit" class="border-0 bg-transparent">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#6C757D" class="bi bi-nut-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1zm5.018 9.696a3 3 0 1 1-3-5.196 3 3 0 0 1 3 5.196" />
                                                </svg>
                                            </button>
                                        </form>
                                    @elseif ($a->status != 'selesai')
                                        <form class="d-inline" action="/service/{{ $a->id }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="border-0 bg-transparent"
                                                onclick="return confirm('Anda yakin ingin menyelesaikan antrian ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#09BD3C" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <svg width="20" height="20"></svg>
                                    @endif
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>

                <div class="d-flex mb-3 mt-5">
                    <div class="flex-grow-1 d-flex align-items-center">
                        <p class="m-0">Tampilkan:</p>
                        <div>
                            <form id="dataQuantityForm" action="/{{ auth()->user()->hak_akses_id }}/dashboard"
                                method="GET">
                                <select class="form-select ms-2" name="data_quantity" style="background-color: #E6E8ED;"
                                    onchange="document.getElementById('dataQuantityForm').submit();">
                                    @foreach ($data_quantity as $q)
                                        <option value="{{ $q }}"
                                            {{ request()->data_quantity == $q ? 'selected' : '' }}>
                                            {{ $q }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif
                                @if (request('no_antrian'))
                                    <input type="hidden" name="no_antrian" value="{{ request('no_antrian') }}">
                                @endif
                                <noscript><input type="submit" value="Submit"></noscript>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex align-items-center me-5">
                        <p class="m-0">Status:</p>
                        <div>
                            <form id="statusForm" action="/{{ auth()->user()->hak_akses_id }}/dashboard" method="GET">
                                <select class="form-select ms-2" name="status" style="background-color: #E6E8ED;"
                                    onchange="document.getElementById('statusForm').submit();">
                                    @foreach ($status as $s)
                                        <option value="{{ $s == 'all' ? '' : $s }}"
                                            {{ request()->status == $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (request('no_antrian'))
                                    <input type="hidden" name="no_antrian" value="{{ request('no_antrian') }}">
                                @endif
                                @if (request('data_quantity'))
                                    <input type="hidden" name="data_quantity" value="{{ request('data_quantity') }}">
                                @endif
                                <noscript><input type="submit" value="Submit"></noscript>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="m-0">Antrian:</p>
                        <div>
                            <form id="antrianForm" action="/{{ auth()->user()->hak_akses_id }}/dashboard" method="GET">
                                <select class="form-select ms-2" name="no_antrian" style="background-color: #E6E8ED;"
                                    onchange="document.getElementById('antrianForm').submit();">
                                    @foreach ($no_antrian as $a)
                                        <option value="{{ $a == 'all' ? '' : $a }}"
                                            {{ request()->no_antrian == $a ? 'selected' : '' }}>
                                            {{ ucfirst($a) }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif
                                @if (request('data_quantity'))
                                    <input type="hidden" name="data_quantity" value="{{ request('data_quantity') }}">
                                @endif
                                <noscript><input type="submit" value="Submit"></noscript>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    {{-- {{ $antrian->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
