<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Barang</title>
</head>

<body>
    <h1>Edit Barang: {{ $product->name }}</h1>
    <form action="/products/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nama Barang:</label><br>
            <input type="text" name="name" value="{{ $product->name }}" required>
        </div><br>

        <div>
            <label for="">Deskripsi:</label><br>
            <textarea name="description">{{ $product->description }}</textarea>
        </div><br>

        <div>
            <label for="stock">Stok:</label><br>
            <input type="number" name="stock" value="{{ $product->stock }}" required>
        </div><br>

        <div>
            <label for="price">Harga:</label><br>
            <input type="number" name="price" value="{{ $product->price }}" required>
        </div><br>

        <button type="submit">Simpan Barang</button>
        <a href="/products">Batal</a>
    </form>
</body>

</html>
