@extends('layouts.app')

@section('title', 'Wedding Booking List')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
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
                    <th>Aksi</th> {{-- ✅ Tambahkan aksi --}}
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->groom_name }} & {{ $booking->bride_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->wedding_date)->format('d M Y') }}</td>
                        <td>{{ $booking->guest_count }}</td>
                        <td>
                            <form action="{{ route('user.orders.updateStatus', $booking->id) }}" method="POST" style="margin-bottom:4px;">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="belum lunas" {{ $booking->status === 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="lunas" {{ $booking->status === 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('user.orders.destroy', $booking->id) }}" method="POST" style="display:inline;">
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
