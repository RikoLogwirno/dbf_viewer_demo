<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <title>DBF Web Viewer - @yield('title')</title>
</head>
<body>
    <div class="container-fluid main-menu">
        <div class="col-12 row">

            <a class="menu-item" href="{{ route('logout') }}">
                <div>
                    LOGOUT
                </div>
            </a>

        </div>
    </div>
    <div class="container-fluid">

        {{-- Judul dan deskripsi halaman --}}
        <div class="row">
            <div class="col-12">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">

                        <h1 class="display-3">@yield('title')</h1>
                        <hr class="my-2">
                        <p class="lead">@yield('page_desc')</p>
                        {{-- <p>More info</p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
                        </p> --}}

                    </div>
                </div>
            </div>
        </div>

        {{-- Content disini --}}
        @section('main_content')

        @show

    </div>
</body>
</html>
