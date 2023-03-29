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
        Add Categories
    </div>
    <div class="card-body">
       <form action="{{ route('categories.update',$category->id)}}" method="post">
        @csrf
        @method('put')
        <input type="text" name="name" value="{{$category->name}}" placeholder="Name" class="my-5 form-control">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
       </form>
    </div>
</div>
@endsection