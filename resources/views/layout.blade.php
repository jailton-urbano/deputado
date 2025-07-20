<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gastos dos Deputados')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('deputados.index') }}">Gastos Públicos</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deputados.index') }}">Deputados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sincronismo.index') }}">Acompanhamento</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    </body>
</html>
