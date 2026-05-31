<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // Misalnya di ProductController
    public function index()
    {
    // Ambil 3 produk terbaru berdasarkan tanggal dibuat
    $products = Product::orderBy('created_at', 'desc')->take(3)->get();

    return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $validated['name'],
            'description'      => $validated['description'],
            'price'       => $validated['price'],
            'image'       => isset($imagePath) ? basename($imagePath) : null,
        ]);

        session()->flash('success', 'Produk berhasil dibuat!');
        return redirect()->route('admin.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('comments.user')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $productData = $request->only('name', 'description', 'price', 'image');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        $product->update($productData);

        session()->flash('success', 'Produk berhasil diperbarui!');

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        $product->delete();
        session()->flash('success', 'Produk berhasil dihapus!');
        return redirect()->route('admin.index');
    }

    public function allProducts(Request $request)
    {
        $query = Product::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        // Kirim ke view all_products.blade.php
        return view('products.all_products', compact('products'));
    }


}
