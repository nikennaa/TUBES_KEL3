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

        <input type="text" class="box" required placeholder="Masukkan nama Produk" name="name">

        <textarea name="description" class="box" required placeholder="Masukkan Deskripsi Produk" cols="30" rows="10"></textarea>
        <input type="text" class="box" required placeholder="Masukkan Harga Produk" name="price">

        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image" onchange="previewImage(event)">

        <div id="imagePreview" class="mt-2 mb-6">
            <p id="imageMessage" class="text-sm" style="font-size: 1.4rem; color: var(--light-color);">
                Preview Gambar:<br>
                <span>Tidak Ada Gambar</span>
            </p>
            <img id="preview" class="image hidden" style="max-width: 100%; height: auto; border-radius: .5rem;" />
        </div>

        <div class="button-group">
            <a href="{{ route('admin.index') }}" class="option-btn">Kembali</a>
            <button type="submit" class="btn">Simpan</button>
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
            preview.classList.remove('hidden');
            message.textContent = 'Preview Gambar:';
        } else {
            preview.classList.add('hidden');
            preview.src = '';
            message.textContent = 'Tidak Ada Gambar';
        }
    }
</script>
@endsection
