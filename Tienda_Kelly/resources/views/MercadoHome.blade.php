<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Mercado Home</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon" />
</head>

<body class="overflow-x-hidden">
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
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
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
    <!-- INICIO BANNER -->
    <div class="w-screen hidden md:block">
        <img class="w-full h-[25rem] object-cover" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}"
            alt="Banner Image">
    </div>
    <!-- FIN BANNER -->

    <div class="mt-8 w-full mx-auto md:text-[30px]">
        <div class="flex md:justify-center pl-[0.5rem]  w-full mx-auto">
            <!-- Contenedor Principal -->
            <div>
                <!-- TITULO -->
                <div class="md:font-bold text-[2rem] md:text-[4rem] text-center">
                    {{ $mercadoLocal->nombre }}
                </div>
                <div class="md:text-center md:font-semibold font-bold">
                    Ubicado En: {{ $mercadoLocal->municipio }}
                </div>
                <div class="md:text-center   text-[20px] pb-[10px] md:w-[40rem] h-auto">
                    {{ $mercadoLocal->descripcion }}
                </div>
            </div>
        </div>

        <!--BOTONES PRINCIPALES-->
        <div class="object-center items-center">

            <a href="{{ route('mercados.editar') }}"
                class="md:px-[2rem] md:py-[1rem] md:text-[1.5rem] px-4 py-3 text-sm font-medium text-white bg-gray-500 rounded-md ml-2 hover:bg-gray-600"
                type="button">EDITAR MERCADO</a>


        </div>


        <!--clasificacionS-->

        <div class="md:text-center pt-[3rem] md:font-semibold font-bold">
            TODOS LOS PUESTOS:
        </div>


        <!--FIN DE clasificacionS-->



        <!-- Fin Principal -->

        <!-- CARTAS -->
        <div class="flex flex-wrap justify-center mt-10 text-sm gap-4 md:gap-[50px]">

            @foreach ($vendedors as $vendedor)
            <a href="{{ route('mercados.vervendedor', $vendedor->id) }}"
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
        <div class="w-full h-[2px] bg-white"></div>
    </footer>
    <!-- Paginación -->


</body>

</html>