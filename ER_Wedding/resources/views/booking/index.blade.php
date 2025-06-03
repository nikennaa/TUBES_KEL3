@extends('layouts.app')

@section('title', 'Wedding Booking List')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/backup_admin_style.css') }}">
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

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Groom & Bride</th>
                    <th>Wedding Date</th>
                    <th>Guest Count</th>
                    <th>Status</th>
                    @if(auth()->user()->role !== 'buyer')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->groom_name }} & {{ $booking->bride_name }}</td>
                        <td>{{ $booking->wedding_date }}</td>
                        <td>{{ $booking->guest_count }}</td>
                        <td>{{ $booking->status ?? 'Belum Ditentukan' }}</td>

                        @if(auth()->user()->role !== 'buyer')
                            <td>
                                <a href="{{ route('wedding.edit', $booking->id) }}" class="btn edit-btn">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('wedding.destroy', $booking->id) }}" class="btn delete-btn" onclick="return confirm('Delete this booking?');">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection

<style>
body {
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Pastikan body setinggi layar */
}

main {
    background-color: var(--br-light);
    color: var(--br-navy);
    flex: 1 0 auto;    /* Ambil ruang vertikal yang tersisa, tdk perlu min-height */
    width: 100%;       /* Pastikan lebarnya full-width */
}

footer {
    margin-top: auto;  /* Memastikan footer berada di bawah halaman */
}
</style>
