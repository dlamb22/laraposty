<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware(['auth'])->only('store', 'destroy');
    }

    public function index() {
        // Get all the post to output to screen
        $posts = Post::with(['user', 'likes'])->orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post
        ]);
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

    public function destroy(Post $post) {
        
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}