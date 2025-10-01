<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Producto Del puesto</title>
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
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
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
    <div class="mt-14 w-full mx-auto md:text-[30px]">

        <div class="w-screen hidden md:block object-center">
            <img class="w-[15rem] h-[15rem] object-cover object-center rounded-full mx-auto"
                src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="Banner Image">
        </div>

        <div class="flex md:justify-center pl-[0.5rem]  w-full mx-auto">
            <!-- Contenedor Principal -->
            <div>
                <!-- TITULO -->
                <div class="md:font-bold text-[2rem] md:text-[4rem] ">
                    {{ $vendedor->nombre_del_local }}
                </div>
                <div class="md:text-center md:font-semibold font-bold">
                    Puesto #{{ $vendedor->numero_puesto }} - <span
                        class="md:font-bold">{{ $mercadoLocal->nombre }}</span>
                </div>
            </div>
        </div>

        <!-- Fin Principal -->


        <!-- CARTAS -->
        <div class="flex flex-wrap justify-center mt-10 text-sm gap-4 md:gap-[50px]">

            @foreach ($products as $product)
            <a href="{{ route('usuarios.producto', $product->id) }}"
                class="w-full sm:w-[48%] md:w-[25%] mb-8 p-2 hover:shadow-lg hover:ease-in-out rounded-md">
                <img class="w-full h-[300px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                    alt="{{ $product->imagen_referencia }}">
                <div class="flex ">
                    <h1 class="font-bold uppercase text-2xl mt-5 m-[1rem]">
                        {{ $product->name }}
                    </h1>

                </div>
                <h3 class="mb-2 text-xl">${{ $product->price }}</h3>
                <div class="flex justify-between">
                    <h3>{{ $product->description }}</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </a>
            @endforeach

        </div>
        <!-- FIN CARTAS -->
    </div>

    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white p-12">
            <div>
                <h2 class="font-bold">Contact Us</h2>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>
            </div>
            <div>
                <h2 class="font-bold">Sobre nosotros</h2>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
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
        <div class="w-full h-[2px] bg-white"></div>
    </footer>



</body>

</html>