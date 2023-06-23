<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
                        <li class="nav-item">
                            <form class="d-flex" method="GET" action="{{ route('search') }}">
                                <select name="category" class="form-select me-2" aria-label="Category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
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

                        <a href="{{ route('addArticle') }}" class="btn btn-success">
                            <i class="bi-plus"></i> Post Article
                        </a>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('edit') }}">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts') }}">All Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('recommended') }}">Recommended</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('populare') }}">Populare</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('my_posts') }}">
                                    My Posts
                                    <span class="badge bg-secondary">{{ auth()->user()->PostCount() }}</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('messages.index') }}">
                                    {{ __('Send Message')}}
                                </a>
                                <a class="dropdown-item" href="{{ route('messages.show') }}">My Messages @if(auth()->user()->unreadMessagesCount() > 0) <span class="badge bg-secondary">{{ auth()->user()->unreadMessagesCount() }}</span> @endif</a>

                                <a class="dropdown-item" href="{{ route('logout') }}">Logout
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

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>