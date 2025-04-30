@extends('app')

@section('title', 'Products')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

{{-- tampilkan error atau sukses --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="add-products">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Add New Product</h3>
        <input type="text" class="box" required placeholder="Enter product name" name="nama_produk">
        <input type="number" min="0" class="box" required placeholder="Enter product price" name="price">
        <textarea name="detail" class="box" required placeholder="Enter product details" cols="30" rows="10"></textarea>
        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
        <input type="submit" value="Add Product" class="btn">
    </form>
</section>

<section class="show-products">
    <div class="box-container">

        @if($products->count())
            @foreach($products as $product)
                <div class="box">
                    <div class="price">Rp{{ $product->price }}</div>
                    <img class="image" src="{{ asset('storage/uploaded_img/' . $product->image) }}" alt="{{ $product->nama_produk }}">
                    <div class="name">{{ $product->nama_produk }}</div>
                    <div class="details">{{ $product->detail }}</div>
                    <a href="{{ route('products.edit', $product->id_product) }}" class="option-btn">Update</a>
                    <a href="{{ route('products.destroy', $product->id_product) }}" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                </div>
            @endforeach
        @else
            <p class="empty">No products added yet!</p>
        @endif

    </div>
</section>

@endsection
