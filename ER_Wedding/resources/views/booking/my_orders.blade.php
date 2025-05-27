@extends('layouts.app')

@section('title', 'Wedding Booking List')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="booking-list">
    <h3>Wedding Booking List</h3>
   @foreach($products as $product)
    <a href="{{ route('wedding.create', ['productId' => $product->id]) }}" class="btn add-new-btn">Add New Booking {{ $product->name }}</a>
@endforeach


    <div class="table-container">
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Groom & Bride</th>
                <th>Wedding Date</th>
                <th>Guest Count</th>
                <th>Status</th> {{-- ✅ Tambahkan status --}}
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->groom_name }} & {{ $booking->bride_name }}</td>
                    <td>{{ $booking->wedding_date }}</td>
                    <td>{{ $booking->guest_count }}</td>
                    <td>{{ $booking->status ?? 'Belum Ditentukan' }}</td> {{-- ✅ Tampilkan status --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</section>

@endsection
