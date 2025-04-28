<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>MercadoProfileVista</title>
</head>

<body>
    <!--DESKTOP NAVBAR-->

    <div class="hidden md:flex p-4 bg-red-500 items-center justify-between shadow-md">
        <a href="{{ route('mercados.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text- font-bold">
                Tienda Kelly: <span class="text-white font-bold">Mercado</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('mercados.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Hogar</a>
            <a href="{{ route('mercados.listavendedores') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Vendedores</a>
            <a href="{{ route('mercados.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Reservas</a>
            <a href="{{ route('mercados.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-200 text-white px-2 py-1">Historial</a>
            <a href="{{ route('mercados.perfil') }}"
                class="font-semibold uppercase text-sm lg:text-base  text-white hover:text-black hover:bg-white border border-white px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('mercados.index') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.home.nav.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.listavendedores') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.vendedores.nav.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.reservas') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.reservas.nav.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.historial') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.historial.nav.png') }}"
                        alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.perfil') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.perfil.nav.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>
    <!--END NAVBAR-->
    <div class="mb-[5rem]">
        <div class="bg-red-500 h-36 w-full flex items-center justify-center">
            <h3 class="text-3xl font-bold md:hidden">Tienda<span class="text-white ml-2">Kelly</span></h3>
        </div>


        <div class="flex justify-center my-5">
            <img class="w-40 h-40 bg-white rounded-full shadow-md  " src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}" alt="User Icon">
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
            <h3 class="text-xs md:text-[1rem]">{{ $mercadoLocal->municipio }}</h3>
            <h3 class="font-bold md:text-[1.5rem]">{{ $mercadoLocal->nombre }}</h3>
            <h3 class="text-xs md:text-[1rem]">{{ $mercadoLocal->usuario }}</h3>
        </div>

        <div class="w-[50%] mx-auto mt-16">
            <a href="{{ route('mercados.agregarvendedor')}}" class=" mx-auto flex items-center">
                <img class="w-5" src="{{ asset('imgs/mercado.agregar.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-3">Agregar Vendedores</h3> <!-- Alineado a la derecha -->
            </a>

            <a href="{{ route('mercados.listavendedores')}}" class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/mercado.vendedores.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Listado de Vendedores</h3> <!-- Alineado a la derecha -->
            
            <a href="{{ route('mercados.reservas')}}" class=" mx-auto flex items-center mt-10">
            <img class="w-5" src="{{ asset('imgs/mercado.reservas.png') }}" alt="User Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Reservas de Vendedores</h3> <!-- Alineado a la derecha -->
            </a>


            <a href="{{ route('mercados.historial')}}" class=" mx-auto flex items-center mt-10">
            <img class="w-5" src="{{ asset('imgs/mercado.historial.png') }}" alt="User Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Historial de Compras</h3> <!-- Alineado a la derecha -->
            </a>
    


        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <div class="mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                <button type="submit" class="flex-grow text-left font-bold ml-5">Cerrar Cuenta</button>
                <!-- Alineado a la derecha -->
            </div>
        </form>

    </div>
    </div>



    </div>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white p-12">
            <div class="hidden md:block">
                <h2 class="font-bold">Contact Us</h2>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>
            </div>
            <div class="hidden md:block">
                <h2 class="font-bold">Sobre nosotros</h2>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-red-600">Kelly</span></p>
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
    </footer>

</body>

</html>