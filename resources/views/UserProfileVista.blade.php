<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Perfil Usuario</title>
    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp { animation: fadeInUp 1s ease forwards; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-400 { animation-delay: 0.4s; }
        .gradient-text { background: linear-gradient(90deg, #6366f1, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-hover:hover { transform: translateY(-2px) scale(1.02); transition: all 0.3s ease; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Incluir Navbar -->
    @include('components.navbar')

    <!-- Saludo -->
    <div class="mt-16 text-center animate-fadeInUp">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold gradient-text">
            ¡Hola, {{ Auth::user()->nombre }}! 👋
        </h1>
        <p class="text-gray-600 text-base md:text-lg mt-2 delay-200">
            Bienvenido de nuevo a <span class="font-bold">Tienda Kelly</span>
        </p>
    </div>

    <!-- Foto del usuario más abajo -->
    <div class="flex justify-center mt-10 animate-fadeInUp delay-400">
        <img class="w-32 h-32 md:w-36 md:h-36 rounded-full border-4 border-indigo-500 shadow-2xl" 
             src="{{ asset('storage/imgs/' . (Auth::user()->imagen_perfil ?? 'non-img.png')) }}" alt="Foto Usuario">
    </div>

    <div class="flex justify-center mt-3">
        @for($i=0; $i<5; $i++)
            <img class="w-4 h-4 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="Estrella">
        @endfor
        <span class="ml-2 text-sm font-semibold">5.0</span>
    </div>

    <!-- Información del usuario -->
    <div class="mt-6 text-center space-y-2">
        @auth
        <div><span class="font-semibold text-lg">Usuario: </span> {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</div>
        <div><span class="font-semibold text-lg">Correo Electrónico: </span><br> {{ Auth::user()->usuario }}</div>
        @endauth
    </div>

    <!-- Enlaces del usuario -->
    <div class="w-11/12 md:w-1/2 mx-auto my-16 space-y-6">
        <a href="{{ route('usuarios.editar', Auth::user()->id ) }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-7" src="{{ asset('imgs/EditSelectedIcon.png') }}" alt="Editar Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Editar mi Perfil</h3>
        </a>
        <a href="{{ route('usuarios.index') }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-7" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Hogar Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Hogar</h3>
        </a>
        <a href="{{ route('usuarios.historial') }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/heart.png') }}" alt="Historial Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Historial de Pedidos</h3>
        </a>
        <a href="{{ route('usuarios.reservas') }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-7" src="{{ asset('imgs/ReservasSelectedIcon.png') }}" alt="Estado Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Estado de Pedidos</h3>
        </a>
        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-3 bg-red-500 text-white font-bold rounded-lg shadow hover:bg-red-600 transition btn-hover">
                <img class="w-5 mr-3" src="{{ asset('imgs/tuerca.png') }}" alt="Cerrar Cuenta Icon">
                Cerrar Cuenta
            </button>
        </form>
    </div>

    <!-- Incluir Footer -->
    @include('components.footer')

</body>

</html>
