{{--  resources/views/layouts/main.blade.php  --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'ER Wedding')</title>

    {{-- === Core Vendor CSS === --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- === Custom Theme (already refactored with `er-` prefix) === --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />

    {{--  Page–level extra style  --}}
    @stack('head-extra')
    @yield('css')

    {!! NoCaptcha::renderJs() !!}
</head>
<body>
    {{-- ================================================================= --}}
    {{--                       GLOBAL NAVBAR (Shared)                     --}}
    {{-- ================================================================= --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('landingPage') }}">ER Wedding</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">



                    {{-- Wishlist button (buyers only) --}}
                    @auth
                        @if(auth()->user()->role === 'buyer')
                            <li class="nav-item">
                                <a href="{{ route('wishlist.index') }}" class="er-btn-outline er-wishlist-btn">
                                    <i class="fa fa-heart me-1"></i> Wishlist

                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('help') }}">Bantuan</a></li>
                            {{-- My Orders button --}}
                            <li class="nav-item">
                                <a href="{{ route('my.orders') }}" class="er-btn-outline er-wishlist-btn">
                                    <i class="fa fa-clipboard-list me-1"></i> My Orders
                                </a>
                            </li>

                             {{-- search icon  --}}
                    <li class="nav-item d-none d-lg-block">
                        <a href="#search" class="nav-link"><i class="fas fa-search"></i></a>
                    </li>

                            {{-- Cart button --}}


                            {{-- Link ke Profil --}}
                            <li class="nav-item">
                                <a class="btn btn-outline-secondary" href="{{ route('profile.edit') }}">
                                    <i class="fa fa-user me-1"></i> Profil Saya
                                </a>
                            </li>
                        @endif
                    @endauth

                    {{-- Auth buttons / Logout --}}
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-pink" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-pink" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="btn btn-outline-pink me-2" href="{{ route('products.index') }}">Products (Admin)</a>

                                </li>

                                <li class="nav-item">
                                    <a class="btn btn-outline-pink me-2" href="{{ route('superadmin.orders') }}">Order</a>
                                </li>
                            @endif
                        @endauth

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-pink" type="submit">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- ================================================================= --}}
    {{--                           MAIN CONTENT                            --}}
    {{-- ================================================================= --}}
    <main>
        @yield('content')
    </main>

    {{-- ================================================================= --}}
    {{--                              FOOTER                              --}}
    {{-- ================================================================= --}}
<!-- Pindahkan ini ke app.blade.php -->
    <footer class="bg-dark text-white mt-auto py-3">
        <div class="container text-center">
            <p class="mb-2">&copy; {{ date('Y') }} ER Wedding. All rights reserved.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="text-white">Privacy</a> ·
                <a href="#" class="text-white">Terms</a> ·
                <a href="#" class="text-white">Contact</a>
            </div>
        </div>
    </footer>

    {{-- {!! NoCaptcha::renderJs() !!} --}}

    @stack('scripts')
    @yield('scripts')
</body>
</html>
