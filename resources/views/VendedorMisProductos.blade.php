<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Mi Carrito</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
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
    <main class="p-4">

        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <div class="flex justify-between mt-5">
                <div class="ml-[2%]">
                    <h1 class="md:text-[1.5rem] text-[1rem]">{{ $vendedor->nombre_del_local }} en <span
                            class="font-semibold"> {{ $vendedor->mercadoLocal->nombre }}</span></h1>
                    <h3 class="text-indigo-400 font-bold text-[1rem] ">{{ $vendedor->nombre }}
                        {{ $vendedor->apellidos }}
                    </h3>
                </div>
                <div class="md:hidden mr-[5%] mt-4 rounded-full w-[8rem] h-[8rem] ">
                    <img class="rounded-full object-cover "
                        src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="User Icon">
                </div>
            </div>
            <div class="text-center md:font-semibold text-[2rem] md:text-[4rem]">
                Mis Productos
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="space-y-4 flex flex-col items-center justify-center">
                @if ($productos->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay
                    Productos</span>
                @else
                @foreach ($productos as $producto)
                <div
                    class="my-10 p-4 border-gray-200 rounded-lg flex flex-col mx-auto w-full md:w-[75%] h-auto md:h-[250px] md:flex-row md:items-start gap-4 md:gap-6 transition duration-300 hover:bg-gray-50">
                    <!-- Imagen del Producto -->
                    <div class="flex-shrink-0 w-full md:w-1/4">
                        <img src="{{ asset('imgs/' . $producto->imagen_referencia) }}"
                            alt="Imagen del Producto" class="w-full h-[12rem] rounded-md object-cover">
                    </div>

                    <!-- Información del Producto -->
                    <div class="flex-1">
                        <h2 class="text-lg text-gray-800 mb-2 md:text-[1.7rem] md:font-medium">
                            #{{ $producto->id }} {{ $producto->name }}
                        </h2>
                        <p class="my-4 text-sm text-gray-600 mb-1 md:text-[1.5rem]"><span
                                class="font-medium">Descripción:</span> {{ $producto->description }}</p>
                        <p class="my-4 md:text-[1.5rem] text-sm text-gray-600 mb-1"><span
                                class="font-medium">Precio:</span> ${{ $producto->price }}</p>
                        <p class="my-4 md:text-[1.5rem] text-sm text-gray-600 mb-1"><span
                                class="font-medium">Categoría:</span> {{ $producto->clasificacion }}</p>
                        <p class="my-4 md:text-[1.5rem] text-sm text-gray-600 mb-2"><span
                                class="font-medium">Estado:</span> <span
                                class="font-semibold text-green-500">{{ $producto->estado }}</span></p>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col items-center gap-2 md:gap-4 md:items-start">
                        <a class="btn btn-primary px-4 py-2 text-sm font-medium w-auto md:w-[100%] text-white bg-orange-500 rounded-md hover:bg-orange-600"
                            href="{{ route('vendedores.verproducto', $producto->id) }}">
                            <i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}
                        </a>

                        <a class="px-4 w-auto md:w-[100%] py-2 text-sm font-medium text-white  bg-blue-500 rounded-md hover:bg-blue-600"
                            href="{{ route('vendedores.editarproducto', $producto->id) }}">
                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                        </a>

                        <form action="{{ route('vendedores.eliminarproducto', $producto->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class=" btn btn-danger px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">
                                <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                @endif
            </div>



            <!--FIN DE LA CARTA-->

        </div>

        </div>

    </main>
    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')
</body>

</html>