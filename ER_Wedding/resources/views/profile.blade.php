@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Profil Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tab Navigation --}}
    <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Informasi Akun</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">Ubah Password</button>
        </li>
    </ul>

    <div class="tab-content" id="profileTabContent">
        {{-- Informasi Akun --}}
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>

            {{-- Delete Account --}}
            <hr class="my-4" />
            <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Hapus Akun</button>
            </form>
        </div>

        {{-- Ubah Password --}}
        <div class="tab-pane fade" id="password" role="tabpanel">
            <form action="{{ route('profile.updatePassword') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-warning">Ubah Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
