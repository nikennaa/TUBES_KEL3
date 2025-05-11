<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $commentData = $request->only(['comment', 'rating']);
        $commentData['user_id'] = auth()->id();
        $commentData['product_id'] = $product->id;

        $product->comments()->create($commentData);

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('products.show', $comment->product_id)
                         ->with('success', 'Komentar berhasil diperbarui!');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $productId = $comment->product_id;
        $comment->delete();

        return redirect()->route('products.show', $productId)
                         ->with('success', 'Komentar berhasil dihapus!');
    }
}
