@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<section class="add-products">
    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
        @csrf

        <h3>Tambah Produk Baru</h3>

        <input type="text" name="name" class="box" required placeholder="Masukkan Nama Produk" value="{{ old('name') }}">

        <textarea name="description" class="box" required placeholder="Masukkan Deskripsi Produk" cols="30" rows="10">{{ old('description') }}</textarea>

        <input type="text" name="price" class="box" required placeholder="Masukkan Harga Produk" value="{{ old('price') }}">

        <<input type="file" name="image" accept="image/*" class="box" onchange="previewImage(event)">

       <div class="image mt-4">
            <p style="font-size: 1.4rem; color: var(--light-color);">Gambar Yang akan muncul: </p>
            <img id="preview" src="" alt="Preview Gambar Baru" class="preview-image hidden" style="display: none;">
        </div>


          <div class="button-group">
            <a href="{{ route('admin.index') }}" class="btn btn-kembali">Kembali</a>
            <button type="submit" class="btn btn-simpan">Simpan</button>
        </div>

    </form>
</section>

<script>
    function previewImage(event) {
        const message = document.getElementById('imageMessage');
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block'; // pastikan gambar tampil
            message.textContent = 'Preview Gambar Baru:';
        } else {
            preview.style.display = 'none';
            preview.src = '';
            message.textContent = 'Tidak Ada Gambar';
        }
    }
</script>

@endsection
