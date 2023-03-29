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
       @isset($category)   Edit Categories   @else   Add Categories   @endisset 
    </div>
    <div class="card-body">
       <form action="@isset($category) {{ route('categories.update',$category)}} @else {{ route('categories.store') }} @endisset" method="post">
        @csrf
        @isset($category)   @method('PUT')   @endisset 
        <label for="name" class="form-label fw-bold">Name</label>
        <input type="text" value="@isset($category){{ $category->name }}@endisset" name="name" placeholder="Name" class="mb-5 form-control">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">submit</button>
            
        </div>
       </form>
    </div>
</div>
@endsection