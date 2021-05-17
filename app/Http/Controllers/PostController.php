<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        // Get all the post to output to screen
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
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

        return redirect()->route('posts');
    }
}