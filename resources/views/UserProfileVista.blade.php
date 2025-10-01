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

    <!-- Navbar Reutilizable -->
    <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
        <a href="{{ route('usuarios.index') }}" class="flex items-center gap-2">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                Tienda <span class="text-indigo-600">Kelly</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Hogar</a>
            <a href="{{ route('usuarios.carrito') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Carrito</a>
            <a href="{{ route('usuarios.reservas') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Reservas</a>
            <a href="{{ route('usuarios.historial') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Historial</a>
            <a href="{{ route('UserProfileVista') }}" class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </div>
    </nav>

    <!-- Mobile Navbar -->
    <div class="fixed bottom-3 left-0 right-0 md:hidden flex justify-center z-50">
        <div class="bg-gray-900 shadow-xl rounded-2xl w-72 h-14 flex justify-around items-center px-3">
            <a href="{{ route('usuarios.index') }}" class="bg-white rounded-full p-2 shadow-lg btn-hover">
                <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
            </a>
            <a href="{{ route('usuarios.carrito') }}" class="btn-hover">
                <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
            </a>
            <a href="{{ route('usuarios.reservas') }}" class="btn-hover">
                <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
            </a>
            <a href="{{ route('UserProfileVista') }}" class="btn-hover">
                <img class="w-8 h-8 rounded-full object-cover border-2 border-white shadow" 
                     src="{{ asset('storage/imgs/' . (Auth::user()->imagen_perfil ?? 'non-img.png')) }}" alt="Profile Icon" />
            </a>
        </div>
    </div>

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

    <!-- Footer -->
    <footer class="bg-[#292526] pb-16 pt-[6rem]">
        <div class="flex flex-col gap-6 md:grid grid-cols-3 text-white p-12">
            <div>
                <h2 class="font-bold mb-2">Contáctanos</h2>
                <p>Whatsapp: <a href="https://wa.me/50369565421" class="underline">+503 6956 5421</a></p>
                <p>Correo Electrónico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael Cedros, Cuscatlán</p>
            </div>
            <div>
                <h2 class="font-bold mb-2">Sobre nosotros</h2>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" src="{{ asset('imgs/youtube.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-[2px] bg-white"></div>
    </footer>

</body>

</html>
