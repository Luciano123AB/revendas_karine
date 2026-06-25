<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config("app.name") }}</title>

    <link rel="icon" href="{{ asset("favicon.ico") }}">
    
    @include("layouts.partials.links")

    @vite([
        "resources/css/app.css",
        "resources/js/app.js"
    ])
</head>
<body class="bg-danger fst-italic d-flex flex-column min-vh-100">
    @include("layouts.partials.alertas")
    
    @include("layouts.navbar")

    <div class="container my-auto">
        @if (
            $pagina != "Início" &&
            $pagina != "Lista" &&
            $pagina != "Minhas Compras" &&
            $pagina != "Administrador"
        )
            <div class="d-flex justify-content-center align-items-center">
                @yield("content")
            </div>
        @else
            @yield("content")
        @endif
    </div>

    @include("layouts.footer")

    <script src="{{ asset("assets/js/main_scripts.js") }}"></script>
</body>
</html>
