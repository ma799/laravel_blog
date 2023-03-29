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
       Edit Profile  
    </div>
    <div class="card-body">
       <form  action="{{ route('users.updateProfile')}}" method="post">
        @csrf
        @method('PUT')  

<label for="name" class="form-label fw-bold">Name</label>
<input type="text" value="{{auth()->user()->name}}" name="name" placeholder="name" class="mb-5 form-control">

<label for="description" class="form-label fw-bold">Description</label>
<input type="text" value="{{auth()->user()->description}}" name="description" placeholder="description" class="mb-5 form-control">

        <div class="d-grid mt-5">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
 
       </form>

    </div>
</div>
@endsection
