<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ProductoUser</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('usuarios.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                Tienda <span class="text-blue-600"><b>Kelly</b></span>
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
    <div class="fixed bottom-0 left-0 right-0 p-4 md:hidden">
        <div class="bg-gray-900 rounded-2xl h-14 flex justify-around">
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

    <form action="{{ route('usuarios.addcarrito', $product) }}" method="POST">
        @csrf
        <div class="mx-auto mt-10 px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <img class="rounded-lg w-full shadow-lg" src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                    alt="{{ $product->imagen_referencia }}">
                <div class="bg-white p-6 rounded-lg shadow-lg">


                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-bold text-2xl lg:text-3xl text-gray-800"> {{ $product->name }}</h2>



                        <!--SUMATORIA-->
                        <div class="flex items-center space-x-2">
                            <!--Boton 1-->
                            <div class="bg-gray-200 border border-gray-400 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700 cursor-pointer"
                                onclick="decrement()">-</div>
                            <!--INPUT IMPORTANTES-->
                            <input readonly id="quantity" type="number" name="quantity" value="1" min="1"
                                class=" pl-[12px] w-12 h-8 text-center border border-gray-400 rounded mx-2">
                            <input type="hidden" name="subtotal" value="1" min="1">

                            <!--Boton 2-->
                            <div class="bg-gray-200 border border-gray-400 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700 cursor-pointer"
                                onclick="increment()">+</div>
                        </div>
                        <!--SUMATORIA-->


                    </div>

                    <!--ESTRELLAS
                <div class="flex items-center mb-4">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <img class="w-6 mr-2" src="{{ asset('imgs/775819.svg') }}" alt="Rating Icon">
                    <span class="text-lg text-gray-800">5.0</span>
                </div>
            -->

                    <p class="text-gray-600 mb-4 text-lg">
                        {{ $product->description }}
                    </p>
                    <hr class="my-4">

                    <div class="mb-6">
                        <h3 class="font-bold text-xl lg:text-2xl text-gray-800">Precio</h3>
                        <p class="text-xl lg:text-2xl text-gray-900">${{ $product->price }}</p>
                    </div>
                    <button type="submit"
                        class="w-full bg-gray-800 text-white text-lg font-bold py-3 rounded-lg hover:bg-gray-700 flex items-center justify-center">Agregar
                        al carrito
                    </button>

    </form>
    </div>
    </div>


    <!-- Recommended Products Section -->
    <div class="mt-16">
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-8">Productos Recomendados</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
            <!-- Product Card 1 -->
            <a href="{{ route('usuarios.producto', $product->id) }}" class="bg-white p-6 rounded-lg shadow-lg">
                <img class="rounded-lg w-full mb-4" src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                    alt="Producto 1">
                <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $product->vendedor->nombre_del_local }}. Precio:
                    ${{ $product->price }}</p>
            </a>
            @endforeach
            <!-- Product Card 2 -->

            <!-- Product Card 3 -->

        </div>
    </div>
    </div>
</body>
<script>
    function decrement() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value > 1) {
            value--;
            input.value = value;
        }
    }

    function increment() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        value++;
        input.value = value;
    }
</script>

</html>