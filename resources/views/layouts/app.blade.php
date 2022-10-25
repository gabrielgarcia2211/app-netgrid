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
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #5457ff;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color: white"> 
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color: white">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color: white">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                <!-- Button trigger modal -->
                @if (auth()->user())
                    <button type="button" class="{{ ($errors->any() > 0) ? 'btn btn-danger' : 'btn btn-primary' }}" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
                @endif


            </div>
        </nav>

        <main class="py-4">
            <div id="app">
                @yield('content')
                @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
                @yield('script')
            </div>

            <!-- Modal Eit User -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Informacion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form  action="{{ route('user.edit') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="name">Nombre</label>
                                    <div class="col-md-12">
                                        <input id="name" type="text"
                                            value="{{ isset($user->name) ? $user->name : '' }}"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            autocomplete="current-name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email">Correo</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                        value="{{ isset($user->email) ? $user->email : '' }}"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            autocomplete="current-email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address">Direccion</label>
                                    <div class="col-md-12">
                                        <input id="address" type="text"
                                        value="{{ isset($user->address) ? $user->address : '' }}"
                                            class="form-control @error('address') is-invalid @enderror"
                                            name="address" autocomplete="current-address">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="birthdate">Fecha de nacimiento</label>
                                    <div class="col-md-12">
                                        <input id="birthdate" type="date"
                                            value="{{ isset($user->birthdate) ? $user->birthdate : '' }}"
                                            class="form-control @error('birthdate') is-invalid @enderror"
                                            name="birthdate" autocomplete="current-birthdate">
                                        @error('birthdate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city">Ciudad</label>
                                    <div class="col-md-12">
                                        <input id="city" type="text"
                                            value="{{ isset($user->city) ? $user->city : '' }}"
                                            class="form-control @error('city') is-invalid @enderror" name="city"
                                            autocomplete="current-city">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </main>
    </div>
</body>

</html>
