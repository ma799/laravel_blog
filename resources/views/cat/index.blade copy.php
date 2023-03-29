@extends('layouts.app')
@section('content')
@if (session('success'))
<div class="alert alert-success">
       {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        All Categories
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach ($categories as $category)
            <li class="list-group-item my-2 d-flex justify-content-between">
            <div>
                {{ $category->name }}
            </div>
            <div>
                <a class="btn text-white btn-sm btn-info me-2" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                    <!-- <button type="button" onclick="showModal({{ $category->id }})" class="btn text-white btn-sm btn-danger">Delete</button> -->
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
                              <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                              <button type="submit" class="btn btn-danger">Delete</button>
                              @csrf
                              @method('delete')
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                </form>
            </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
@section('script')
<script>
function showModal($id){
    $("#mod").modal('show')
    }
</script>
@endsection