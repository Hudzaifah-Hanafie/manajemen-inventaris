@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tambah Barang Baru</h1>
    </div>
    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/products" method="POST">
        @csrf
        <div>
            <label for="name">Nama Barang:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div><br>

        <div>
            <label for="">Deskripsi:</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
        </div><br>

        <div>
            <label for="stock">Stok:</label><br>
            <input type="number" name="stock" value="{{ old('stock') }}" required>
        </div><br>

        <div>
            <label for="price">Harga:</label><br>
            <input type="number" name="price" value="{{ old('price') }}" required>
        </div><br>

        <button type="submit">Simpan Barang</button>
        <a href="/products">Batal</a>
    </form>
@endsection
