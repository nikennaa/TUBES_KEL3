@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah User Baru</h2>
    <form method="POST" action="{{ route('superadmin.store') }}">
        @csrf
        <label>Nama:</label>
        <input type="text" name="name" class="form-control" required>
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
        <label>Password:</label>
        <input type="password" name="password" class="form-control" required>
        <label>Role:</label>
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
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
