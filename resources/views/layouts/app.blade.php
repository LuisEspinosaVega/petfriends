<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;500;700&display=swap" rel="stylesheet">

    <style>
        .bg-navbar-custom,
        .dropdown-item {
            background-color: #725c36;
            color: #C2B9AA !important;
        }

        .dropdown-item:hover {
            background-color: #f2e7d3 !important;
            color: black !important;
        }

        body {
            background-color: #fcf2e5;
        }

        * {
            font-family: 'Noto Sans JP', sans-serif;
        }

    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-navbar-custom sticky-top">
            @auth
                <a class="navbar-brand" href="/home">PetFriends 😺</a>
            @else
                <a class="navbar-brand" href="/">PetFriends 😺</a>
            @endauth
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item text-center">
                            <a class="nav-link" href="/sales">Ventas 💲</a>
                        </li>
                        <li class="nav-item text-center dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adoptionDropdown" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Adopción 💙
                            </a>
                            <div class="dropdown-menu py-0" aria-labelledby="adoptionDropdown">
                                <a class="dropdown-item text-center" href="/adoption">Lista de mascotas</a>
                                <a class="dropdown-item text-center" href="/adoption/requests">Solicitudes</a>
                                <a class="dropdown-item text-center" href="/adoption/process">Mis procesos</a>
                            </div>
                        </li>
                    </ul>
                @endauth
                <ul class="navbar-nav ml-auto">
                    @auth

                        <li class="nav-item text-center">
                            <a href="/community" class="nav-link">Seguidos/Seguidores</a>
                        </li>
                        <li class="nav-item text-center">
                            <a href="/community/messages" class="nav-link">Mensajes <span
                                    class="badge bg-danger">{{ Auth::user()->profile->recivedMessages()->where('seen', 0)->distinct('user_id')->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item text-center dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <b>{{ Auth::user()->username }}</b>
                            </a>
                            <div class="dropdown-menu py-0" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item text-center" href="/profile/{{ Auth::user()->username }}">Mi
                                    perfil</a>
                                <a class="dropdown-item text-center" href="/account">Configuracion</a>
                                <a class="dropdown-item text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item text-center align-self-center" style="widht:200px;">
                            <input class="form-control form-control-sm" id="searchUser" name="searchUser" type="search"
                                placeholder="Buscar usuario" aria-label="Search">
                            <div id="usersList" class="bg-light"
                                style="widht:auto; max-height: 250px; overflow-x:hidden; overflow-y:auto; position:absolute;"></div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Registrarse</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
    {{-- script para el buscador de usuarios --}}
    <script src="{{ asset('js/search.js') }}" defer></script>
    <!-- custom javascript if require -->
    @stack('custom-scripts')
</body>

</html>
