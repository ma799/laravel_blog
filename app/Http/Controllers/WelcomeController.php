<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    
    public function index(){

        return view('welcome',[
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => Post::Searched(),
        ]);

    }


    
    public function category(Category $category){
   
        return view('blog.category',[
           'categories' => Category::all(),
           'tags' => Tag::all(),
           'posts' => $category->posts()->searched(),
           'category' => $category,
       ]);
    }

    public function tag(Tag $tag){
      //   $search = request()->query('search');
      //   if ($search) {
      //      $posts = $tag->posts()->where('title','like',"%{$search}%")->simplePaginate(1);
      //   }else {
      //      $posts = $tag->posts()->simplePaginate(1);
      //   }
        return view('blog.tag',[
           'categories' => Category::all(),
           'tags' => Tag::all(),
           'posts' => $tag->posts()->searched(),
           'tag' => $tag,
       ]);
    }

   //  comment one


}
