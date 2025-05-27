@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Booking Orders - Super Admin</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Wedding Date</th>
                <th>Status</th>
                <th>Update Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? '-' }}</td>
                    <td>{{ $booking->product->name ?? '-' }}</td>
                    <td>{{ $booking->wedding_date }}</td>
                    <td>{{ $booking->status ?? 'belum lunas' }}</td>
                    <td>
                        <form method="POST" action="{{ route('superadmin.orders.updateStatus', $booking->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="belum lunas" {{ $booking->status == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="lunas" {{ $booking->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('superadmin.orders.edit', $booking->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('superadmin.orders.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
