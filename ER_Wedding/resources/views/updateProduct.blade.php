@extends('app')

@section('title', 'Update Product')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<section class="update-product">

    <form action="{{ route('products.update', $product->id_product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <img src="{{ asset('storage/uploaded_img/' . $product->image) }}" class="image" alt="">

        <input type="hidden" value="{{ $product->id_product }}" name="update_p_id">
        <input type="hidden" value="{{ $product->image }}" name="update_p_image">

        <input type="text" class="box" value="{{ $product->nama_produk }}" required placeholder="Update product name" name="nama_produk">
        <input type="number" min="0" class="box" value="{{ $product->price }}" required placeholder="Update product price" name="price">
        <textarea name="detail" class="box" required placeholder="Update product details" cols="30" rows="10">{{ $product->detail }}</textarea>

        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">

        <!-- Flex container for the buttons -->
        <div class="button-group">
            <input type="submit" value="Update Product" class="btn">
            <a href="{{ route('products.index') }}" class="option-btn">Go Back</a>
        </div>
    </form>

</section>

@endsection
