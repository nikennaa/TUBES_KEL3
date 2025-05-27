<?php

namespace App\Http\Controllers;

use App\Models\WeddingBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class WeddingBookingController extends Controller
{
   public function index()
{
    $products = Product::all();
    $bookings = WeddingBooking::with('product')->get(); // include relasi product jika ada

    return view('booking.index', compact('products', 'bookings'));
}

    // Menampilkan form untuk membuat booking
  public function create($productId)
{
    $product = Product::findOrFail($productId);
    return view('booking.create', compact('product'));
}
    // Menyimpan data booking baru

// ...

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'nullable|exists:products,id',
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
        'notes' => 'nullable|string',
        'services' => 'nullable|array',
    ]);

    WeddingBooking::create([
        'user_id' => auth()->id(), // ✅ INI WAJIB!
        'product_id' => $request->product_id,
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
        'services' => json_encode($request->services),
        'status' => 'belum lunas', // optional, karena default-nya sudah 'belum lunas'
    ]);

    return redirect()->route('my.orders')->with('success', 'Wedding booked successfully!');
}



    // Menampilkan form untuk mengedit booking yang ada
    public function edit($id)
    {
        // Mengambil data booking yang akan diedit berdasarkan ID
       $booking = WeddingBooking::findOrFail($id);


        // Jika booking tidak ditemukan, kembalikan dengan pesan error
        if (!$booking) {
            return redirect()->route('wedding.index')->withErrors('Booking not found!');
        }

        return view('booking.edit', compact('booking'));  // Mengirimkan data booking ke view edit
    }

    // Menyimpan perubahan pada booking yang sudah ada
    public function update(Request $request, $id)
    {
        //  \Log::info('Form submitted data:', $request->all()); // log semua input
        // Validasi data yang akan diupdate
       $booking = WeddingBooking::findOrFail($id);

//  $request->validate([
//         'product_id' => 'nullable|exists:products,id',
//         'groom_name' => 'required|string|max:255',
//         'bride_name' => 'required|string|max:255',
//         'contact_phone' => 'required|string|max:15',
//         'contact_email' => 'required|email|max:255',
//         'wedding_date' => 'required|date',
//         'wedding_time' => 'required|date_format:H:i',
//         'venue_name' => 'required|string|max:255',
//         'venue_address' => 'required|string|max:255',
//         'guest_count' => 'required|integer',
//         'estimated_budget' => 'required|numeric',
//         'payment_method' => 'required|string',
//         'notes' => 'nullable|string',
//         'services' => 'nullable|array',
//     ]);

    $booking->update([
    'product_id' => $request->product_id,
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
    'services' => json_encode($request->services),
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

public function myOrders()
{
    $bookings = WeddingBooking::where('id', auth()->id())->get();
    $products = Product::all(); // ✅ tambahkan ini

    return view('booking.index', compact('bookings', 'products'));
}

}
