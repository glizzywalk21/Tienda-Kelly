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

        <a href="{{ route('admin.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
                Admin <span class="text-purple-600"><b>Tienda</b></span>
            </h1>
        </a>

        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Mercados</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Clientes</a>
            <a href="{{ route('AdminProfileVista')}}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>



    <div class="mx-auto max-w-lg"> <!-- Añadido un margen inferior -->
        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
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
    </div>

    <form action="{{ route('usuarios.addcarrito', $product) }}" method="POST">
        @csrf
        <div class="mx-auto mt-10 px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <img class="rounded-lg w-full shadow-lg" src="{{ asset( 'imgs/'.$product->imagen_referencia) }}"
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
                    <button type="submit" class="w-full bg-gray-800 text-white text-lg font-bold py-3 rounded-lg hover:bg-gray-700 flex items-center justify-center">Agregar al carrito</button>

    </form>
    </div>
    </div>


    <!-- Recommended Products Section -->
    <div class="mt-16">
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-8">Otros Productos del Vendedor</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
            <!-- Product Card 1 -->
            <a href="{{ route('usuarios.producto', $product->id) }}" class="bg-white p-6 rounded-lg shadow-lg">
                <img class="rounded-lg w-full mb-4" src="{{ asset( 'imgs/'.$product->imagen_referencia) }}" alt="Producto 1">
                <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $product->vendedor->nombre_del_local }}. Precio: ${{ $product->price }}</p>
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
<footer class="bg-[#292526] pb-16">
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

</html>