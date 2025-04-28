<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Home Mercado User</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon" />
</head>

<body class="overflow-x-hidden">
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
    <!-- INICIO BANNER -->
    <div class="w-screen hidden md:block">
        <img class="w-full h-[25rem] object-cover" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}"
            alt="Banner Image">
    </div>
    <!-- FIN BANNER -->

    <div class="mt-14 w-full mx-auto md:text-[30px]">
        <div class="flex md:justify-center pl-[0.5rem]  w-full mx-auto">
            <!-- Contenedor Principal -->
            <div>
                <!-- TITULO -->
                <div class="md:font-bold text-[2rem] md:text-[4rem] ">
                    {{ $mercadoLocal->nombre }}
                </div>
                <div class="md:text-center md:font-semibold font-bold">
                    Ubicado En: {{ $mercadoLocal->municipio }}
                </div>
            </div>
        </div>


        <!--clasificacionS-->

        <!--BOTONES-->
        <div class="flex flex-wrap mt-5 mx-10 lg:mt-10">
            <div class="flex flex-wrap my-auto">
                <!-- Botón: Todos Los puestos -->
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="todos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg font-semibold {{ request('clasificacion') == 'todos' || !request('clasificacion') ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">TODOS LOS PUESTOS</span>
                    </button>
                </form>

                <!-- Botón: Comedores -->
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="comedor">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'comedor' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Comedores</span>
                    </button>
                </form>

                <!-- Botones adicionales -->
                <!-- Agrega todos los botones de la misma manera, aquí solo se muestran algunos ejemplos -->
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="ropa">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'ropa' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Ropa</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="artesanias">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'artesanias' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Artesanias</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="granosbasicos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'granosbasicos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Granos Basicos</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="mariscos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'mariscos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Mariscos</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="carnes">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'carnes' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Carnes</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="lacteos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'lacteos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Lacteos</span>
                    </button>
                </form>

                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="aves">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'aves' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Aves</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="plasticos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'plasticos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Plasticos</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="frutasyverduras">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'frutasyverduras' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Frutas y Verduras</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="emprendimiento">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'emprendimiento' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Emprendimiento</span>
                    </button>
                </form>
                <form action="{{ route('usuarios.mercado', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="otros">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'otros' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Otros</span>
                    </button>
                </form>

                <!-- Continúa con el mismo patrón para los otros botones -->
            </div>
        </div>

        <!--FIN DE clasificacionS-->



        <!-- Fin Principal -->

        <!-- CARTAS -->
        <div class="flex flex-wrap justify-center mt-10 text-sm gap-4 md:gap-[50px]">

            @foreach ($vendedors as $vendedor)
            <a href="{{ route('usuarios.vendedor', $vendedor->id) }}"
                class="w-full sm:w-[48%] md:w-[30%] mb-8 p-2 hover:shadow-lg hover:ease-in-out rounded-md">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}"
                    alt="{{ $vendedor->imagen_de_referencia }}">
                <h3 class="font-bold mt-5 text-[1.5rem]">{{ $vendedor->nombre_del_local }}</h3>
                <h3 class="mb-2">Tienda de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
                <div class="flex justify-between">
                    <b>
                        <h3>{{ $vendedor->clasificacion }}</h3>
                    </b>
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
    <!-- Paginación -->


</body>

</html>