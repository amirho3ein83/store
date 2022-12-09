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
            'suggestion' => ['required', 'string', 'max:255'],
        ])->validate();

        Comment::create([
            'author_id' => Auth::id(),
            'product_id' => $request->product_id,
            'body' => $request->body,
            'suggestion' => $request->suggestion,
        ]);
    }

    public function getComments($id)
    {
        return Comment::where('product_id', $id)->limit(30)->get();
    }
}
