@extends('layouts.app')

@section('title', 'Manajemen Order')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<section class="booking-list">
    <h3>Daftar Semua Booking Pernikahan</h3>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Produk</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? '-' }}</td>
                        <td>{{ $booking->product->name ?? '-' }}</td>
                        <td>{{ $booking->wedding_date }}</td>
                        <td>
                            <form action="{{ route('superadmin.orders.updateStatus', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="belum lunas" {{ $booking->status === 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="lunas" {{ $booking->status === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('superadmin.orders.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('superadmin.orders.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus booking ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
