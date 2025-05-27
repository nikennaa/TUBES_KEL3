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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>

<!-- HERO (CAROUSEL) -->
@if(auth()->check() && auth()->user()->role === 'buyer' || !auth()->check())
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero" style="background-image: url('{{ asset('img/banner1.jpg') }}');">
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero" style="background-image: url('{{ asset('img/banner2.jpg') }}');">
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero" style="background-image: url('{{ asset('img/banner3.jpg') }}');">
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero" style="background-image: url('{{ asset('img/banner4.jpg') }}');">
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero" style="background-image: url('{{ asset('img/banner5.jpg') }}');">
            </div>
        </div>
    </div>

    <!-- Konten tetap yang selalu di atas carousel -->
    <div class="hero-content position-absolute top-50 start-50 translate-middle text-center">
        <h1>Your Wedding, Planned to Perfection</h1>
        <form action="{{ route('landingPage') }}" method="GET" class="search-wrapper" id="search">
            <input type="text" name="search_box" placeholder="Search venues, suppliers…" value="{{ request()->input('search_box') }}" />
            <button class="btn btn-pink" type="submit">Search</button>
        </form>
    </div>

    <!-- Navigasi -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<section class="container py-5">

    @if($resultProducts->isNotEmpty())
        <div id="result-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-4 position-relative">

                <h3 class="text-center w-100 fw-bold mb-0">Search Results</h3>
                <button id="close-result" class="btn btn-sm btn-outline-secondary position-absolute" style="top: 0; right: 0;">
                &times;
            </button>

            </div>

            <div class="row g-4">
                @forelse($resultProducts as $product)
                    <div class="col-md-4">
                        <div class="card product-card h-100">
                            <img src="{{ asset('pr_img/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                <p class="small text-muted mb-2">{{ Str::limit($product->description, 80) }}</p>
                                <div class="product-price mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</div>

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
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No products found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

</section>

<!-- LATEST PRODUCTS -->
<section class="container py-5">
    <h2 class="section-title">Latest Products</h2>
    <div class="row g-4">
        @foreach($latestProducts as $product)
            <div class="col-md-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('pr_img/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" />
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

                            @auth
                                @if(auth()->user()->role === 'buyer')
                                    <a href="{{ route('wedding.create', $product->id) }}" class="btn btn-outline-pink">Book Now</a>
                                @endif
                            @endauth
                        </div>

                    </form>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
<!--Tombol View All Products -->
    <div class="text-center mt-4">
        <a href="{{ route('products.all') }}" class="btn btn-pink btn-lg">View All Products</a>
    </div>

    <!-- Tambahkan ini di bagian landing page tempat kamu mau menampilkan logo WA -->
<a href="https://wa.me/6287809922331" target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp Admin">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="whatsapp-button" />
</a>
</section>
@endif

<style>
    .admin-dashboard {
        background: #f8f9fa;
        padding: 40px 20px;
        border-radius: 12px;
        margin-top: 50px;
    }

    .admin-dashboard h2 {
        text-align: center;
        font-size: 1.8rem;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .card-box {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        transition: 0.3s ease;
    }

    .card-box:hover {
        transform: translateY(-4px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .card-header h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .card-header p {
        font-size: 0.85rem;
        color: #888;
        margin: 0;
    }

    .icon {
        font-size: 1.8rem;
    }

    .card-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #343a40;
    }
</style>


@auth
@if((auth()->user()->role === 'superAdmin' || auth()->user()->role === 'admin') && isset($dashboardStats))
<section class="admin-dashboard">
    <h2>📊 Super Admin Overview</h2>
    <div class="dashboard-cards">


        <div class="card-box">
            <div class="card-header">
                <div>
                    <h4>Total Product</h4>
                    <p>Last 30 days</p>
                </div>
                <span class="icon">🛒</span>
            </div>
            <div class="card-value">{{ $dashboardStats['numberOfProducts'] }}</div>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Semua Produk</a>
        </div>

        <div class="card-box">
            <div class="card-header">
                <div>
                    <h4>Total Customers</h4>
                    <p>Last 30 days</p>
                </div>
                <span class="icon">👥</span>
            </div>
            <div class="card-value">{{ $dashboardStats['numberOfUsers'] }}</div>
            <a href="{{ url('/superadmin/fitur') }}" class="btn btn-primary">
    Lihat Total Customers
</a>
        </div>

          <div class="card-box">
            <div class="card-header">
                <div>
                    <h4>Total Admins</h4>
                    <p>Last 30 days</p>
                </div>
                <span class="icon">👥</span>
            </div>
            <div class="card-value">{{ $dashboardStats['numberOfAdmins'] }}</div>
            <a href="{{ url('/superadmin/fitur') }}" class="btn btn-primary">
    Lihat Total Admin
</a>

        </div>
    </div>
</section>
@endif
@endauth




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeBtn = document.getElementById('close-result');
        const wrapper = document.getElementById('result-wrapper');
        const heading = document.getElementById('search-heading');

        if (closeBtn && wrapper) {
            closeBtn.addEventListener('click', function () {
                wrapper.remove(); // hilangkan hasil produk
                closeBtn.remove(); // hilangkan tombol X
                if (heading) {
                    heading.textContent = 'Result Products'; // ubah judul
                }

                // Bersihkan query string "search_box" dari URL
                const url = new URL(window.location.href);
                url.searchParams.delete('search_box');
                window.history.replaceState({}, '', url);
            });
        }
    });
</script>
@endsection
