@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form untuk mengupdate profil pengguna -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')  <!-- Menambahkan method PUT untuk mengupdate -->

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
    </form>

    <!-- Form untuk mengupdate password -->
    <hr class="my-4">
    <h3>Ganti Password</h3>
    <form action="{{ route('profile.updatePassword') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label">Password Lama</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
            @error('new_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-pink">Ubah Password</button>
    </form>

    <!-- Form untuk menghapus akun -->
    <hr class="my-4">
    <h3>Hapus Akun</h3>
    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <p class="text-danger">Dengan menghapus akun, Anda akan kehilangan semua data dan tidak bisa mengembalikannya.</p>
        <button type="submit" class="btn btn-danger">Hapus Akun</button>
    </form>
</div>
@endsection
