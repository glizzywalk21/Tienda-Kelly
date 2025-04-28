<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <nav>
        <a href="{{ route('products.index') }}">Productos</a>
        <a href="{{ route('usuarios.carrito') }}">Carrito</a>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
