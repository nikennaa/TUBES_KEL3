<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\WeddingBooking;
use App\Models\Produk;    // pastikan model Produk ada di App\Models


class SuperAdminController extends Controller
{
    public function index()
{
    $users = User::all();

    $totalCustomers = User::where('role', 'buyer')->count();

    $totalAdmins = User::whereIn('role', ['admin', 'superAdmin'])->count();

    return view('superadmin.index', compact(
        'users',
        'totalCustomers',
        'totalAdmins'
    ));
}

public function listCustomers()
{
    $users = User::where('role', 'buyer')->get();

    return view('superadmin.index', compact('users'));
}

public function listAdmins()
{
    $users = User::whereIn('role', ['admin', 'superAdmin'])->get();

    return view('superadmin.index', compact('users'));
}

    public function create()
    {
        return view('superadmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|string'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role
        ]);

        return redirect()->route('superadmin.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|string',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('superadmin.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('superadmin.index')->with('success', 'User berhasil dihapus.');
    }

public function orders()
{
    $bookings = WeddingBooking::with(['user', 'product'])->get();
    return view('superadmin.orders.index', compact('bookings'));
}


public function updateOrderStatus(Request $request, $id)
{
    $booking = WeddingBooking::findOrFail($id);
    $booking->status = $request->input('status');
    $booking->save();

    return redirect()->route('superadmin.orders')->with('success', 'Status updated.');
}

public function editOrder($id)
{
    $booking = WeddingBooking::findOrFail($id);
    return view('superadmin.orders.edit', compact('booking'));
}

public function destroyOrder($id)
{
    WeddingBooking::findOrFail($id)->delete();
    return redirect()->route('superadmin.orders')->with('success', 'Order berhasil dihapus.');
}

public function landingPage()
{
    $dashboardStats = [
        'numberOfProducts' => Produk::count(),

        'numberOfUsers' => User::count(),

        'numberOfCustomers' => User::where('role', 'buyer')->count(),

        'numberOfAdmins' => User::whereIn('role', ['admin', 'superAdmin'])->count(),
    ];

    return view('landingpage', compact('dashboardStats'));
}

}
