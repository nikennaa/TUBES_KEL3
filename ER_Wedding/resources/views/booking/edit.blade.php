@extends('layouts.app')

@section('title', 'Edit Wedding Booking')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<section class="wedding-booking-form">
    <form action="{{ route('wedding.update', $booking->id) }}" method="POST"> <!-- Ubah action ke update -->
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk memperbarui data -->

        <h3>Wedding Booking Edit</h3>
        <div class="form-wrapper">
        <!-- Layout 2 Kolom -->
        <div class="form-row">
            <!-- Informasi Pasangan Pengantin -->
            <div class="form-group">
                <label for="groom_name">Groom's Name</label>
                <input type="text" class="box" name="groom_name" value="{{ $booking->groom_name }}" required placeholder="Groom's Name">
            </div>

            <div class="form-group">
                <label for="bride_name">Bride's Name</label>
                <input type="text" class="box" name="bride_name" value="{{ $booking->bride_name }}" required placeholder="Bride's Name">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="contact_phone">Phone Number</label>
                <input type="tel" class="box" name="contact_phone" value="{{ $booking->contact_phone }}" required placeholder="Phone Number">
            </div>

            <div class="form-group">
                <label for="contact_email">Email Address</label>
                <input type="email" class="box" name="contact_email" value="{{ $booking->contact_email }}" required placeholder="Email Address">
            </div>
        </div>

        <div class="form-row">
            <!-- Tanggal dan Waktu Pernikahan -->
            <div class="form-group">
                <label for="wedding_date">Wedding Date</label>
                <input type="date" class="box" name="wedding_date" value="{{ $booking->wedding_date }}" required placeholder="Wedding Date">
            </div>

            <div class="form-group">
                <label for="wedding_time">Wedding Time</label>
                <input type="time" class="box" name="wedding_time" value="{{ $booking->wedding_time }}" required placeholder="Wedding Time">
            </div>
        </div>

        <div class="form-row">
            <!-- Lokasi Pernikahan -->
            <div class="form-group">
                <label for="venue_name">Venue Name</label>
                <input type="text" class="box" name="venue_name" value="{{ $booking->venue_name }}" required placeholder="Venue Name">
            </div>

            <div class="form-group">
                <label for="venue_address">Venue Address</label>
                <input type="text" class="box" name="venue_address" value="{{ $booking->venue_address }}" required placeholder="Venue Address">
            </div>
        </div>

        <div class="form-row">
            <!-- Jumlah Tamu -->
            <div class="form-group">
                <label for="guest_count">Guest Count</label>
                <input type="number" class="box" name="guest_count" value="{{ $booking->guest_count }}" required placeholder="Guest Count">
            </div>

            <!-- Anggaran dan Pembayaran -->
            <div class="form-group">
                <label for="estimated_budget">Estimated Budget</label>
                <input type="number" class="box" name="estimated_budget" value="{{ $booking->estimated_budget }}" required placeholder="Estimated Budget">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" class="box">
                    <option value="dp" {{ $booking->payment_method == 'dp' ? 'selected' : '' }}>Down Payment</option>
                    <option value="full_payment" {{ $booking->payment_method == 'full_payment' ? 'selected' : '' }}>Full Payment</option>
                </select>
            </div>

            <!-- Catatan Tambahan -->
            <div class="form-group">
                <label for="notes">Notes (optional)</label>
                <textarea name="notes" class="box" placeholder="Notes (optional)" cols="30" rows="5">{{ $booking->notes }}</textarea>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group">
            <input type="submit" value="Update Booking" class="btn">
        </div>
    </form>
</section>

@endsection
