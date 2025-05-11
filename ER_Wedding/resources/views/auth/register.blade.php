@extends('layouts.app')

@section('title', 'register')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<section class="form-container">

    @if(session('success'))
        <div class="message">
            <span>{{ session('success') }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="message">
                <span>{{ $error }}</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        @endforeach
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <h3>register now</h3>

        <input type="text" name="name" class="box" placeholder="enter your username" required>
        <input type="email" name="email" class="box" placeholder="enter your email" required>
        <input type="password" name="password" class="box" placeholder="enter your password" required>
        <input type="password" name="password_confirmation" class="box" placeholder="confirm your password" required>

        <input type="submit" class="btn" name="submit" value="register now">

        <p>already have an account? <a href="{{ route('login') }}">login now</a></p>
    </form>

</section>

@endsection
