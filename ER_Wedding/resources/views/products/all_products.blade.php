@extends('layouts.app')

@section('title', 'All Products')

{{-- Tambahkan CSS --}}
<link rel="stylesheet" href="{{ asset('css/allProduct-style.css') }}">

@section('content')
<div class="container my-4">
    <h1 class="mb-4">All Products</h1>

    {{-- Tombol Kembali --}}
    <a href="{{ route('landingPage') }}" class="btn btn-secondary mb-4">← Back</a>

    @if($products->count() > 0)
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 d-flex">
                    <div class="card w-100 d-flex flex-column shadow-sm">
                        {{-- Gambar seragam --}}
                        <div class="img-fixed">
                            @if($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
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

                            <form action="{{ route('wishlist.add') }}" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="description" value="{{ $product->description }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="hidden" name="image" value="{{ $product->image }}">

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-outline-pink">Add to Wishlist</button>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-pink">View Product</a>

                                    @auth
                                        @if(auth()->user()->role === 'buyer')
                                            <a href="{{ route('wedding.index', $product->id) }}" class="btn btn-outline-pink">Book Now</a>
                                        @endif
                                    @endauth
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No products found.</p>
    @endif
</div>
@endsection
