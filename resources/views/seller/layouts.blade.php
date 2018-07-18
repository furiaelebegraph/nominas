<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MultiAuth') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/bootstrap-datetimepicker.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <script src=" {{ asset('js/jquery.js') }} " ></script>
    <script src=" {{ asset('js/moment.js') }} " ></script>
    <script src=" {{ asset('js/bootstrap.min.js') }} " ></script>
    <script src=" {{ asset('js/bootstrap-datetimepicker.min.js') }} " ></script>
    <script src=" {{ asset('js/general.js') }} " ></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg header" >
            <div class="container">
                <div class="navbar-brand">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class='logo_comer' src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @if (Auth::guard('web_seller')->guest())

                            <!--Seller Login and registration Links -->

                            <li class='nav-item'><a class="nav-link" href="{{ url('/seller_login') }}">Iniciar Sesión</a></li>
                            <li class='nav-item'><a class="nav-link" href="{{ url('/seller_register') }}">Registrarme</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::guard('web_seller')->user()->nombre }} <span class="caret"></span>
                                </a>

                               <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('seller_logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{route('seller_logout')}}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <div id="footer" class="row alineado_centro">
        <div class="col-12">
            <h2>CONMERSA</h2>
            <h1>Empaque, embalaje y servicios de empaquetado.</h1>
            <h3>Todos los derechos Reservados, 2017-2018.</h3>
        </div>
    </div>
    <!-- Scripts -->
</body>
</html>
