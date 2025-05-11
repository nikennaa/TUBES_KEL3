@extends('layouts.app')

<section class="heading">
    <h3>Search Page</h3>
    <p><a href="{{ route('landingPage') }}">Home</a> / Search</p>
</section>

<section class="search-form">
    <form action="{{ route('search.page') }}" method="GET">
        <input type="text" class="box" placeholder="Search products..." name="search_box" value="{{ request()->input('search_box') }}">
        <input type="submit" class="btn" value="Search">
    </form>
</section>

<section class="products">
    <div class="box-container">
        @forelse($products as $product)
            <form action="{{ route('wishlist.add') }}" method="POST" class="box">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="description" value="{{ $product->description }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="image" value="{{ $product->image }}">

                <a href="{{ route('products.show', $product->id) }}" class="fas fa-eye"></a>
                <div class="price">Rp{{ number_format($product->price, 0, ',', '.') }}/-</div>
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="image">
                <div class="name">{{ $product->name }}</div>
                <div class="description">{{ Str::limit($product->description, 100) }}</div>
                <input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn">
                <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
            </form>
        @empty
            <p class="empty">No products found!</p>
        @endforelse
    </div>
</section>
