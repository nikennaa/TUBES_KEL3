<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeddingBookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('wedding_bookings')->get(); // Ambil data booking dari DB
    return view('booking.index', compact('bookings'));
    }

    // Menampilkan form untuk membuat booking
    public function create()
    {
        return view('booking.create');  // Mengarahkan ke form booking
    }

    // Menyimpan data booking baru
    public function store(Request $request)
    {
        // Validasi data form booking
        $request->validate([
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            'wedding_date' => 'required|date',
            'wedding_time' => 'required|date_format:H:i',
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'required|string|max:255',
            'guest_count' => 'required|integer',
            'estimated_budget' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Menyimpan data ke tabel wedding_bookings
        DB::table('wedding_bookings')->insert([
            'groom_name' => $request->groom_name,
            'bride_name' => $request->bride_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'wedding_date' => $request->wedding_date,
            'wedding_time' => $request->wedding_time,
            'venue_name' => $request->venue_name,
            'venue_address' => $request->venue_address,
            'guest_count' => $request->guest_count,
            'estimated_budget' => $request->estimated_budget,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'services' => json_encode($request->services),  // Menyimpan layanan yang dipilih dalam format JSON
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect ke halaman daftar booking dengan pesan sukses
        return redirect()->route('wedding.index')->with('success', 'Wedding booked successfully!');
    }

    // Menampilkan form untuk mengedit booking yang ada
    public function edit($id)
    {
        // Mengambil data booking yang akan diedit berdasarkan ID
        $booking = DB::table('wedding_bookings')->where('id', $id)->first();
        
        // Jika booking tidak ditemukan, kembalikan dengan pesan error
        if (!$booking) {
            return redirect()->route('wedding.index')->withErrors('Booking not found!');
        }

        return view('booking.edit', compact('booking'));  // Mengirimkan data booking ke view edit
    }

    // Menyimpan perubahan pada booking yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate
        $request->validate([
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            'wedding_date' => 'required|date',
            'wedding_time' => 'required|date_format:H:i',
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'required|string|max:255',
            'guest_count' => 'required|integer',
            'estimated_budget' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Update data booking yang sudah ada
        DB::table('wedding_bookings')->where('id', $id)->update([
            'groom_name' => $request->groom_name,
            'bride_name' => $request->bride_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'wedding_date' => $request->wedding_date,
            'wedding_time' => $request->wedding_time,
            'venue_name' => $request->venue_name,
            'venue_address' => $request->venue_address,
            'guest_count' => $request->guest_count,
            'estimated_budget' => $request->estimated_budget,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'services' => json_encode($request->services),  // Update layanan dalam format JSON
            'updated_at' => now(),
        ]);

        // Redirect ke halaman daftar booking dengan pesan sukses
        return redirect()->route('wedding.index')->with('success', 'Wedding booking updated successfully!');
    }

    // Menghapus booking dari database
    public function destroy($id)
    {
        // Menghapus data booking berdasarkan ID
        DB::table('wedding_bookings')->where('id', $id)->delete();
        
        // Redirect ke halaman daftar booking dengan pesan sukses
        return redirect()->route('wedding.index')->with('success', 'Booking deleted successfully!');
    }
}
