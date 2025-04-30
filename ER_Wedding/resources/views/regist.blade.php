@extends('app')

@section('title', 'Regist')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<section class="form-container">

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="message">
            <span>{{ session('success') }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endif

    {{-- Tampilkan error --}}
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="message">
                <span>{{ $error }}</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        @endforeach
    @endif

    <form action="{{ route('regist') }}" method="POST">
        @csrf
        <h3>register now</h3>

        <input type="text" name="name" class="box" placeholder="enter your username" required>
        <input type="email" name="email" class="box" placeholder="enter your email" required>
        <input type="password" name="pass" class="box" placeholder="enter your password" required>
        <input type="password" name="cpass" class="box" placeholder="confirm your password" required>

        <input type="submit" class="btn" name="submit" value="register now">

        <p>already have an account? <a href="{{ route('login') }}">login now</a></p>
    </form>

</section>

@endsection
