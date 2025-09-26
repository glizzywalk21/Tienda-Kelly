<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>AdminProfileVista</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>

    <div>
        <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
            <a href="{{ route('admin.index') }}">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                    Tienda <span class="text-purple-600"><b>Admin</b></span>
                </h1>
            </a>
            <div class="flex gap-8">
                <a href="{{ route('admin.index') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mercados</a>
                <a href="{{ route('admin.vendedores') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Vendedores</a>
                <a href="{{ route('admin.clientes') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Clientes</a>
                <a href="{{ route('AdminProfileVista')}}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                    Perfil
                </a>
            </div>
        </div>

        <div class=""> <!-- Añadido un margen inferior -->
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-3 flex justify-center md:hidden">
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                    <div class="flex items-center  ">
                        <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">

                        <a href="{{ route('AdminProfileVista')}}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                    </div>
                </div>
                <!--FIN DE NAVBAR MOBIL-->
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>
        <div class="bg-violet-500 h-auto pb-[4rem] pt-[2rem] w-full flex items-center justify-center">
            <h3 class="text-[3rem] font-bold lg:text-[5rem]">Tienda<span class="text-white ml-2">Kelly</span></h3>
        </div>

        <div class="flex justify-center mt-5">
            <img class="w-40 h-40 rounded-full shadow-md  " src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon">
        </div>

        <div class="text-center mt-3">
            <h3 class="text-xs">Administrador de TiendaKelly</h3>
            <h3 class="font-bold">Administrador General</h3>
            <h3 class="text-xs">admin@minishop.sv</h3>
        </div>


        <div class="w-[50%] mx-auto mt-16">
            <a href="{{ route('admin.crearmercados')}}" class=" mx-auto flex items-center">
                <img class="w-6" src="{{ asset('imgs/admin.agregar.mercados.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-3">Agregar Nuevo Mercado</h3>
            </a>

            <a href="{{ route('admin.crearvendedores') }}" class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/admin.agregar.vendedor.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Agregar Nuevo Vendedor</h3>
            </a>

            <a href="{{ route('admin.vendedores')}}" class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/admin.vendedores.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Vendedores</h3>
            </a>
            <a href="{{ route('admin.clientes')}}" class=" mx-auto flex items-center mt-10">
                <img class="w-5" src="{{ asset('imgs/admin.usuarios.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Clientes</h3>
            </a>

            <form action="{{ route('logout') }}" method="GET">
                @csrf
                <div class="mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                    <button type="submit" class="flex-grow text-left font-bold ml-5">Cerrar Cuenta</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-[#292526] pb-16 mt-8">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b><b>
                        <h2>Contact Us</h2>
                    </b></b>

                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>

            </div>
            <div>
                <b>
                    <h2>Sobre nosotros</h2>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}"
                            alt="">
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