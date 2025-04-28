<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 001</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 relative text-white flex items-center justify-center h-screen  ">
    <div class="bg-gray-800 w-[50%] p-8 rounded-lg shadow-lg   text-center">
        <h1 class="text-4xl font-bold text-red-500 mb-4">Error 001</h1>
        <p class="text-gray-300 mb-6">No ha iniciado sesión. Por favor, inicie sesión para continuar.</p>
        <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Ir a la página de inicio de sesión</a>
    </div>
</body>
</html>


