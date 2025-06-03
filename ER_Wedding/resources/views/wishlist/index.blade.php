@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h2 class="mb-4">My Wishlist</h2>

    @if($wishlistItems->isEmpty())
        <p>Kamu belum menambahkan produk ke wishlist.</p>
    @else
        <div class="row">
            @foreach($wishlistItems as $item)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100 h-100 shadow-sm d-flex flex-column">
                        <div class="img-container">
                            <img src="{{ asset('storage/products/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                            <p class="card-text fw-bold text-primary">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');" class="mt-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


<style>
    .img-container {
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

body {
    margin: 0;
    padding: 0;
    height: 100%;
    display: flex;
    flex-direction: column;
}

main {
    background-color: var(--br-light);
    color: var(--br-navy);
    flex: 1 0 auto;    /* Ambil ruang vertikal yang tersisa, tdk perlu min-height */
    width: 100%;       /* Pastikan lebarnya full-width */
}

</style>
