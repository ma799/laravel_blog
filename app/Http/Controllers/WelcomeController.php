<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    
    public function index(){

        $search = request()->query('search');
         if ($search) {
            // $posts = Post::where('title','like',"%{$search}%")->simplePaginate(1)->withQueryString();
            $posts = Post::where('title','like',"%{$search}%")->simplePaginate(1);
         }else {
            $posts = Post::simplePaginate(1);
         }
    
        return view('welcome',[
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => $posts,
        ]);

    }


    
    public function category(Category $category){

        $search = request()->query('search');
        if ($search) {
           $posts = $category->posts()->where('title','like',"%{$search}%")->simplePaginate(1);
        }else {
           $posts = $category->posts()->simplePaginate(1);
        }
   
        return view('blog.category',[
           'categories' => Category::all(),
           'tags' => Tag::all(),
           'posts' => $posts,
           'category' => $category,
       ]);
    }

    public function tag(Tag $tag){
        $search = request()->query('search');
        if ($search) {
           $posts = $tag->posts()->where('title','like',"%{$search}%")->simplePaginate(1);
        }else {
           $posts = $tag->posts()->simplePaginate(1);
        }
   
        return view('blog.tag',[
           'categories' => Category::all(),
           'tags' => Tag::all(),
           'posts' => $posts,
           'tag' => $tag,
       ]);
    }


}
