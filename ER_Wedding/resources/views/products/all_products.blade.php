@extends('layouts.app')

@section('title', 'All Products')

<link rel="stylesheet" href="{{ asset('css/allProduct-style.css') }}">

@section('content')
<div class="container my-4">
    <h1 class="mb-4">All Products</h1>

    <div class="container my-4 position-relative" style="min-height: 40px;">

    <!--Tombol Back -->
    <a href="{{ route('landingPage') }}" class="btn btn-secondary">← Back</a>

    <!--Tombol Filter -->
    <button id="filterToggle" class="btn btn-outline-primary position-absolute" style="top: 4px; right: 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .4.8l-4.667 5.5a.5.5 0 0 0-.133.352v4.346a.5.5 0 0 1-.276.447l-3 1.5A.5.5 0 0 1 6 12.5v-7.3a.5.5 0 0 0-.133-.352L1.1 1.8a.5.5 0 0 1 .4-.3z"/>
        </svg>
        Filter
    </button>

    <!--Filter Form -->
    <form id="filterForm" action="{{ route('products.all') }}" method="GET" class="card p-3 mb-4" style="display:none; max-width: 400px;">
        <div class="mb-3">
            <label for="min_price" class="form-label">Min Price</label>
            <input type="number" class="form-control" id="min_price" name="min_price" placeholder="0" min="0" value="{{ request('min_price') }}">
        </div>
        <div class="mb-3">
            <label for="max_price" class="form-label">Max Price</label>
            <input type="number" class="form-control" id="max_price" name="max_price" placeholder="10000000" min="0" value="{{ request('max_price') }}">
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Apply</button>
            <a href="{{ route('products.all') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

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
    @section('scripts')
<script>
    document.getElementById('filterToggle').addEventListener('click', function () {
        const form = document.getElementById('filterForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    });
</script>
@endsection
</div>
@endsection
