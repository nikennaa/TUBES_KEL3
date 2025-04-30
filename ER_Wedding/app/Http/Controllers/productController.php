<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Cek kalau belum login
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }

        $products = DB::table('products')->get();
        return view('product', compact('products'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'detail' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'required|image|max:2048',
            ]);

            $imagePath = $request->file('image')->store('uploaded_img', 'public');

            DB::table('products')->insert([
                'nama_produk' => $request->nama_produk,
                'detail' => $request->detail,
                'price' => $request->price,
                'image' => basename($imagePath),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id_product)
    {
        // Cek kalau belum login
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }

        $product = DB::table('products')->where('id_product', $id_product)->first();

        if ($product) {
            if ($product->image) {
                Storage::disk('public')->delete('uploaded_img/' . $product->image);
            }

            DB::table('products')->where('id_product', $id_product)->delete();

            return redirect()->back()->with('success', 'Product deleted successfully!');
        }

        return redirect()->back()->withErrors('Product not found.');
    }

    public function edit($id_product)
{
    $product = DB::table('products')->where('id_product', $id_product)->first();

    if (!$product) {
        return redirect()->back()->withErrors('Product not found.');
    }

    return view('updateProduct', compact('product'));
}


}
