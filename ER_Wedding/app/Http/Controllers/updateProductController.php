<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class UpdateProductController extends Controller
{
    public function update(Request $request, $id_product)
    {
        try {
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'detail' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'nullable|image|max:2048',
            ]);

            $product = DB::table('products')->where('id_product', $id_product)->first();

            if (!$product) {
                return redirect()->back()->withErrors('Product not found.');
            }

            // Update nama_produk, detail, dan price
            DB::table('products')->where('id_product', $id_product)->update([
                'nama_produk' => $request->nama_produk,
                'detail' => $request->detail,
                'price' => $request->price,
                'updated_at' => now(),
            ]);

            // Update gambar kalau upload baru
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploaded_img', 'public');

                if ($product->image) {
                    Storage::disk('public')->delete('uploaded_img/' . $product->image);
                }

                DB::table('products')->where('id_product', $id_product)->update([
                    'image' => basename($imagePath),
                ]);
            }

            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
