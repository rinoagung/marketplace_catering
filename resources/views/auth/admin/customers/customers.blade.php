@extends('auth.layouts.main')
@section('isi')
    <div class="col-12 shadow-sm p-3 mb-5 bg-body-tertiary rounded border border-1">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="ms-3 mb-0 fw-semibold">Data Customers</h3>
            <div class="input-group ms-auto my-3" style="max-width: 250px">
                <form id="searchForm" action="/customers" method="GET">
                    <div class="input-group">
                        @if (request('data_quantity'))
                            <input type="hidden" name="data_quantity" value="{{ request('data_quantity') }}">
                        @endif
                        @if (request('date'))
                            <input type="hidden" name="date" value="{{ request('date') }}">
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
        </div>

        <table id="isi_table" class="table table-striped rounded-4 overflow-hidden text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Nama Menu</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($customers as $customer)
                    @php
                        if ($customer->status == 'menunggu') {
                            $status_color = 'text-bg-primary';
                        } elseif ($customer->status == 'selesai') {
                            $status_color = 'text-bg-success';
                        } elseif ($customer->status == 'proses') {
                            $status_color = 'text-bg-secondary';
                        } else {
                            $status_color = 'text-bg-warning';
                        }
                    @endphp
                    <tr>
                        <td class="fw-bold">{{ $customers->firstItem() + $loop->iteration - 1 }}</td>
                        <td>{{ $customer->users->nama }}</td>
                        <td>{{ $customer->users->created_at->format('H:i _ d-m-Y') }}</td>
                        <td>
                            {{ $customer->users->alamat }}
                            {{-- {{ $services->status == 'selesai' ? '-' : $services->nomor_a ?? $services->nomor_b }} --}}
                        </td>
                        <td>{{ optional($customer->menu)->nama ?? '-' }}</td>
                        <td>{{ optional($customer)->jumlah ?? '-' }}</td>
                        <td>{{ optional($customer)->jumlah * optional($customer->menu)->harga ?? '-' }}</td>

                        <td>
                            <span class="badge {{ $status_color }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>

                        <td>

                            <form class="d-inline" action="/service/{{ $customer->id }}" method="post">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="tunda">
                                <button type="submit" class="border-0 bg-transparent"
                                    onclick="return confirm('Anda yakin ingin menunda antrian ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FDA403"
                                        class="bi bi-caret-right-square-fill mx-3" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4z" />
                                    </svg>
                                </button>
                            </form>
                            @if (in_array($customer->status, ['menunggu', 'tunda']))
                                <form class="d-inline" action="/service/{{ $customer->id }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="proses">
                                    <button type="submit" class="border-0 bg-transparent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6C757D"
                                            class="bi bi-nut-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1zm5.018 9.696a3 3 0 1 1-3-5.196 3 3 0 0 1 3 5.196" />
                                        </svg>
                                    </button>
                                </form>
                            @elseif ($customer->status != 'selesai')
                                <form class="d-inline" action="/service/{{ $customer->id }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="border-0 bg-transparent"
                                        onclick="return confirm('Anda yakin ingin menyelesaikan antrian ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#09BD3C"
                                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
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
                @endforeach
            </tbody>
        </table>
        <div class="text-end me-4">
            <small>Maksimal 500 data</small>
        </div>
        <div class="d-flex mb-4 mt-4">
            <div class="flex-grow-1 d-flex align-items-center">
                <p class="m-0">Tampilkan:</p>
                <div>
                    <form id="dataQuantityForm" action="/customers" method="GET">
                        <select class="form-select ms-2" style="background-color: #E6E8ED;" name="data_quantity"
                            onchange="document.getElementById('dataQuantityForm').submit();">
                            @foreach ($data_quantity as $q)
                                <option value="{{ $q }}"
                                    {{ request()->data_quantity == $q ? 'selected' : '' }}>
                                    {{ $q }}
                                </option>
                            @endforeach
                        </select>
                        @if (request('date'))
                            <input type="hidden" name="date" value="{{ request('date') }}">
                        @endif
                        @if (request('lokasi'))
                            <input type="hidden" name="lokasi" value="{{ request('lokasi') }}">
                        @endif
                        <noscript><input type="submit" value="Submit"></noscript>
                    </form>
                </div>
            </div>
            <div class="d-flex align-items-center me-5">
                <p class="m-0 me-3">Waktu:</p>
                <div>
                    <form id="dateForm" action="/customers" method="GET">
                        <input type="date" id="date" class="border-0 rounded-4 px-2"
                            style="background-color: #E6E8ED;" name="date" value="{{ request('date') }}"
                            onchange="document.getElementById('dateForm').submit();">
                        @if (request('data_quantity'))
                            <input type="hidden" name="data_quantity" value="{{ request('data_quantity') }}">
                        @endif
                        <noscript><input type="submit" value="Submit"></noscript>
                    </form>
                </div>
            </div>

        </div>
        <br>
        <div class="d-flex align-items-center me-5">
            <button type="button" class="btn text-white mx-2" onclick="export_excel_()"
                style="background-color: #01873c">
                Export Excel</button>
        </div>
        <div>
        </div>

    </div>

    {{ $customers->links() }}
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script>
        function export_excel_() {
            const table = document.getElementById('isi_table');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet JS"
            });

            XLSX.writeFile(wb, 'rekap_data_customer.xlsx');
        };
    </script>
@endsection
