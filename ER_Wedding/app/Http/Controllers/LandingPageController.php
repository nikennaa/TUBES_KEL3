<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Product;


class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $search_box = $request->input('search_box');

        // Check if search query exists and fetch results
        if ($search_box) {
            $products = Product::where('name', 'LIKE', '%' . $search_box . '%')->get();
        } else {
            $products = Product::all();  // Show all products if no search term
        }

        // Return the view with the products and search query
        return view('searchPage', compact('products'));
    }

    public function addToWishlist(Request $request)
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in to add items to wishlist');
        }

        $user = auth()->user(); // Mendapatkan user yang sedang login

        // Ambil data yang dikirimkan dari form
        $product_id = $request->input('product_id');
        $product_name = $request->input('name'); // Mengambil 'name' dari form
        $product_price = $request->input('price'); // Mengambil 'price' dari form
        $product_description = $request->input('description'); // Mengambil 'description' dari form
        $product_image = $request->input('image'); // Mengambil 'image' dari form

        // Cek apakah produk sudah ada di wishlist
        $existingWishlist = Wishlist::where('user_id', $user->id)
            ->where('name', $product_name)
            ->first();

        if ($existingWishlist) {
            return back()->with('message', 'Product already in wishlist');
        }

        // dd($request->all());

        // Jika produk tidak ada di wishlist, simpan ke wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product_id,
            'name' => $product_name,
            'description' => $product_description,
            'price' => $product_price,
            'image' => $product_image
        ]);

        return back()->with('message', 'Product added to wishlist');
    }

    public function showWishlist()
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to view your wishlist.');
    }

    $wishlistItems = Wishlist::where('user_id', auth()->id())->get();

    return view('wishlist.index', compact('wishlistItems'));
}


    // public function searchPage(Request $request)
    // {
    //     $search_box = $request->input('search_box'); // Get the search input

    //     if ($search_box) {
    //         // Search for products
    //         $products = Product::where('name', 'LIKE', '%' . $search_box . '%')->get();
    //     } else {
    //         $products = []; // Empty array when no search query is given
    //     }

    //     return view('searchPage', compact('products'));
    // }


}

