<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <title>VendedorProfileVista</title>
</head>

<body>
    <div>
        <!-- Desktop Navbar -->
        <div class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
            <a href="{{ route('vendedores.index') }}">
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                    Tienda Kelly <span class="text-indigo-400 font-bold">Vendedores</span>
                </h1>
            </a>
            <div class="flex gap-8">
                <a href="{{ route('vendedores.index') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Puesto</a>
                <a href="{{ route('vendedores.productos') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mis Productos</a>
                <a href="{{ route('vendedores.reservas') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Reservas</a>
                <a href="{{ route('vendedores.historial') }}"
                    class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mis Historial</a>
                <a href="{{ route('vendedor.perfil') }}"
                    class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                    Perfil
                </a>
            </div>
        </div>
        <!-- Mobile Navbar -->
        <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center">
                    <a href="{{ route('vendedores.index') }}">
                        <img class="w-6" src="{{ asset('imgs/vendedor.home.png') }}" alt="Home Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('vendedores.productos') }}">
                        <img class="w-6" src="{{ asset('imgs/vendedor.productos.png') }}" alt="Cart Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('vendedores.reservas') }}">
                        <img class="w-6" src="{{ asset('imgs/vendedor.reservas.png') }}" alt="Favorites Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('vendedores.historial') }}">
                        <img class="w-6" src="{{ asset('imgs/mercado.historial.blancopng.png') }}"
                            alt="Favorites Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('vendedor.perfil') }}">
                        <img class="w-6" src="{{ asset('imgs/vendedor.perfil.png') }}" alt="Profile Icon" />
                    </a>
                </div>
            </div>
        </div>
        <!-- fin del Mobile Navbar -->


        <div class="bg-indigo-500 h-auto pb-[4rem] pt-[2rem] w-full flex items-center justify-center"">
            <h3 class=" text-[3rem] font-bold lg:text-[5rem]">Tienda<span class="text-white ml-2">Kelly</span></h3>
        </div>
        <div class="flex justify-center mt-5">
            <img class="w-40 h-40 rounded-full shadow-md  "
                src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="User Icon">
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
            <h3 class="text-xs">{{ $vendedor->nombre_del_local }}</h3>
            <h3 class="font-bold">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
            <h3 class="text-xs">{{ $vendedor->usuario }}</h3>
        </div>


    </div>
    <!--Enlaces para el vendedor-->
    <div class="w-11/12 md:w-1/2 mx-auto my-16 space-y-6">
        <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-6" src="{{ asset('imgs/AddSelectedIcon.png') }}" alt="User Icon">
            <h3 class="flex-grow text-left font-bold ml-3">Agregar Productos</h3>
        </a>

        <a href="{{ route('vendedores.editar', $vendedor->id) }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/EditSelectedIcon.png') }}" alt="User Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Editar mi puesto</h3>
        </a>

        <a href="{{ route('vendedores.reservas') }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/admin.vendedores.png') }}" alt="User Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Mi buzon</h3>
        </a>
        <a href="{{ route('vendedores.historial') }}" class="flex items-center px-4 py-3 bg-white rounded-lg shadow hover:shadow-lg transition btn-hover">
            <img class="w-5" src="{{ asset('imgs/mercado.historial.png') }}" alt="User Icon">
            <h3 class="flex-grow text-left font-bold ml-5">Historial</h3>
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

    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')

</body>

</html>