@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Daftar Barang Inventaris</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="/products/create" class="btn btn-primary">Tambah Barang Baru</a>
        </div>
    </div>

    {{-- Pencarian --}}
    <div class="card mb-3">
        <div class="card-body">
            <form action="/products" method="GET" class="row g-3">
                <div class="col-md-10">
                    <input type="text" name="search" id="search" class="form-control"
                        placeholder="Cari nama barang..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Cari</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div style="padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 10px">
            {{ session('success') }}
        </div>
    @endif
    {{-- @session('success')
        <div class="alert-success">
            {{ $value }}
        </div>
    @endsession --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge bg-info text-dark">{{ $product->stock }}</span></td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/products/{{ $product->id }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
