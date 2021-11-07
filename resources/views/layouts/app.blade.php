<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Family CookBook</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Catamaran&family=Dancing+Script:wght@700&family=Rampart+One&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar fixed-top navbar-dark bg-dark">
            <div class="container-xl">
                <a class="navbar-brand" href="/">My Family CookBook</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <form class="d-flex gap-2 d-md-flex mt-2 justify-content-md-end">
                        <a href="{{ route('about') }}" class="btn btn-outline-success justify-content-end ">About</a>
                        @auth
                        <a href="/recipes" class="btn btn-outline-success">Recipes</a>
                        <a href="/familys/{{ auth()->user()->family_id }}" class="btn btn-outline-success">Members</a>

                        <a href="{{ route('logout') }}" class="btn btn-outline-success  " onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @else
                        <a href="{{ route('register') }}" class="btn btn-outline-success justify-content-end ">Sign Up</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-success justify-content-end ">Login</a>
                        @endauth
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- messages -->
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <!-- end messages -->

    <main>
        @yield('content')
    </main>

</body>
</html>