<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('posts.index');
    }

    public function store(Request $request) {
        // Validate
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Create new post
        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();

        // Post::create([
        //     'user_id' => auth()->id(),
        //     'body' => $request->body
        // ]);
    }
}
