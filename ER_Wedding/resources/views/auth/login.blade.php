@extends('layouts.app')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<section class="form-container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h3>Login Now</h3>

        <input type="email" name="email" class="box" value="{{ old('email') }}" placeholder="Enter your email" required>
        @error('email')
            <p class="text-danger mt-1" style="font-size: 1.4rem;">{{ $message }}</p>
        @enderror

        <input type="password" name="password" class="box" placeholder="Enter your password" required>
        @error('password')
            <p class="text-danger mt-1" style="font-size: 1.4rem;">{{ $message }}</p>
        @enderror

        {{-- reCAPTCHA --}}
        <div class="captcha-center">
            {!! NoCaptcha::display() !!}
            @error('g-recaptcha-response')
                <p class="text-danger mt-1" style="font-size: 1.4rem;">{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" class="btn" value="Login Now">

        <p>Don't have an account? <a href="{{ route('register') }}">Register now</a></p>
    </form>

    @if(session('error') || session('success'))
        @php
            $type = session('error') ? 'error' : 'success';
            $message = session($type);
            $bgColor = $type === 'error' ? '#e74c3c' : '#2ecc71';
            $id = $type . 'Message';
        @endphp

        <div id="{{ $id }}" style="background-color: {{ $bgColor }}; color: white; padding: 1.5rem; border-radius: .5rem; margin-top: 2rem; max-width: 500px; margin-inline: auto; position: relative;">
            <span>{{ $message }}</span>
            <button onclick="document.getElementById('{{ $id }}').style.display='none'" style="position: absolute; right: 1rem; top: 1rem; font-weight: bold; background: none; border: none; color: white;">X</button>
        </div>

        <script>
            setTimeout(() => {
                const msg = document.getElementById('{{ $id }}');
                if (msg) msg.style.display = 'none';
            }, 5000);
        </script>
    @endif
</section>
@endsection

{{-- Tambahkan ini untuk memuat JS reCAPTCHA --}}
@push('scripts')
    {!! NoCaptcha::renderJs() !!}
@endpush
