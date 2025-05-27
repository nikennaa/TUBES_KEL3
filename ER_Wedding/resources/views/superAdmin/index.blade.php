<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Superadmin</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffc0cb; /* pink background */
            background-image: url('/images/white-flower.png'),
                              url('/images/white-flower.png'),
                              url('/images/white-flower.png'),
                              url('/images/white-flower.png');
            background-repeat: no-repeat;
            background-position: top left, top right, bottom left, bottom right;
            background-size: 100px;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #d63384;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #f8d7da;
        }

        a.button {
            padding: 8px 12px;
            background-color: #d63384;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: #a61e56;
        }

    </style>
</head>
<body>
    <div class="container">
            <a href="{{ route('landingPage') }}" class="btn btn-secondary">← Back</a>

        <h1>Dashboard Superadmin</h1>

        <a href="{{ route('superadmin.create') }}" class="button">+ Tambah User</a>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('superadmin.edit', $user->id) }}" class="button">Edit</a>
                        <form action="{{ route('superadmin.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" style="background-color:#dc3545;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
