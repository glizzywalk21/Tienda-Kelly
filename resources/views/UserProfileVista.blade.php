<!-- !extends('layouts.app') -->
<!--
!section('template_title')
    {{ $cliente->name ?? __('Show') . ' ' . __('Cliente') }}
!endsection -->



<!-- !section('content') -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>ProfileUser</title>
</head>

<body>
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('usuarios.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                Tienda<span class="text-blue-600"><b>Kelly</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Hogar</a>
            <a href="{{ route('usuarios.carrito') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Carrito</a>
            <a href="{{ route('usuarios.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Reservas</a>
            <a href="{{ route('usuarios.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Historial</a>
            <a
                href="{{ route('UserProfileVista') }}" class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('usuarios.index') }}" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('usuarios.carrito') }}">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('usuarios.reservas') }}">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('UserProfileVista') }}">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>

    <div class="bg-indigo-300 h-[160px] flex items-center justify-center">
        <h3 class="font-bold text-center text-4xl">Tienda<span class="text-white ml-2">Kelly</span></h3>
    </div>
    <div class="flex justify-center mt-5">
        <img class="w-20 h-20 bg-white rounded-full shadow-md  " src="{{ asset('imgs/'.Auth::user()->imagen_perfil) }}" alt="User Icon">
    </div>
    <div class="flex justify-center mt-2 ">
        <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
        <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
        <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
        <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
        <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
        <h3 class="text-[10px]"> <span class="ml-2">5.0</span></h3>
    </div>
    <div class="text-center mt-3">
        <!-- <h3 class="text-xs"><b>{  $cliente->nombre }&nbsp;{ $cliente->apellido }}</b></h3> -->
        <!-- <h3 class="font-bold"><b>Numero Telefonico : </b>{ $cliente->telefono }}</h3> -->
        <!-- <h3 class="text-xs"><b>Correo Electronico : </b>{ $cliente->usuario }}</h3> -->

        <div class="text-center mt-3">
            @auth
            <div><span class="font-semibold text-lg">Usuario : </span> {{ Auth::user()->nombre }}
                {{ Auth::user()->apellido }}
            </div>
            <div> <span class="font-semibold text-lg">Correo Electronico :</span><br> {{ Auth::user()->usuario }} </div>
            @endauth
        </div>




    </div>

    <div class="w-1/2 mx-auto my-16"> <!-- Uso de 'my-16' en lugar de 'm-16' para un margen vertical más claro -->
        <a href="{{ route('usuarios.editar', Auth::user()->id ) }}" class="flex items-center mt-10">
            <img class="w-7" src="{{ asset('imgs/EditSelectedIcon.png') }}" alt="Estado Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Editar mi Perfil</h3>
        </a>
        <!-- Enlace a Hogar -->
        <a href="{{ route('usuarios.index') }}" class="flex items-center mt-10">
            <img class="w-7" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Hogar Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Hogar</h3>
        </a>

        <!-- Enlace a Historial de Pedidos -->
        <a href="{{ route('usuarios.historial') }}" class="flex items-center mt-10">
            <img class="w-5" src="{{ asset('imgs/heart.png') }}" alt="Historial Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Historial de Pedidos</h3>
        </a>

        <!-- Enlace a Estado de Pedidos -->
        <a href="{{ route('usuarios.reservas') }}" class="flex items-center mt-10">
            <img class="w-7" src="{{ asset('imgs/ReservasSelectedIcon.png') }}" alt="Estado Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Estado de Pedidos</h3>
        </a>

        <!-- Botón para Cerrar Cuenta -->
        <form action="{{ route('logout') }}" method="GET" class="mt-10">
            @csrf
            <div class="flex items-center">
                <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="Cerrar Cuenta Icon">
                <button type="submit" class="flex-grow text-left font-bold ml-5">Cerrar Cuenta</button>
            </div>
        </form>
    </div>


    </div>
    <footer class="bg-[#292526] pb-16 pt-[6rem] ">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b>
                    <h2>Contact Us</h2>
                </b>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>
            </div>
            <div>

                <b>
                    <b>
                        <h2>Sobre nosotros</h2>
                    </b>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
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
<!-- !endsection -->