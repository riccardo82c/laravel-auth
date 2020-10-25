<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function index() {
        $posts = Post::all();
        $tags = Tag::all();

        return view('guests.index', compact('posts', 'tags'));
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();

        return view('guests.show', compact('post'));
    }
}
