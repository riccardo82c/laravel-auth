<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);
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
        $data = request()->all();
        $this->postValidation('unique:posts|');

        $data['user_id'] = Auth::id();
        $data['slug'] = (Str::slug($data['title']));
        $data['created_at'] = Carbon::now('Europe/Rome');

        if (!empty($data['img'])) {
            $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }
        $newPost = new Post;
        $newPost->fill($data);
        $result = $newPost->save();

        /* $result = Post::create($data); */

        if (!empty($data['tags'])) {
            $newPost->tags()->attach($data['tags']);
        }

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

        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));

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
        $this->postValidation('');

        $data['slug'] = Str::slug($data['title']);
        $data['updated_at'] = Carbon::now('Europe/Rome');

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        if (!empty($data['img'])) {
            if (!empty($post->img)) {
                Storage::disk('public')->delete($post->img);
            }
            $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }

        $result = $post->update($data);

        if ($result) {
            return redirect(route('posts.index'))->with('status', ['success', "{$post->user->name} hai modificato correttamente il post"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $post->delete();
        return redirect(route('posts.index'))->with('status', ['danger', "{$post->user->name} hai cancellato correttamente il post"]);
    }

    /* funzione validazione */
    private function postValidation($flag) {
        request()->validate([
            'title' => $flag . 'required|min:5|max:100',
            'body' => 'required|min:5|max:500',
            'img' => 'image',
        ]);
    }

}
