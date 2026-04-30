@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Tambah Barang Baru</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/products" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang:</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi:</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">Stok:</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Harga:</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Barang</label>

                            <div class="mb-2">
                                <img src="#" id="preview-image" alt="Preview" class="img-thumbnail" style="display: none; max-height: 200px;">
                            </div>

                            <input type="file" name="image" id="image-input" class="form-control" onchange="previewImage()">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Simpan Barang</button>
                            <a href="/products" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function previewImage() {
        const image = document.querySelector('#image-input');
        const imgPreview = document.querySelector('#preview-image');

        // Menampilkan Gambar
        imgPreview.style.display = 'block';

        // Mengambil data file
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>