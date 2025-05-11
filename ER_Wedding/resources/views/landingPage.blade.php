{{-- contoh: resources/views/landing/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ER Wedding | Home</title>

    <!-- Bootstrap & Font-Awesome  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Extra custom CSS  -->
    <style>
        :root {
            --pink:#e83e8c;
            --dark:#343434;
        }
        body {font-family:"Poppins", sans-serif;}
        .btn-pink       {background:var(--pink);color:#fff;border:none;border-radius:6px}
        .btn-outline-pink{border:2px solid var(--pink);color:var(--pink);border-radius:6px;background:transparent}
        .btn-outline-pink:hover{background:var(--pink);color:#fff}
        a{text-decoration:none}
        .section-title{font-weight:700;font-size:1.8rem;text-align:center;margin-bottom:2rem}

        /* NAVBAR */
        .navbar-brand{font-weight:700;font-size:1.6rem}
        .nav-link{font-weight:500}

        /* HERO */
        .hero{position:relative;height:520px;background:url('{{ asset('img/banner1.jpg') }}') center/cover no-repeat;display:flex;align-items:center;justify-content:center;color:#fff}
        .hero::after{content:"";position:absolute;inset:0;background:rgba(0,0,0,.55)}
        .hero-content{position:relative;z-index:1;text-align:center;width:100%;max-width:750px;padding:0 1rem}
        .hero h1{font-size:2.5rem;font-weight:700;letter-spacing:1px}
        .search-wrapper{background:#fff;border-radius:50px;padding:.35rem .75rem;display:flex;gap:.5rem;margin-top:1.6rem}
        .search-wrapper input{border:none;flex:1;outline:none;font-size:.95rem}
        .search-wrapper .btn{border-radius:50px;padding:.55rem 1.5rem}

        /* ICON STEPS */
        .steps .card{border:none;text-align:center}
        .steps .card i{font-size:2rem;color:var(--pink);margin-bottom:.6rem}
        .steps .card-title{font-size:1rem;font-weight:600}

        /* PRODUCTS grid */
        .product-card .card-img-top{height:160px;object-fit:cover}
        .product-price{color:var(--pink);font-weight:600}

        /* FOOTER */
        footer{background:var(--dark);color:#fff;padding:40px 0;margin-top:4rem}
        footer a{color:#f8f9fa}
    </style>
</head>
<body>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>Your Wedding, Planned to Perfection</h1>
        <form action="{{ route('landingPage') }}" method="GET" class="search-wrapper" id="search">
            <input type="text" name="search_box" placeholder="Search venues, suppliers…" value="{{ request()->input('search_box') }}" />
            <button class="btn btn-pink" type="submit">Search</button>
        </form>
    </div>
</section>

<!-- ICON STEPS -->
<section class="py-5 steps container">
    <h2 class="section-title">Start Planning Your Wedding Today</h2>
    <div class="row g-4">
        @php $icons=[['fa-search','Manage Suppliers'],['fa-list','Organize Guest List'],['fa-check','Checklist'],['fa-coins','Manage Budget'],['fa-heart','Inspiration']]; @endphp
        @foreach($icons as [$icon,$title])
            <div class="col-6 col-md-3 col-lg">
                <div class="card h-100 p-3">
                    <i class="fa {{ $icon }}"></i>
                    <h5 class="card-title">{{ $title }}</h5>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- LATEST PRODUCTS -->
<section class="container py-5">
    <h2 class="section-title">Latest Products</h2>
    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $product->name }}</h5>
                        <p class="small text-muted mb-2">{{ Str::limit($product->description,80) }}</p>
                        <div class="product-price mb-3">Rp{{ number_format($product->price,0,',','.') }}</div>
                        <form action="{{ route('wishlist.add') }}" method="POST" class="mt-auto vstack gap-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="description" value="{{ $product->description }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                           <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-pink">Add to Wishlist</button>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-pink">View Product</a>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container text-center">
        <p class="mb-2">&copy; {{ date('Y') }} ER Wedding. All rights reserved.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#">Privacy</a> · <a href="#">Terms</a> · <a href="#">Contact</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection

