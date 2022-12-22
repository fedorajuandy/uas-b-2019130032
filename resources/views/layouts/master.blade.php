<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Home') | XYZ Order</title>
        <link rel="shortcut icon" href="{{ asset('img/logo.svg?v=').time() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css?v=').time() }}">
        @stack('svg_after')
        @stack('css_after')
    </head>

    <body>
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary shadow-lg">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('img/logo.svg?v=').time() }}" width="auto" height="32" alt="logo">
                <span class="menu-collapsed">XYZ Order</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#FFFFFF" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link {{ Route::is('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
                    <a class="nav-link {{ Route::is('orders.create') ? 'active' : '' }}" href="{{ route('orders.create') }}">Create order</a>
                </div>
            </div>
        </nav>

        <main class="container-fluid min-vh-100 pl-0">
            <div class="row mt-5" id="body-row">
                <div id="sidebar-container" class="sidebar-expanded d-none d-md-block pt-2">
                    <ul class="list-group">
                        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                            <small>MAIN MENU</small>
                        </li>
                        <a href="{{ route('items.index') }}" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-film fa-fw mr-3"></span>
                                <span class="menu-collapsed">Items</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index') }}" class="bg-dark list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-film fa-fw mr-3"></span>
                                <span class="menu-collapsed">Orders</span>
                            </div>
                        </a>
                    </ul>
                </div>

                <div class="col p-4">
                    @yield('content')
                </div>
            </div>
        </main>

        <footer class="pb-2 pt-3 bg-dark">
            <div class="container text-center">
                <h6 class="text-muted">&copy; {{ date("Y") }} Fedora Yoshe Juandy</h6>
            </div>
        </footer>

        <script src="{{ asset('js/app.js') }}"></script>
        @stack('js_after')
    </body>
</html>
