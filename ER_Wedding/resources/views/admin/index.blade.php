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
   <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 d-flex">
                    <div class="card w-100 d-flex flex-column shadow-sm">
                        {{-- Gambar seragam --}}
                        <div class="img-fixed">
                            @if($product->image)
                               <img class="image" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                                     class="card-img-top object-cover"
                                     alt="{{ $product->name }}">
                            @else
                                <div class="bg-light text-center py-5">No Image</div>
                            @endif
                        </div>

                        {{-- Konten --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                            <p class="card-text fw-bold text-pink">Rp{{ number_format($product->price, 0, ',', '.') }}</p>



                            <div class="button-group">
                                <a href="{{ route('admin.edit', $product) }}" class="btn btn-update">Update</a>


                            <form action="{{ route('admin.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-hapus">Hapus</button>
                            </form>


                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</section>

@endsection

