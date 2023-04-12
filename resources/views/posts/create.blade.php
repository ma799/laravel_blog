@extends('layouts.app')
@section('content')
@if ($errors->any())
      <div class="alert alert-danger"
            <ul>
                  @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                   @endforeach
            </ul>
      </div>
@endif
<div class="card">
    <div class="card-header">
       @isset($post)   Edit posts   @else   Add posts   @endisset 
    </div>
    <div class="card-body">
       <form enctype="multipart/form-data" action="@isset($post) {{ route('posts.update',$post)}} @else {{ route('posts.store') }} @endisset" method="post">

        @csrf
        @isset($post)   @method('PUT')   @endisset 

<label for="title" class="form-label fw-bold">Title</label>
<input type="text" value="@isset($post){{$post->title}}@endisset" name="title" placeholder="title" class="mb-5 form-control">

<label for="description" class="form-label fw-bold">Description</label>
<input type="text" value="@isset($post){{$post->description}}@endisset" name="description" placeholder="description" class="mb-5 form-control">

<label for="content" class="form-label fw-bold">Content</label>
<input id="content" type="hidden" value="@isset($post){{$post->content}}@endisset" name="content" placeholder="content" class=" form-control">
<trix-editor class="mb-5" input="content"></trix-editor>

<label for="published_at" class="form-label fw-bold">Published_at</label>
<input type="text" value="@isset($post){{ $post->published_at }}@endisset" name="published_at" id="published_at" placeholder="published_at" class="mb-5 form-control">

<label for="category_id" class="form-label fw-bold">category</label>
<select type="text" value="" name="category_id" id="category_id"  class="mb-5 form-control">
      @foreach ($categories as $category)
      <option value="{{ $category->id }}"  @isset($post)   {{ $post->category_id }}   @if ($category->id == $post->category->id )  selected @endif  @endisset  > 
            {{ $category->name }}
      </option>
      @endforeach
</select>

@isset($post) <div class="d-flex justify-content-center">  <img  class="mb-5 img-thumbnail"src="{{asset('storage/'.$post->image) }}" alt="" width="90%"> </div>  @endisset
<label for="image" class="form-label fw-bold">Image</label>
<input type="file" value="" name="image" placeholder="image"   class="mb-3 form-control">

@if ($tags->count() > 0)
<label for="tag_id" class="form-label fw-bold">Tags</label>
<select  name="tags[]" id="tag_id"  class="form-control tagSelector" multiple>
      @foreach ($tags as $tag)
      <option value="{{ $tag->id }}"
             @isset($post)
          @if ($post->hasTag($tag->id))
              selected
          @endif
      @endisset > 
            {{ $tag->name }}
      </option>
      @endforeach
</select>
@endif

        <div class="d-grid mt-5">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
 
       </form>

    </div>
</div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

<script>
      $(document).ready(function() {
            
            $('.tagSelector').select2(); 
            flatpickr("#published_at", {  enableTime: true , } );
           
        });
       
</script>
@endsection




@section('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

