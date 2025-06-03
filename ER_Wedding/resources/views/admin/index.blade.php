@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@section('title', 'Produk')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/backup_admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

@if (session('success') || session('error'))
    <div class="message">
        <span>{{ session('success') ?? session('error') }}</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif

<section class="add-products">
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 class="title">Manajemen Produk</h1>
        <p style="font-size: 1.6rem; color: var(--light-color); max-width: 700px; margin: 0 auto;">
            Selamat datang di halaman manajemen produk. Di sini kamu bisa melihat daftar produk, memperbarui, atau menghapus produk yang ada.
        </p>
        <br>
            <a href="{{ route('admin.create') }}" class="btn pink">Tambah Produk</a>
     </div>
</section>

<section class="show-products">
    <div class="box-container">

        @foreach($products as $product)
            <div class="box">
                <img class="image" src="{{ asset('pr_img/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="name">{{ $product->name }}</div>
                <div class="description">{{ Str::limit($product->description, 100) }}</div>
                <div class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>

                <div class="button-group">
                    <a href="{{ route('admin.edit', $product) }}" class="option-btn">Update</a>

                    <form action="{{ route('admin.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach

        @if($products->isEmpty())
            <p class="empty">Belum ada produk yang ditambahkan!</p>
        @endif

    </div>
</section>

<style>
.box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    justify-content: center;
}

.box {
    width: 250px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    box-sizing: border-box;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    transition: 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
    min-height: 480px;
}
.box:hover {
    transform: scale(1.03);
}

.image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 10px;
}

.name {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.description {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
    flex-grow: 1;
}

.price {
    font-size: 16px;
    font-weight: bold;
    color: #e74c3c;
    margin-bottom: 12px;
}

.button-group {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: auto;
}

.option-btn,
.delete-btn {
    padding: 8px 14px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    font-size: 14px;
    color: #fff;
    text-decoration: none;
}

.option-btn {
    background-color: #3498db;
}

.delete-btn {
    background-color: #e74c3c;
}

.empty {
    text-align: center;
    font-size: 18px;
    color: #999;
}
</style>


@endsection

