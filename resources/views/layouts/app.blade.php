<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap-5/css/bootstrap.min.css') }}">

    <style>
        a {
            text-decoration: none;
        }

        .required {
            color: red;
        }
    </style>

    <title>@yield('title')</title>
</head>
<body>
    <head>
        <nav class="container navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('login-page') }}">Employee</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link @yield('loginPage')" href="{{ route('login-page') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </head>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('backend/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-5/js/bootstrap.min.js') }}"></script>
</body>
</html>
