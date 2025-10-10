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
    <div class="hidden md:flex p-4 items-center justify-between shadow-md">
        <a href="{{ route('mercados.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text- font-bold">
                Tienda Kelly: <span class="text-red-500 font-bold">Mercado</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('mercados.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Hogar</a>
            <a href="{{ route('mercados.listavendedores') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Vendedores</a>
            <a href="{{ route('mercados.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Reservas</a>
            <a href="{{ route('mercados.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Historial</a>
            <a href="{{ route('mercados.perfil') }}"
                class="font-semibold uppercase text-sm lg:text-base  hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <<div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
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

        <form action="{{ route('usuarios.addcarrito', $product) }}" method="POST">
            @csrf
            <div class="mx-auto mt-10 px-4 max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <img class="rounded-lg h-auto shadow-lg" src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                        alt="{{ $product->imagen_referencia }}">
                    <div class="bg-white p-6 rounded-lg shadow-lg">


                        <div class="flex justify-between items-center mb-6">
                            <h2 class="font-bold text-2xl lg:text-3xl text-gray-800"> {{ $product->name }}</h2>



                            <!--SUMATORIA-->

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
                            al carrito</button>

        </form>
        </div>
        </div>


        <!-- Recommended Products Section -->
        <div class="mt-16">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-8">Otros Productos del Vendedor</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($products as $product)
                <!-- Product Card 1 -->
                <a href="{{ route('mercados.verproducto', $product->id) }}" class="bg-white p-6 rounded-lg shadow-lg">
                    <img class="rounded-lg w-full mb-4" src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                        alt="{{ $product->imagen_referencia }}">
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
        <footer class="bg-[#292526] mt-4 pb-16">
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