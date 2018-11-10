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
        <nav class="relative flex flex-wrap items-center content-between py-2 px-4  navbar-light navbar-laravel pl-5">
            <div class="container mx-auto">
                <a class="inline-block pt-1 pb-1 mr-4 text-lg whitespace-nowrap text-2xl" href="{{ url('/') }}">
                    @svg('pencil', 'logo-color')
                    {{ config('app.name') }}
                </a>
                <button class="py-1 px-2 text-md leading-normal bg-transparent border border-transparent rounded" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse flex-grow items-center" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="flex flex-wrap list-reset pl-0 mb-0 mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="inline-block py-2 px-4 no-underline" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="inline-block py-2 px-4 no-underline" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class=" relative">
                                <a id="navbarDropdown" class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" href="#" role="button" data-toggle="relative" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class=" absolute pin-l z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-grey-light rounded" aria-labelledby="navbarDropdown">
                                    <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="{{ route('logout') }}"
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
        <div class="py-8 px-4 mb-8 bg-grey-lighter rounded hero-bg rounded-none">
            <h1 class="w-1/2 text-4xl text-white font-black">
                Next-generation internet penpal website for everyone.
            </h1>
            <p class="text-white my-2 text-xl w-1/2">
                Exchange cultures. Learn languages. Create friendships.
            </p>
            <p><a href="{{ route('register') }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-yellow-lightest bg-yellow hover:bg-yellow-light btn-xs my-3" href="#" role="button">Get Started</a></p>
        </div>

        <div class="container mx-auto">
            <div class="flex flex-wrap features">
                <div class="md:w-1/3 pr-4 pl-4">
                    <h2>@svg('key', 'homepage-icon') Free and always.</h2>
                    <p class="my-3">We pride ourselves in never charging a dime for <em>all</em> of our wonderful features. No hidden fees, no cost. Just sign up and get to writing!</p>
                </div>
                <div class="md:w-1/3 pr-4 pl-4">
                    <h2>@svg('code', 'homepage-icon') Latest Technology.</h2>
                    <p class="my-3">We employ high-calibre cloud technology to keep your account safe from spam &amp; harmful content while also using it to improve user experience.</p>
                </div>
                <div class="md:w-1/3 pr-4 pl-4">
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
