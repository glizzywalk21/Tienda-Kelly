<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Mi Carrito</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body class="">
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
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Historial</a>
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

    <!-- Inicio de los apartados del main -->
    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-xl shadow-md">
            <div class="flex justify-between items-start flex-wrap gap-4 mt-5">
                <div class="ml-2">
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-800">
                        {{ $vendedor->nombre_del_local }} en
                        <span class="font-bold text-indigo-600">{{ $vendedor->mercadoLocal->nombre }}</span>
                    </h1>
                    <h3 class="text-indigo-500 font-medium text-base mt-1">
                        {{ $vendedor->nombre }} {{ $vendedor->apellidos }}
                    </h3>
                </div>
                <div class="md:hidden mr-4 mt-2 w-32 h-32 rounded-full overflow-hidden">
                    <img class="w-full h-full object-cover rounded-full"
                        src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="User Icon">
                </div>
            </div>

            <div class="text-center text-3xl md:text-5xl font-bold text-gray-700 my-8">
                Mis Productos
            </div>

            @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md mb-6 text-center font-medium">
                {{ session('success') }}
            </div>
            @endif

            <div class="space-y-6 flex flex-col items-center justify-center">
                @if ($productos->isEmpty())
                <span class="text-center text-2xl text-gray-500 my-28">
                    No hay Productos
                </span>
                @else
                @foreach ($productos as $producto)
                <div class="p-6 border border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100 transition w-full md:w-[75%] flex flex-col md:flex-row gap-6">
                    <!-- Imagen del Producto -->
                    <div class="flex-shrink-0 w-full md:w-1/4">
                        <img src="{{ asset('imgs/' . $producto->imagen_referencia) }}"
                            alt="Imagen del Producto"
                            class="w-full h-48 md:h-56 object-cover rounded-lg shadow-sm">
                    </div>

                    <!-- Información del Producto -->
                    <div class="flex-1">
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">
                            #{{ $producto->id }} {{ $producto->name }}
                        </h2>
                        <ul class="text-gray-700 space-y-1 text-sm md:text-base">
                            <li><span class="font-medium">Descripción:</span> {{ $producto->description }}</li>
                            <li><span class="font-medium">Precio:</span> ${{ $producto->price }}</li>
                            <li><span class="font-medium">Categoría:</span> {{ $producto->clasificacion }}</li>
                            <li><span class="font-medium">Estado:</span>
                                <span class="font-semibold text-green-600">{{ $producto->estado }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col justify-center items-center md:items-start gap-3 h-full mt-10">
                        <a href="{{ route('vendedores.verproducto', $producto->id) }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-md w-full text-center">
                            <i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}
                        </a>

                        <a href="{{ route('vendedores.editarproducto', $producto->id) }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 rounded-md w-full text-center">
                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                        </a>

                        <form action="{{ route('vendedores.eliminarproducto', $producto->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-md w-full text-center">
                                <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach
                @endif
            </div>
            <!-- FIN DE LA CARTA -->
        </div>
    </main>


    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')
</body>

</html>