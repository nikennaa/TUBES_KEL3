@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form method="POST" action="{{ route('superadmin.update', $user->id) }}">
        @csrf
        @method('PUT')
        <label>Nama:</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        <label>Role:</label>
        <select name="role" class="form-control">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
             <option value="buyer" {{ $user->role == 'buyer' ? 'selected' : '' }}>Buyer</option>
             <option value="superAdmin" {{ $user->role == 'superAdmin' ? 'selected' : '' }}>Super Admin</option>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
