@extends('layouts.app')
@section('content')
@if (session('success'))
<div class="alert alert-success">
       {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        All tags
    </div>
    <div class="card-body">

      @if ($tags->count()>0)

      

      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">tag</th>
            <th scope="col">actions</th>
          </tr>
        </thead>
        <tbody>
       
          @foreach ($tags as $tag)        
        
          <tr>
            <th scope="row">
              {{ $tag->id }}
            </th>
            <td>
              {{ $tag->name }}
            </th>
            <td>
              {{--  {{ $tag->posts->count() }}  --}}
                {{ $tag->posts->count() }}
            </td>
            <td>
              <form id="deleteForm{{ $tag->id }}" action="{{ route('tags.destroy',$tag->id) }}" method="post">
                {{--  <button type="submit" class="btn btn-danger">Delete</button>  --}}
                @csrf
                @method('delete')
              </form>
              <div>
                  <a class="btn text-white btn-sm btn-info me-2" href="{{ route('tags.edit',$tag->id) }}">Edit</a>
                      <button id="hello" type="button" onclick="showModal({{ $tag->id }})" class="btn text-white btn-sm btn-danger">Delete</button>
                </div>
            </td>

              </tr>
            @endforeach
          
          
     
          </tbody>

      </table>



     
    </div>

    
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
      @else
      <h2 class="text-center">No Date Yet</h2>
     @endif
    </div>


</div>

@endsection
@section('script')
<script>
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
@endsection