<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Product $product)
    {
        return response()->json($product->comments()->with('user')->latest()->get());
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'content' => 'required|string|max:255',
    ]);

    $comment = Comment::create([
        'product_id' => $request->product_id,
        'user_id' => Auth::id(),
        'content' => $request->content,
    ]);

    // Trả về bình luận mới kèm thông tin người dùng
    return response()->json($comment->load('user'));
}

}
