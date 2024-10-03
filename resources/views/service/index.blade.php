@extends('guest.layouts.main')
@section('isi')
    @if (session()->has('loginError'))
        <div class="d-flex align-items-center alert alert-danger alert-dismissible fade show p-2" role="alert">
            <i class="bi bi-exclamation-circle fs-3"></i>
            &ensp;{{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <div class="input-group ms-auto my-3" style="max-width: 250px">
            <form id="searchForm" action="" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control fw-bold fs-5 rounded-start-4"
                        style="background-color: #E6E8ED;" name="search">
                    <button class="btn px-3 text-white" style="background-color: #FF7917" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search me-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                            </path>
                        </svg>Cari
                    </button>
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="/service" method="POST" id="order-form">
                @csrf
                <div class="row p-3">
                    @foreach ($menu as $m)
                        <div class="col-sm-6">
                            <div class="card mb-3" style="max-width: 540px">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ $m->foto ? asset('storage/' . $m->foto) : '/admin/images/menu.jpg' }}"
                                            class="img-fluid rounded-5 p-3" alt="..." />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $m->nama }}</h5>
                                            <p class="card-text">{{ $m->deskripsi }}</p>
                                            <h5 class="card-title">Rp{{ $m->harga }}</h5>
                                            <div class="d-flex align-items-center">
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="updateQuantity('{{ $m->id }}', -1)">-</button>
                                                <input type="number" id="quantity-{{ $m->id }}" value="0"
                                                    min="0" style="width: 50px; text-align: center;" readonly>
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="updateQuantity('{{ $m->id }}', 1)">+</button>
                                            </div>
                                            <button type="button" class="btn btn-primary m-auto mt-3"
                                                onclick="addToOrder('{{ $m->id }}', '{{ $m->nama }}', {{ $m->harga }})">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        <!-- Item pesanan akan ditambahkan di sini -->
                    </tbody>
                </table>

                <div class="d-flex">
                    <button type="submit" class="btn btn-success mt-3 me-3">Pesan</button>
                </div>
            </form>

            <form id="logout-form" action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mt-3" form="logout-form">Logout</button>
            </form>
            <!-- Button trigger modal -->
            <div class="mt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Riwayat Transaksi
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Transaksi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

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
                                            <td class="fw-bold">{{ $loop->iteration }}</td>
                                            <td>{{ $customer->users->nama }}</td>
                                            <td>{{ $customer->users->created_at->format('H:i _ d-m-Y') }}</td>
                                            <td>
                                                {{ $customer->users->alamat }}
                                                {{-- {{ $services->status == 'selesai' ? '-' : $services->nomor_a ?? $services->nomor_b }} --}}
                                            </td>
                                            <td>{{ optional($customer->menu)->nama ?? '-' }}</td>
                                            <td>{{ optional($customer)->jumlah ?? '-' }}</td>
                                            <td>{{ optional($customer)->jumlah * optional($customer->menu)->harga ?? '-' }}
                                            </td>

                                            <td>
                                                <span class="badge {{ $status_color }}">
                                                    {{ ucfirst($customer->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(id, change) {
            const quantityInput = document.getElementById('quantity-' + id);
            let currentQuantity = parseInt(quantityInput.value);

            // Update quantity based on change
            currentQuantity += change;

            // Ensure quantity doesn't go below 0
            if (currentQuantity < 0) {
                currentQuantity = 0;
            }

            quantityInput.value = currentQuantity;
        }

        function addToOrder(id, name, price) {
            const quantityInput = document.getElementById('quantity-' + id);
            const quantity = parseInt(quantityInput.value);

            if (quantity > 0) {
                const totalPrice = quantity * price;
                const orderList = document.getElementById('order-list');

                // Buat baris baru untuk tabel
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${name}</td>
                    <td>${quantity}</td>
                    <td>Rp${totalPrice}</td>
                    <td><button class="btn btn-danger" onclick="removeOrder(this)">Hapus</button></td>
                    <input type="hidden" name="orders[${id}][jumlah]" value="${quantity}">
                    <input type="hidden" name="orders[${id}][menu_id]" value="${id}">
                `;
                orderList.appendChild(row);
            } else {
                alert('Jumlah barang harus lebih dari 0');
            }
        }

        function removeOrder(button) {
            // Menghapus baris dari tabel
            button.parentElement.parentElement.remove();
        }
    </script>
@endsection
