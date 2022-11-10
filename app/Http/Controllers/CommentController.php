<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function storeComment(Request $request)
    {
        Validator::make($request->all(), [
            'body' => ['required', 'string', 'max:255'],
        ])->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'body' => $request->body,
        ]);
    }

    public function getComments(Product $product)
    {
        return $product->comments;
    }
}
