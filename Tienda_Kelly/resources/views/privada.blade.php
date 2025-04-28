<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página Privada</title>
</head>
<body>
    <h1>Bienvenido a la Página Privada</h1>
    <p>Esta es una página protegida. Solo los usuarios autenticados pueden verla.</p>
    {{-- @auth
    {{Auth::user()->email}}
    @endauth
    <a href="{{ route('logout') }}">Cerrar sesión</a> --}}
</body>
</html>
