<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Tienda Kelly Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
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

    <div class="mt-10 px-6 flex flex-col md:flex-row justify-between items-center gap-6">

        <!-- Bienvenida animada -->
        <div class="space-y-2 animate-fadeInUp">
            <div class="ml-[2%] text-center md:text-left">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text text-slate-900">
                    Hola! Bienvenido
                </h1>
                <h3 class="text-indigo-600 font-semibold text-lg md:text-xl lg:text-2xl delay-200">
                    {{ $vendedor->nombre }} {{ $vendedor->apellidos }}
                </h3>
            </div>
        </div>
    </div>

    <!-- Perfil del vendedor -->
    <div class="flex flex-col xl:flex-row justify-center items-center w-full max-w-7xl mx-auto mt-10 px-5">

        <!-- Imagen del vendedor -->
        <div class="w-full md:w-auto flex justify-center md:justify-start">
            <img class="w-40 h-40 md:w-[52rem] md:h-[25rem] object-cover object-center rounded-full md:rounded-[25px] shadow-lg transition-transform duration-300 hover:scale-105"
                src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="Banner Image">
        </div>

        <!-- Información del puesto -->
        <div class="flex flex-col justify-center items-center lg:items-start md:ml-8 mt-6 lg:mt-0 text-center lg:text-left space-y-3">

            <div class="font-bold text-2xl lg:text-3xl text-gray-800">
                {{ $vendedor->nombre_del_local }}
            </div>
            <div class="text-base lg:text-lg text-gray-600">
                Propietario: <span class="font-medium text-gray-700">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</span>
            </div>
            <div class="text-base lg:text-lg text-gray-600">
                Puesto #{{ $vendedor->numero_puesto }} - <span class="font-medium text-gray-700">en {{ $mercadoLocal->nombre }}</span>
            </div>
            <div class="text-base lg:text-lg text-gray-600">
                Correo Electrónico: <span class="font-medium text-gray-700">{{ $vendedor->usuario }}</span>
            </div>

            <!-- Botón de editar -->

            <a href="{{ route('vendedores.editar', $vendedor->id) }}"
                class="px-6 py-3 text-sm lg:text-base font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500 transition-colors duration-300 shadow-md">
                EDITAR MI PUESTO
            </a>

        </div>
    </div>

    <!-- Botón de agregar productos -->
    <div class="flex mt-16 justify-center w-full px-4">
        <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}" class="bg-indigo-700 hover:bg-indigo-600 text-white font-bold uppercase rounded-md px-6 py-3 flex items-center gap-3 transition-transform duration-300 hover:scale-105 shadow-md">
            <img class="w-8 h-8" src="{{ asset('imgs/AddIcon.png') }}" alt="User Icon">
            Agregar Productos
        </a>
    </div>



    <!-- Fin Principal -->


    <!-- CARTAS -->
    <div class="flex flex-wrap justify-center mt-10 text-sm gap-4 md:gap-[50px]">
        @if ($products->isEmpty())
        <p class="md:text-[1.75rem] text-[1.5rem] py-[18rem] font-semibold text-gray-600">No hay Productos en Venta
        </p>
        @else
        @foreach ($products as $product)
        <a href="{{ route('vendedores.verproducto', $product->id) }}"
            class="w-full sm:w-[48%] md:w-[25%] mb-8 p-4 hover:shadow-lg hover:ease-in-out rounded-md">
            <img class="w-full h-[300px] rounded-md overflow-hidden object-cover"
                src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                alt="{{ $product->imagen_referencia }}">
            <div class="flex ">
                <h1 class="font-bold uppercase text-2xl mt-5 m-[1rem]">{{ $product->name }}</h1>
            </div>
            <h3 class="mb-2 text-xl">${{ $product->price }}</h3>
            <div class="flex justify-between">
                <h3>{{ $product->description }}</h3>
            </div>
        </a>
        @endforeach
        @endif
    </div>

    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')
</body>

</html>