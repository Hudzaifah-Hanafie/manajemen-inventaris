@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Daftar Barang Inventaris</h2>
            <p class="text-muted">Ringkasan data barang kamu saat ini.</p>
        </div>
    </div>

    <div class="row">
        {{-- Total Produk --}}
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h5>Total Produk</h5>
                    <h2 class="display-4 fw-bold">{{ $totalProduk }}</h2>
                </div>
            </div>
        </div>

        {{-- Total Stok --}}
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h5>Total Unit Stok</h5>
                    <h2 class="display-4 fw-bold">{{ $totalStok }}</h2>
                </div>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body text-center">
                    <h5>Kategori</h5>
                    <h2 class="display-4 fw-bold">{{ $totalKategori }}</h2>
                </div>
            </div>
        </div>

        {{-- Total Aset --}}
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body text-center">
                    <h5>Nilai Aset</h5>
                    <h2 class="display-4 fw-bold">Rp {{ number_format($totalAset, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Peringatan: Stok Menipis(<=5) </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stokMenipis as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name ?? '-' }}</td>
                                    <td><span class="badge bg-danger">{{ $item->stock }}</span></td>
                                    <td>
                                        <a href="{{ '/products/' . $item->id . '/edit' }}"
                                            class="btn btn-sm btn-outline-primary">Update Stok</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Semua stok masih aman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
