@extends('layouts.app')
@section('content')
@if (session('success'))
<div class="alert alert-success">
       {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        All posts
    </div>
    <div class="card-body">
      @if ($posts->count()>0)
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">image</th>
            <th scope="col">category</th>
            <th scope="col">actions</th>
          </tr>
        </thead>
        <tbody>
       
          @foreach ($posts as $post)
        
        
          <tr>
            <th scope="row">
              {{ $post->id }}
            </th>
            <td>
              {{ $post->title }}
            </th>
            <td>
              <img src="{{asset('storage/'.$post->image)}}" width="150" alt="">
            </td>
            <td>
              <a href="{{ route('categories.edit',$post->category->id) }}">
                  {{ $post->category->name }}
              </a>
            </td>

              <td>  
                <div class="d-flex justify-content-center">
              @if ($post->trashed())

              <form action="{{ route('posts.restore',$post->id) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-info text-white me-2"> restore </button>
            </form>

              @else
                  
              <a class="btn btn-info  text-white me-2"  href="{{ route('posts.edit',$post->id) }}">edit</a>
              @endif
                <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">@if ($post->trashed()) delete @else trash @endif</button>
              </form>
            </div>
              </td>
              </tr>
            @endforeach
          
          
     
          </tbody>

      </table>
       @else
             <h2 class="text-center">No Date Yet</h2>
            @endif
    </div>

{{--      
    <div class="modal" tabindex="-1" id="mod" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="deleteF()" class="btn btn-danger">Delete</button>
            
          </div>
        </div>
      </div>
    </div>  --}}


</div>

@endsection
{{--  @section('script')  --}}
{{--  <script>
  var $newId;
function showModal($id){
    $("#mod").modal('show')
     $newId = $id;
    }
function deleteF(){
  console.log($newId);
  $form = document.getElementById("deleteForm"+$newId);
  console.log($form.id);
  $form.submit();
}
</script>
@endsection  --}} 