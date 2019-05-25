<!DOCTYPE HTML>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Created by Moch Diki Widianto, Powered By Bootstrap and Laravel">
    <meta name="author" content="Moch Diki Widianto">
    <title>Reiichi Store</title></title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('dist/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media(min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('dist/css/custom/cover.css') }}" rel="stylesheet">
</head>

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Reiichi Store</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home" style="font-size:24px"></i></a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            @if (Route::has('login'))
            <p class="lead">
                <a href="{{ route('products.index') }}" class="btn btn-lg btn-secondary"><span class="fa fa-sign-in-alt"></span> To Store</a>
            </p>
            @else
            <p class="lead">
                <a href="{{ url('/login') }}" class="btn btn-lg btn-success"><span class="fa fa-sign-in-alt"></span> Masuk</a>
            </p>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif



    </div>
    @endif

    </main>

    <footer class="mastfoot mt-auto">
        
    </footer>
    </div>
</body>

</html>
