<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePostsRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('verifycategorycount')->only(['create','store']);
    }
    public function index()
    {
        //
        return view('posts.index')
            ->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('posts.create')
            ->with('categories', Category::pluck('name','id'))
            ->with('tags', Tag::pluck('name','id'));
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
       // dd($request->all());
            $image = $request->image->store('posts','public');

        //create new post
        $post = Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request['content'],
            'image'=>$image,
            'category_id'=>$request->category_id,
            'user_id'=> auth()->user()->id
        ]);
        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }

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

        return view('posts.create')
            ->with('post',$post)
            ->with('categories', Category::pluck('name','id'))
            ->with('tags',$post->tags->pluck('name','id')->toArray());
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
            'category_id'=>$request->category_id,
            'image'=>$image
        ]);
       if($request->tags)
       {
           $post->tags()->sync($request->tags);
       }

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
