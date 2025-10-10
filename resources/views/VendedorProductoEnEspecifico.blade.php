<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ProductoUser</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
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

    <div class="mx-auto mt-10 px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <img class="rounded-lg h-[25rem] object-cover w-full shadow-lg"
                src="{{ asset('imgs/' . $product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-bold text-2xl lg:text-3xl text-gray-800">{{ $product->name }}</h2>

                </div>



                <p class="text-gray-600 mb-4 text-lg">
                    {{ $product->description }}
                </p>
                <hr class="my-4">

                <div class="mb-6">
                    <h3 class="font-bold text-xl lg:text-2xl text-gray-800">Precio</h3>
                    <p class="text-xl lg:text-2xl text-gray-900">${{ $product->price }}</p>
                </div>

                <a class="w-full bg-sky-300 hover:bg-sky-400 text-white text-lg font-bold py-3 rounded-lg  flex items-center justify-center my-4 uppercase"
                    href="{{ route('vendedores.editarproducto', $product->id) }}">

                    Editar
                </a>
                <form action="{{ route('vendedores.eliminarproducto', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit"
                        class="w-full bg-red-400 hover:bg-red-500 text-white text-lg font-bold py-3 rounded-lg  flex items-center justify-center my-4 uppercase"
                        value="ELIMINAR">
                </form>
            </div>
        </div>

        <!-- Recommended Products Section -->
        <div class="mt-16">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-8">Otros Productos Tuyos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card 1 -->
                @foreach ($products as $product)
                <a href="{{ route('vendedores.verproducto', $product->id) }} class=" bg-white p-6 rounded-lg
                    shadow-lg ">
                    <img class=" rounded-lg w-full mb-4" src="{{ asset('imgs/' . $product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}">
                    <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4">
                        <p class="text-gray-600 mb-4">{{ $product->vendedor->nombre_del_local }}. Precio: ${{ $product->price }}</p>

                </a>
                @endforeach

                <!--End CARD-->
            </div>
        </div>
    </div>
</body>

</html>