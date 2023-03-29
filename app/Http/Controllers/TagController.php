<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\tags\CreateTagRequest;
use App\Http\Requests\tags\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index',compact('tags'));
    }
  
    public function create()
    {
        return view('tags.create');
    }

    public function store(CreateTagRequest $request)
    {
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success','Todo Inserted Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.create',compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    { 
        $request->validated($tag);
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success','Todo Updated Successfully');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {
            session()->flash('error','there are posts already using this tag');
            return redirect()->route('tags.index');
        }else{

            $tag->delete();
            return redirect()->route('tags.index')->with('success','Todo Deleted Successfully');
        }
    }
}
