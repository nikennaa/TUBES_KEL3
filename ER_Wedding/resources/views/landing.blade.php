<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda | Wedding Dekorasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">ER Wedding</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Vendor</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Event</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Promo</a></li>
                <li class="nav-item"><a class="btn btn-outline-pink me-2" href="{{ route('login') }}">Masuk</a></li>
                <li class="nav-item"><a class="btn btn-pink" href="{{ route('regist') }}">Daftar</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="{{ asset('img/banner1.jpg') }}" class="d-block w-100 img-fluid" alt="Banner 1">
        </div>
        <div class="carousel-item">
        <img src="{{ asset('img/banner2.jpg') }}" class="d-block w-100 img-fluid" alt="Banner 2">
        </div>
        <div class="carousel-item">
        <img src="{{ asset('img/banner3.jpg') }}" class="d-block w-100 img-fluid" alt="Banner 3">
        </div>
        <div class="carousel-item">
        <img src="{{ asset('img/banner4.jpg') }}" class="d-block w-100 img-fluid" alt="Banner 4">
        </div>
        <div class="carousel-item">
        <img src="{{ asset('img/banner5.jpg') }}" class="d-block w-100 img-fluid" alt="Banner 5">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Kategori -->
<div class="container text-center my-5">
    <h3>Rekomendasi Vendor Untuk Anda</h3>
    <div class="d-flex justify-content-center flex-wrap mt-3">
        <button class="btn btn-outline-secondary category-btn">Venue</button>
        <button class="btn btn-outline-secondary category-btn">Wedding Planner</button>
        <button class="btn btn-outline-secondary category-btn">Fotografi</button>
        <button class="btn btn-outline-secondary category-btn">Dekorasi</button>
        <button class="btn btn-outline-secondary category-btn">Makeup</button>
    </div>
</div>

<!-- Promo banner -->
<div class="container text-center mb-5">
    <div class="p-4 bg-light rounded shadow-sm">
        <h5 class="mb-3">Buat Undangan Digital Sendiri dengan Mudah & Cepat</h5>
        <a href="#" class="btn btn-outline-danger">Coba Sekarang</a>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} Wedding Decoration by TUBES_KEL3. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
