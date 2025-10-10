<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Tienda Kelly</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-200 via-blue-100 to-white">
    <div class="md:flex min-h-screen">
        <!-- Texto -->
        <div class="flex justify-center items-center md:w-1/2 p-10">
            <div class="max-w-lg">
                <!-- Logo / Título -->
                <h1 class="font-extrabold text-6xl text-center tracking-tight">
                    <span class="text-indigo-600">Tienda</span>
                    <span class="text-blue-500">Kelly</span>
                </h1>

                <!-- Descripción -->
                <p class="hidden md:block text-gray-700 mt-6 text-lg leading-relaxed text-center">
                    En <span class="font-semibold text-indigo-600">Tienda Kelly</span> encuentras
                    <span class="font-semibold">múltiples áreas</span>: abarrotes, frutas y verduras,
                    carnes y embutidos, lácteos, bebidas, limpieza, cuidado personal, hogar y más.
                    Explora catálogos, reserva productos y recógelos cuando te convenga.
                </p>

                <p class="mt-4 text-center text-gray-700 text-sm md:text-base">
                    Los mejores productos para cada área, en un solo <span
                        class="font-semibold text-indigo-600">lugar</span>.
                </p>

                <!-- Botones -->
                <div class="mt-10 flex justify-center gap-4">
                    <a href="{{ route('login') }}">
                        <button
                            class="bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600 text-white font-semibold w-40 h-12 rounded-xl shadow-lg transition transform hover:scale-105">
                            Iniciar Sesión
                        </button>
                    </a>
                    <a href="{{ route('usuarios.create') }}"
                        class="relative flex items-center justify-center border-2 border-indigo-400 text-indigo-600 font-semibold w-40 h-12 rounded-xl shadow-md hover:bg-indigo-50 transition transform hover:scale-105">
                        <img class="absolute left-4 w-6" src="{{ asset('imgs/play.png') }}" alt="User Icon">
                        <span class="pl-6">Registrarse</span>
                    </a>
                </div>

                <!-- Redes sociales -->
                <div class="flex justify-center gap-5 mt-10">
                    <a href="https://www.facebook.com/DirectivaCentralMercadosSanSalvador/?locale=es_LA"
                        class="bg-indigo-600 hover:bg-indigo-700 p-2 rounded-full shadow-md transition">
                        <img class="w-6" src="{{ asset('imgs/facebook.png') }}" alt="Facebook">
                    </a>
                    <a href="https://x.com/SsMercados"
                        class="bg-blue-500 hover:bg-blue-600 p-2 rounded-full shadow-md transition">
                        <img class="w-6" src="{{ asset('imgs/twitter.png') }}" alt="Twitter">
                    </a>
                    <a href="https://www.instagram.com/explore/locations/198993770818162/mercado-central-de-san-salvador"
                        class="bg-pink-500 hover:bg-pink-600 p-2 rounded-full shadow-md transition">
                        <img class="w-6" src="{{ asset('imgs/instagram.png') }}" alt="Instagram">
                    </a>
                    <a href="https://www.linkedin.com/company/sansalvador"
                        class="bg-blue-700 hover:bg-blue-800 p-2 rounded-full shadow-md transition">
                        <img class="w-6" src="{{ asset('imgs/linkedin.png') }}" alt="LinkedIn">
                    </a>
                </div>
            </div>
        </div>

        <!-- Imagen -->
        <div
            class="hidden md:flex justify-center items-center md:w-1/2 bg-gradient-to-tr from-indigo-100 via-blue-50 to-white">
            <img class="w-[80%] drop-shadow-2xl animate-fade-in" src="{{ asset('imgs/imagenindex.png') }}"
                alt="Imagen principal">
        </div>
    </div>
</body>

</html>