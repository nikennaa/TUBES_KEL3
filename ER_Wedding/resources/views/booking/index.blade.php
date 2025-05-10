@extends('app')

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
    <a href="{{ route('wedding.create') }}" class="btn add-new-btn">Add New Booking</a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Groom & Bride</th>
                    <th>Wedding Date</th>
                    <th>Guest Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->groom_name }} & {{ $booking->bride_name }}</td>
                        <td>{{ $booking->wedding_date }}</td>
                        <td>{{ $booking->guest_count }}</td>
                        <td>
                            <a href="{{ route('wedding.edit', $booking->id) }}" class="btn edit-btn">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('wedding.destroy', $booking->id) }}" class="btn delete-btn" onclick="return confirm('Delete this booking?');">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
