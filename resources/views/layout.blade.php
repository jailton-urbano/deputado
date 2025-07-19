<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gastos dos Deputados</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <header>
        <h1>Gastos dos Deputados</h1>
        <nav>
            <a href="{{ route('deputados.index') }}">Deputados</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
