<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::All();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::All();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        /*
            1. validazione dei dati
        */

        // $request->validate(
        //     [
        //         'title' => 'required|unique:posts|max:255',
        //     ],
        //     [
        //         'title.required' => 'Il campo è obbligatorio',
        //         'title.unique' => "Il campo è già esistente",
        //         'title.max' => 'Il campo non può superare i 255 caratteri'
        //     ]
        // );

        $form_data = $request->validated();

        $form_data = $request->All();

        $slug = Post::titleToSlug($request->title);


        $form_data['slug'] = $slug;

        if ($request->hasFile('cover_image')) {
            $img = Storage::disk('public')->put('post_images', $request->cover_image);
            $form_data['cover_image'] = $img;
        }

        $newPost = new Post();
        $newPost->fill($form_data);
        $newPost->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {


        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::All();

        return view('admin.posts.update', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->validated();
        $form_data = $request->All();
        $slug = Post::titleToSlug($request->title);
        $form_data['slug'] = $slug;
        if ($request->hasFile('cover_image')) {

            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }

            $img = Storage::disk('public')->put('post_images', $request->cover_image);
            $form_data['cover_image'] = $img;
        }

        $post->update($form_data);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if ($post->cover_image) {

            Storage::delete($post->cover_image);
        }

        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
