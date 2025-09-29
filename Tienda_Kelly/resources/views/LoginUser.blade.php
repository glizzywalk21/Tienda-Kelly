<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Inicia Sesión con Nosotros</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-200 via-blue-100 to-white min-h-screen flex items-center justify-center">
    <div class="md:flex w-full h-screen shadow-lg bg-white rounded-xl overflow-hidden">
        
        <!-- Sección izquierda (Formulario) -->
        <div class="md:w-1/2 p-10 flex flex-col justify-center">
            <!-- Título móvil -->
            <div class="md:hidden text-center mb-6">
                <h1 class="font-extrabold text-2xl">Iniciar Sesión</h1>
                <p class="text-xs font-semibold text-gray-500">¡Bienvenidos a Tienda Kelly!</p>
            </div>

            <!-- Logo -->
            <div class="hidden md:block text-center mb-10">
                <h1 class="text-5xl font-extrabold tracking-tight">
                    Tienda <span class="text-indigo-600">Kelly</span>
                </h1>
                <p class="mt-2 text-gray-600">Accede a tu cuenta y disfruta de nuestros productos</p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5 max-w-sm mx-auto w-full">
                @csrf
                <!-- Email -->
                <div>
                    <input class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        type="email" name="usuario" id="usuario" placeholder="Ingrese su correo electrónico">
                    @if($errors->has('usuario'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('usuario') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div>
                    <input class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                    @if($errors->has('password'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <!-- Mostrar contraseña -->
                <div class="flex items-center">
                    <input type="checkbox" id="show-passwords" class="h-4 w-4 text-indigo-500 border-gray-300 rounded focus:ring-indigo-400">
                    <label for="show-passwords" class="ml-2 text-sm text-gray-600">Mostrar contraseña</label>
                </div>

                <!-- Botón login -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:scale-105">
                    Iniciar Sesión
                </button>
            </form>

            <!-- Línea divisoria -->
            <div class="flex items-center my-6 max-w-sm mx-auto w-full">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-3 text-xs text-gray-500">O</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Crear cuenta -->
            <p class="text-center text-sm text-gray-600">
                ¿Aún no tienes cuenta?
                <a href="{{ route('RegistroUser') }}" class="text-indigo-600 font-semibold hover:underline">Crear Cuenta</a>
            </p>
        </div>

        <!-- Sección derecha (Imagen y bienvenida) -->
        <div class="hidden md:flex md:w-1/2 flex-col items-center justify-center bg-gradient-to-tr from-indigo-100 via-blue-50 to-white relative">
            <h3 class="font-bold text-3xl mb-4 text-gray-700">Bienvenido de Regreso</h3>
            <img class="w-[70%] drop-shadow-2xl animate-fade-in" src="{{ asset('imgs/imagenindex.png') }}" alt="Login Image">
            <h3 class="mt-6 text-lg text-gray-600">Nos alegra verte otra vez en <span class="font-bold text-indigo-600">Tienda Kelly</span></h3>
        </div>
    </div>

    <script>
        document.getElementById('show-passwords').addEventListener('change', function () {
            const password = document.getElementById('password');
            password.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>

</html>
