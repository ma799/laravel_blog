@extends('layouts.app')
@section('content')
@if (session('success'))
<div class="alert alert-success">
       {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        All users
    </div>
    <div class="card-body">
      @if ($users->count()>0)
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">actions</th>
          </tr>
        </thead>
        <tbody>
       
          @foreach ($users as $user)
        
        
          <tr>
            <th scope="row">
              {{ $user->id }}
            </th>
            <td>
                <img src="{{ Gravatar::get($user->email) }}" width="40" height="40" class="rounded-circle" alt="">
            </td>
            <td>
              {{ $user->name }}
            </th>
            <td>
                  {{ $user->email }}
            </td>

              <td>  
                @if (!$user->isAdmin())
                <div class="d-flex justify-content-center">
                    <form action="{{ route('users.makeAdmin',$user->id) }}" method="Post">
                        @csrf
                        <button type="submit" class="btn btn-success text-white me-2"> Make Admin </button>
                    </form>
                </div>
                @endif
              </td>
              </tr>
            @endforeach
          
          </tbody>

      </table>
       @else
             <h2 class="text-center">No Date Yet</h2>
            @endif
    </div>


</div>

@endsection
