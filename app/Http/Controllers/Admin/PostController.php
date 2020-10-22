<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        /* poichè sono nella sezione admin devo mostrare solo i post dell'utente corrente */
        $id = Auth::id();
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        /* aggiungo id da Auth */
        $data = request()->all();

        $tags = $data['tags'];

        $this->postValidation();

        /* inserisco id nell'array */
        $data['user_id'] = Auth::id();
        /* inserisco slug nell'array */

        $data['slug'] = (Str::slug($data['title']));

        /* $result = Post::create($data); */
        /* $result->tags()->attach($data['tags']); */

        /* crea oggetto di classe Post */
        $newPost = new Post;

        /* lo filla */
        $newPost->fill($data);

        /* lo salva */
        $result = $newPost->save();

        $newPost->tags()->attach($tags);

        if ($result) {
            return redirect(route('posts.index'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {

        $data = request()->all();

        $this->postValidation();

        $data['slug'] = Str::slug($data['title']);

        $post->update($data);

        return redirect(route('posts.index'))->with('status', ['success', "{$post->user->name} - Post modificato correttamente"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {

        $post->delete();

        return redirect(route('posts.index'))->with('status', ['danger', "{$post->user->name} - Post cancellato correttamente"]);

    }

    private function postValidation() {

        request()->validate([
            'title' => 'required|min:5|max:100',
            'body' => 'required|min:5|max:500',
        ]);
    }

}
