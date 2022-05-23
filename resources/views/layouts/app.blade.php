<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('page-title')  </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"  ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('backends') }}/favico.png" /> 
    
</head>
<body style="background: url({{ asset('backend') }}/img/frontbg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
              
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('backend') }}/img/simply-logo.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php 
                        if(Auth::guard('web')->check() == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Client Home') }}</a>
                        </li>
                        <?php }
                        else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Client Login') }}</a>
                        </li>

                            <?php
                        }  
                        ?>

                        <?php
                        if(Auth::guard('admin')->check() == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link "   href="{{ route('admin.dashboard') }}">{{ __('Admin Home') }}</a>
                        </li>
                        <?php }
                        else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Admin Login') }}</a>
                        </li>

                            <?php
                        }
                        ?> 


                        <?php /*
                        if(Auth::guard('moderator')->check() == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link "   href="{{ route('moderator.dashboard') }}">{{ __('Moderator Home') }}</a>
                        </li>
                        <?php }
                        else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('moderator.login') }}">{{ __('Moderator Login') }}</a>
                        </li>

                            <?php
                        } */
                        ?>


                        <?php /*
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                
                            </li>
                        @endguest
                        */?>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
 