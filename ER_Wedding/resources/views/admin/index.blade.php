@extends('layouts.app')

@section('title', 'Produk')

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
            <a href="{{ route('admin.create') }}" class="btn orange">Tambah Produk</a>
    </div>
</section>

<section class="show-products">
    <div class="box-container">

        @forelse($products as $product)
            <div class="box">
                <div class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                <img class="image" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="name">{{ $product->name }}</div>
                <div class="description">{{ Str::limit($product->description, 100) }}</div>
                <a href="{{ route('admin.edit', $product) }}" class="option-btn">Update</a>
                <form action="{{ route('admin.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Hapus</button>
                </form>
            </div>
        @empty
            <p class="empty">Belum ada produk yang ditambahkan!</p>
        @endforelse

    </div>
</section>

@endsection
