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

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

    <div>
        <!--Inicio del Navbar desktop-->
        <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
            <a href="{{ route('admin.index') }}">
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                    TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
                </h1>
            </a>
            <div class="flex gap-8">
                <a href="{{ route('admin.index') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Areas</a>
                <a href="{{ route('admin.vendedores') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
                <a href="{{ route('admin.clientes') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
                <a href="{{ route('AdminProfileVista')}}"
                    class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                    Perfil
                </a>
            </div>
        </nav>

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
            </div>
        </div>
        <!--FIN DE NAVBAR MOBIL-->

        <div class="bg-indigo-500 h-auto pb-[4rem] pt-[2rem] w-full flex items-center justify-center">
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


        <!--Enlaces/Opciones del admin-->
        <div class="w-11/12 md:w-1/2 mx-auto my-16 space-y-6">
            <a href="{{ route('admin.crearmercados')}}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
                <img class="w-6" src="{{ asset('imgs/admin.agregar.mercados.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-3">Agregar Nueva area</h3>
            </a>

            <a href="{{ route('admin.crearvendedores') }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
                <img class="w-5" src="{{ asset('imgs/admin.agregar.vendedor.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Agregar Nuevo Vendedor</h3>
            </a>

            <a href="{{ route('admin.vendedores')}}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
                <img class="w-5" src="{{ asset('imgs/admin.vendedores.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Vendedores</h3>
            </a>
            <a href="{{ route('admin.clientes')}}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
                <img class="w-5" src="{{ asset('imgs/admin.usuarios.png') }}" alt="User Icon">
                <h3 class="flex-grow text-left font-bold ml-5">Clientes</h3>
            </a>

            <form action="{{ route('logout') }}" method="GET">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-3 bg-red-500 text-white font-bold rounded-lg shadow hover:bg-red-600 transition btn-hover">
                    <img class="w-5 mr-3" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                    Cerrar Cuenta
                </button>
            </form>
        </div>

    </div>

    <!--Incluyendo el Footer desde los componetes-->
    @include('components.footer')
</body>

</html>