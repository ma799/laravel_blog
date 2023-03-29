<?php

namespace App\Http\Controllers;

use App\Http\Middleware\verifyCategoryCount;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   
    public function  __construct()
    {
        $this->middleware('categoryCount')->only(['create','store']);
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create',[ 'tags' => Tag::all() , 'categories' => Category::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $image  = $request->image->store('posts');
        $post = Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'published_at'=>$request->published_at,
            'image'=>$image,
            'category_id'=>$request->category_id,
        ]);
        if($request->tags){
        $post->tags()->attach($request->tags);
        }
        return redirect()->route('posts.index')->with('success','Post Inserted Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
       return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {  
        return view('posts.create',['tags' => Tag::all() ,'post'=>$post,'categories'=>Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only([ 'title', 'description', 'content', 'published_at','category_id']);
        
        if ($request->hasFile('image')) {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $request->validated($post);
        $post->update($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('posts.index')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
    $post = Post::withTrashed()->findorFail($id);
        if ($post->trashed()) {
            $post->forceDelete();
            $post->deleteImage();
           }else{
               $post->delete();
            }
            return redirect()->route('posts.index')->with('success','Post deleted Successfully');
    }

    public function trash(Post $post)
    {
        $posts = Post::withTrashed()->get();//onlyTrashed
        return view('posts.index',compact('posts'));
    }
    
    public function restore($id)
    {
        $post = Post::withTrashed()->findorFail($id);
        $post->restore();//onlyTrashed
        return redirect(route('posts.index'))->with('success','Post restored Successfully');
    }
}
