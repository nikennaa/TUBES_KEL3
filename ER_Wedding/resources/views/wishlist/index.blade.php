@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Wishlist</h2>

    @if($wishlistItems->isEmpty())
        <p>Kamu belum menambahkan produk ke wishlist.</p>
    @else
        <div class="row">
            @foreach($wishlistItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/products/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                            <p class="card-text">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
