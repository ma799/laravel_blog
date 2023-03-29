<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('css')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{--  Categories  --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('categories.create') }}">Add Category</a></li>
                              <li><a class="dropdown-item" href="{{ route('categories.index') }}">All Categories</a></li>
                            </ul>
                          </li>

                        {{--  Posts  --}}
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Posts
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('posts.create') }}">Add Post</a></li>
                            <li><a class="dropdown-item" href="{{ route('posts.index') }}">All Posts</a></li>
                        </ul>
                        </li>
                         
                        {{--  Tags  --}}
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tags
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('tags.create') }}">Add Tag</a></li>
                            <li><a class="dropdown-item" href="{{ route('tags.index') }}">All Tags</a></li>
                        </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('users.editProfile') }}">
                                        Edit Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 pt-5">
           <div class="col-6">
            
           </div>
            @auth
                <div class="row justify-content-between px-3">
                    <div class="col-2 ">
                        <ul class="list-group fw-semibold mb-5 ">
                           @if (auth()->user()->role == 'admin')
                           <a class=" text-decoration-none" href="{{ route('users.index')}}">
                            <li class="border-bottom text-center list-group-item bg-light">
                               <p class="text-primary  m-0  " style="letter-spacing:  .5rem;">Users</p> 
                           </li>
                         </a> 
                           @endif
                            <a class="  text-decoration-none" href="{{ route('categories.index')}}">
                                 <li class="border-bottom text-center list-group-item ">
                                    <p class="text-primary m-0 " style="letter-spacing:  .5rem;">Categories</p> 
                                </li>
                            </a> 
                            <a class="  text-decoration-none" href="{{ route('posts.index')}}">
                                <li class="border-bottom text-center list-group-item bg-light">
                                   <p class="text-primary  m-0  " style="letter-spacing:  .5rem;">Posts</p> 
                               </li>
                           </a> 
                           <a class="  text-decoration-none" href="{{ route('tags.index')}}">
                            <li class="border-bottom text-center list-group-item  ">
                               <p class="text-primary  m-0  " style="letter-spacing:  .5rem;">Tags</p> 
                           </li>
                           </a>
                        </ul>
                        <ul class="list-group fw-semibold">
                            <a class="  text-decoration-none" href="{{ route('posts.trash')}}">
                                 <li class="border-bottom text-center list-group-item  bg-danger">
                                    <p class="text-white m-0 " style="letter-spacing:  .4rem;">Trashed posts</p> 
                                </li>
                            </a> 
                        </ul>
                    </div>
                    <div class="col-8 me-5">
                        @if (session('CountCategoryError'))
                        <div class="alert alert-danger d-flex justify-content-between">
                            <div>{{ session('CountCategoryError') }}</div>
                            <a class="text-white text-decoration-none fs-5"  href="{{ route('categories.create') }}">
                                Create Category
                            </a>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger d-flex justify-content-between">
                            <div>{{ session('error') }}</div>
                        </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-6">
                        @yield('content')
                    </div>
                </div>
            @endauth
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
        @yield('script')
</body>
</html>
