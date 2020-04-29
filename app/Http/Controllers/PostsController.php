<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostsRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreatePostsRequest $request)
    {
        //upload the image to the storage

            $image = $request->image->store('posts','public');

        //create new post
        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request['content'],
            'image'=>$image
        ]);
        //flash message
        session()->flash('success','Post was successfully created');
        //redirect
        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        //
        return view('posts.create')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CreatePostsRequest $request, Post $post)
    {

       if($request->hasFile('image'))
       {
           //upload the image to the storage
           $image = $request->image->store('posts','public');

           //Delete old image
           $post->deleteImage();
       }
        //update post
        $post->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request['content'],
            'image'=>$image
        ]);

        //flash message
        session()->flash('success','Post was updated created');

        //redirect
        return redirect(route('posts.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //
        $post = Post::withTrashed()->where('id',$id)->first();

        if(!$post->trashed())
        {
            $post->delete();

            session()->flash('success','Post was successfully trashed');

        }
        else{
            $post->forceDelete();
            $post->deleteImage();
            session()->flash('success','Post was successfully deleted');
        }
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.index', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();

        $post->restore();

        session()->flash('success','Post was successfully restored');

        return redirect(route('posts.index'));
    }



}
