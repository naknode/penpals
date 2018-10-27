<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel pl-5">
            <div class="container">
                <a class="navbar-brand text-2xl" href="{{ url('/') }}">
                    @svg('pencil', 'logo-color')
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron hero-bg rounded-none">
            <h1 class="w-1/2 display-4 text-white font-black">
                Next-generation internet penpal website for everyone.
            </h1>
            <p class="text-white my-2 text-xl w-1/2">
                Exchange cultures. Learn languages. Create friendships.
            </p>
            <p><a href="{{ route('register') }}" class="btn btn-warning btn-xs my-3" href="#" role="button">Get Started</a></p>
        </div>

        <div class="container">
            <div class="row features">
                <div class="col-md-4">
                    <h2>@svg('key', 'homepage-icon') Free and always.</h2>
                    <p class="my-3">We pride ourselves in never charging a dime for <em>all</em> of our wonderful features. No hidden fees, no cost. Just sign up and get to writing!</p>
                </div>
                <div class="col-md-4">
                    <h2>@svg('code', 'homepage-icon') Latest Technology.</h2>
                    <p class="my-3">We employ high-calibre cloud technology to keep your account safe from spam &amp; harmful content while also using it to improve user experience.</p>
                </div>
                <div class="col-md-4">
                    <h2>@svg('road', 'homepage-icon') Aväntˈ gärd</h2>
                    <p class="my-3">We're next-generation for a reason. We stand out by trying unique experiences in the UI to fix the problems that have plagued other sites for years.</p>
                </div>
            </div>

            <hr>

            <footer>
                <p class="mb-3">&copy; {{ config('app.name')}} 2018</p>
            </footer>
        </div>

    </body>
</html>
