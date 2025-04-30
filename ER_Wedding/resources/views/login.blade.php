@extends('app')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<section class="form-container">

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <h3>login now</h3>

        <input type="email" name="email" class="box" placeholder="enter your email" required>
        <input type="password" name="pass" class="box" placeholder="enter your password" required>

        <input type="submit" class="btn" name="submit" value="login now">

        <p>don't have an account? <a href="{{ url('/regist') }}">register now</a></p>

    </form>

</section>
@endsection
