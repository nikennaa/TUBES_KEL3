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

    {{-- === Custom Theme (already refactored with er- prefix) === --}}
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
                                <li class="nav-item">
                                    <a class="btn btn-outline-secondary" href="{{ route('help') }}">
                                        <i class="fa fa-question-circle me-1"></i> Bantuan
                                    </a>
                                </li>
                            {{-- My Orders button --}}
                            <li class="nav-item">
                                <a href="{{ route('orders.mine') }}" class="er-btn-outline er-wishlist-btn">
                                    <i class="fa fa-clipboard-list me-1"></i> My Orders
                                </a>
                            </li>

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
                            {{-- Tampilkan tombol Orders Customer untuk admin & superAdmin --}}
                            @if(in_array(auth()->user()->role, ['admin', 'superAdmin']))
                                <li class="nav-item">
                                    <a class="btn btn-outline-pink me-2" href="{{ route('superadmin.orders') }}">
                                        Orders Customer
                                    </a>
                                </li>
                            @endif

                            {{-- Tampilkan tombol Products (Admin) hanya untuk admin --}}
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="btn btn-outline-pink me-2" href="{{ route('admin.index') }}">
                                        Products (Admin)
                                    </a>
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
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center small">
            &copy; {{ date('Y') }} ER Wedding. All rights reserved.
        </div>
    </footer>

    {{-- Vendor JS  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- {!! NoCaptcha::renderJs() !!} --}}

    @stack('scripts')
    @yield('scripts')
</body>
</html>
