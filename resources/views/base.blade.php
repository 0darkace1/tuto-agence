<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agence Immo - @yield('title')</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <style>
        @layer reset {
            button {
                all: unset;
            }
        }

        .htmx-indicator {
            display: none;
        }

        .htmx-request .htmx-indicator {
            display: inline-block;
        }

        .htmx-request.htmx-indicator {
            display: inline-block;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    @php
        $route = request()->route()->getName();
    @endphp

    <nav class="navbar bg-dark navbar-expand-lg border-bottom border-body mb-4" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand"
                @if (str_starts_with($route, 'admin')) href="{{ route('admin.index') }}" @else href="{{ route('index') }}" @endif>Agence
                Immo</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (str_starts_with($route, 'admin'))
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.properties.index') }}">
                                Gestion des biens
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.options.index') }}">
                                Gestion des options
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.users.index') }}">
                                Gestion des utilisateurs
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('properties.index') }}">
                                Nos Biens
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="d-flex gap-2">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light" type="submit">S'inscrire</a>
                        <a href="{{ route('login') }}" class="btn btn-light" type="submit">Se connecter</a>
                    @endguest
                    @auth
                        <div class="d-flex gap-2 text-white align-items-center">
                            {{ Auth::user()->name }}

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-tertiary">Se déconnecter</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @if (session('error'))
            <x-alert type='danger'>
                {{ session('error') }}
            </x-alert>
        @endif

        @if (session('success'))
            <x-alert type='success'>{{ session('success') }}</x-alert>
        @endif

        @if ($errors->any())
            <x-alert type='danger'>
                <ul class="my-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        @yield('content')
    </div>

    <div class="footer mt-auto text-center">
        <span id="bottom">
            <hr>
            <p>
                &copy; {{ date('Y') }} - Mon Agence Immo Laravel - Tous droits réservés
            </p>
        </span>
    </div>

    <script src="https://unpkg.com/htmx.org@2.0.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect("select[multiple]", {
            plugins: {
                remove_button: {
                    title: "Supprimer"
                }
            }
        })
    </script>
</body>

</html>
