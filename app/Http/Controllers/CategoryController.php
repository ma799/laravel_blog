<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\categories\CreateCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;

class CategoryController extends Controller
{
  
    public function index()
    {
        $categories = Category::all();
        return view('cat.index',compact('categories'));
    }
  
    public function create()
    {
        return view('cat.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success','Todo Inserted Successfully');
    }

    
    public function show(Category $category)
    {
        
    }

    
    public function edit(Category $category)
    {
        return view('cat.create',compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    { 
        $request->validated($category);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success','Todo Updated Successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->posts->count() > 0) {
            session()->flash('error','there are posts already in this category');
            return redirect()->back();
        }else{
            $category->delete();
            return redirect()->route('categories.index')->with('success','Todo Deleted Successfully');
        }
    }
}
