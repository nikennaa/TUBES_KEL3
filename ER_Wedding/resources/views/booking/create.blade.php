@extends('layouts.app')

@section('title', 'Create Wedding Booking')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/backup_admin_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

    <section class="wedding-booking-form">
        <form action="{{ route('wedding.store') }}" method="POST">
            @csrf
            <h3>Wedding Booking Form</h3>
            <div class="form-wrapper">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

            <!-- Informasi Pasangan Pengantin -->
            <div class="form-row">
                <div class="form-group">
                    <label for="groom_name">Groom's Name</label>
                    <input type="text" class="box" name="groom_name" required placeholder="Groom's Name">
                </div>
                <div class="form-group">
                    <label for="bride_name">Bride's Name</label>
                    <input type="text" class="box" name="bride_name" required placeholder="Bride's Name">
                </div>
            </div>

            <!-- Kontak -->
            <div class="form-row">
                <div class="form-group">
                    <label for="contact_phone">Phone Number</label>
                    <input type="tel" class="box" name="contact_phone" required placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="contact_email">Email Address</label>
                    <input type="email" class="box" name="contact_email" required placeholder="Email Address">
                </div>
            </div>

            <!-- Tanggal dan Waktu Pernikahan -->
            <div class="form-row">
                <div class="form-group">
                    <label for="wedding_date">Wedding Date</label>
                    <input type="date" class="box" name="wedding_date" required placeholder="Wedding Date">
                </div>

                <div class="form-group">
                    <label for="wedding_time">Wedding Time</label>
                    <input type="time" class="box" name="wedding_time" required placeholder="Wedding Time">
                </div>
            </div>

            <!-- Lokasi Pernikahan -->
            <div class="form-row">
                <div class="form-group">
                    <label for="venue_name">Venue Name</label>
                    <input type="text" class="box" name="venue_name" required placeholder="Venue Name">
                </div>
                <div class="form-group">
                    <label for="venue_address">Venue Address</label>
                    <input type="text" class="box" name="venue_address" required placeholder="Venue Address">
                </div>
            </div>

            <!-- Jumlah Tamu dan Anggaran -->
            <div class="form-row">
                <div class="form-group">
                    <label for="guest_count">Guest Count</label>
                    <input type="text"
                    class="box"
                    name="guest_count"
                    required
                    placeholder="Guest Count"
                    inputmode="numeric"
                    pattern="[0-9]+">
                </div>
                <div class="form-group">
                    <label for="estimated_budget">Estimated Budget</label>
                    <input type="text"
                    class="box"
                    name="estimated_budget"
                    required
                    placeholder="Estimated Budget (min. Rp500.000)"
                    inputmode="numeric"
                    pattern="[0-9]{6,}">
                </div>
            </div>

            <!-- Pembayaran -->
            <div class="form-row">
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" class="box">
                        <option value="dp">Down Payment</option>
                        <option value="full_payment">Full Payment</option>
                    </select>
                </div>
            </div>

            <!-- Catatan Tambahan -->
            <div class="form-group">
                <label for="notes">Notes (optional)</label>
                <textarea name="notes" class="box" placeholder="Notes (optional)" cols="30" rows="5"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Submit" class="btn">
            </div>
        </form>
    </section>
@endsection
