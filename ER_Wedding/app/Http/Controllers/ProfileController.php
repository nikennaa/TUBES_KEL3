<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Mengupdate data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input dari form update
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update data profil pengguna
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    // Mengupdate password pengguna
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input password baru
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah password lama sesuai
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // Update password pengguna
        $user->update([
            'password' => Hash::make($validatedData['new_password']),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }

    // Menghapus akun pengguna
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Menghapus akun pengguna
        $user->delete();

        // Logout pengguna setelah dihapus
        Auth::logout();

        // Redirect ke halaman utama
        return redirect()->route('landingPage')->with('success', 'Akun Anda telah dihapus.');
    }
}
