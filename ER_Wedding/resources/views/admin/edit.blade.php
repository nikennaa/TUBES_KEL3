@extends('layouts.app')

@section('title', 'Edit Produk')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<section class="update-product">
    <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3>Edit Produk</h3>

        <input type="text" name="name" class="box" required placeholder="Masukkan Nama Produk" value="{{ $product->name }}">

        <input type="text" name="price" min="0" class="box" required placeholder="Masukkan Harga Produk" value="{{ $product->price }}">

        <textarea name="description" class="box" required placeholder="Masukkan Deskripsi Produk" cols="30" rows="10">{{ $product->description }}</textarea>

        <input type="file" name="image" accept="image/*" class="box" onchange="previewImage(event)">

        @if($product->image)
            <div class="image mt-4">
                <p style="font-size: 1.4rem; color: var(--light-color);">Gambar Yang akan muncul: </p>
                <img src="{{ asset('pr_img/' . $product->image) }}" alt="Gambar Produk" class="image">
            </div>
        @elseif($product->image == null)
            <div class="image mt-4">
                <p style="font-size: 1.4rem; color: var(--light-color);">Tidak Ada Gambar</p>
            </div>
        @endif

        <div class="button-group">
            <a href="{{ route('admin.index') }}" class="btn orange">Kembali</a>
            <button type="submit" class="btn">Update</button>
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
            message.textContent = 'Preview Gambar Baru:';
        } else {
            preview.classList.add('hidden');
            preview.src = '';
            message.textContent = 'Tidak Ada Gambar';
        }
    }
</script>

@endsection
