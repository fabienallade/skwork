<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<script src="{{ asset('js/app.js') }}" defer></script>
{{--<script src="{{ asset('js/all.js') }}" defer></script>--}}

    <style media="screen">
      .alert{
        position: fixed;
    bottom: 0px;
    z-index: 9999;
    max-width: 400px;
    text-align: center;
    padding: 15px;
    padding-top: 15px;
    padding-right: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
    border: 1px solid #bce8f1;
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
    top: 95vh;
    margin-top: -60px;
    visibility: visible;
      }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
        <script>var base_url="";</script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body ng-app="app" ng-cloak="" class="body">
  @include('flash::message')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel shadow-xl bg-success">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
              @auth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Emploi du temps
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('publication') }}">
                            Publications
                        </a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link" href="{{ route('discussion',Auth::user()->id) }}">
                            Messages
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="">
                            Documents
                        </a>
                      </li>
                    </ul>

              @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
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
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
<!-- Scripts -->
{{-- <script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script> --}}
</html>
