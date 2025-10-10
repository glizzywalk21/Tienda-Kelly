<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <title>Perfil Mercado</title>
    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease forwards;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .gradient-text {
            background: linear-gradient(90deg, #f97316, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-hover:hover {
            transform: translateY(-2px) scale(1.02);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Navbar Mercado --}}
    @include('components.navbar-mercado')

    <!-- Saludo -->
    <div class="mt-16 text-center animate-fadeInUp">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold gradient-text">
            ¡Hola, {{ $mercadoLocal->nombre }}! 👋
        </h1>
        <p class="text-gray-600 text-base md:text-lg mt-2 delay-200">
            Bienvenido a tu perfil de <span class="font-bold">Mercado</span>
        </p>
    </div>

    <!-- Foto del mercado -->
    <div class="flex justify-center mt-10 animate-fadeInUp delay-400">
        <img class="w-40 h-40 md:w-44 md:h-44 rounded-full border-4 border-red-500 shadow-2xl"
            src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="Foto Mercado">
    </div>

    <!-- Estrellas -->
    <div class="flex justify-center mt-3">
        @for($i = 0; $i < 5; $i++)
            <img class="w-4 h-4 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="Estrella">
        @endfor
        <span class="ml-2 text-sm font-semibold">5.0</span>
    </div>

    <!-- Información del mercado -->
    <div class="mt-6 text-center space-y-2">
        <div><span class="font-semibold text-lg">Nombre: </span> {{ $mercadoLocal->nombre }}</div>
        <div><span class="font-semibold text-lg">Municipio: </span> {{ $mercadoLocal->municipio }}</div>
        <div><span class="font-semibold text-lg">Correo: </span> {{ $mercadoLocal->usuario }}</div>
    </div>

    <!-- Enlaces del mercado -->
    <div class="w-11/12 md:w-1/2 mx-auto my-16 space-y-6">
        <a href="{{ route('mercados.agregarvendedor')}}"
            class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/mercado.agregar.png') }}" alt="Agregar Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Agregar Vendedores</h3>
        </a>

        <a href="{{ route('mercados.listavendedores')}}"
            class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/mercado.vendedores.png') }}" alt="Vendedores Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Listado de Vendedores</h3>
        </a>

        <a href="{{ route('mercados.reservas')}}"
            class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/mercado.reservas.png') }}" alt="Reservas Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Reservas de Vendedores</h3>
        </a>

        <a href="{{ route('mercados.historial')}}"
            class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/mercado.historial.png') }}" alt="Historial Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Historial de Compras</h3>
        </a>

        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-3 bg-red-500 text-white font-bold rounded-lg shadow hover:bg-red-600 transition btn-hover">
                <img class="w-5 mr-3" src="{{ asset('imgs/tuerca.png') }}" alt="Cerrar Icon">
                Cerrar Cuenta
            </button>
        </form>
    </div>

    {{-- Footer --}}
    @include('components.footer')

</body>

</html>