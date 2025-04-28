<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="">
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
                    <img class="w-6" src="{{ asset('imgs/' . Auth::user()->imagen_de_referencia) }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>


    <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
    <div class="mt-10">
        <div class="flex justify-between my-5">
            <div class="ml-[3%]">
                <h1 class=" text-[1.25rem]">Hola! Bienvenido &#x1F44B;</h1>
                <h3 class="text-blue-800 font-bold text-[1.5rem]">{{ Auth::user()->nombre }}
                    {{ Auth::user()->apellido }}
                </h3>
            </div>
            <div class="mr-[3%] mt-4">
                <img class=" rounded-full w-12 h-12" src="{{ asset('imgs/'.Auth::user()->imagen_perfil) }}" alt="{{ Auth::user()->imagen_perfil }}">
            </div>
        </div>


        <div class="h-[70vh] bg-no-repeat bg-cover bg-center lg:bg-[center_top_-25rem]" style="background-image: url({{ asset('imgs/bkg.jpeg') }});">
        </div>

        <div class="flex my-8 justify-around w-[90%]  mx-auto">
            <button class="flex items-center px-3 py-2  rounded-md">
                <img class="w-7 mr-2" src="{{ asset('imgs/NosotrosIcon.png') }}" alt="User Icon">
                Nosotros
            </button>

            <button class="flex items-center px-3 py-2  rounded-md">
                <img class="w-7 mr-2" src="{{ asset('imgs/VisionIcon.png') }}" alt="User Icon">
                Vision
            </button>

            <button class="flex items-center px-3 py-2  rounded-md">
                <img class="w-7 mr-2" src="{{ asset('imgs/MisionIcon.png') }}" alt="User Icon">
                Mision
            </button>
        </div>


        @foreach ($mercadoLocals as $mercadoLocal)
        @if ($mercadoLocal->id % 2 != 0)
        <!--INICIO DE MERCADO-->
        <div class="md:p-0 p-4">
            <div
                class="flex flex-col-reverse p-4 border rounded md:border-none md:p-0 md:grid md:grid-cols-2 items-center">
                <div class="p-4 space-y-4 max-w-lg mx-auto flex flex-col items-center">
                    <h2 class="text-center font-bold text-3xl">{{ $mercadoLocal->nombre }}</h2>
                    <p> {{ $mercadoLocal->descripcion }}. Los horarios disponibles son:
                        <b>{{ $mercadoLocal->horaentrada }}</b> hasta <b>{{ $mercadoLocal->horasalida }}</b>.
                        Nos
                        podes encontrar en <b>{{ $mercadoLocal->ubicacion }}</b>, en el municipio de
                        {{ $mercadoLocal->municipio }}
                    </p>
                    <a class="block w-full mt-4 px-3 py-2"
                        href="{{ route('usuarios.mercado', $mercadoLocal->id) }}">
                        <button
                            class="block w-full mt-4 px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
                            Ver Mercado
                        </button>
                    </a>
                </div>
                <div>
                    <img class="w-full object-cover"
                        src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="">
                </div>
            </div>
        </div>
        @endif

        @if ($mercadoLocal->id % 2 != 1)
        <div class="md:p-0 p-4 bg-[#334765] text-white">
            <div
                class="flex flex-col p-4 border border-gray-200 rounded md:border-none md:p-0 md:grid md:grid-cols-2 items-center">

                <div>
                    <img class="h-full w-full object-cover"
                        src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="">
                </div>
                <div class="p-4 space-y-4 max-w-lg mx-auto flex flex-col items-center">
                    <h2 class="text-center font-bold text-3xl">{{ $mercadoLocal->nombre }}</h2>
                    <p> {{ $mercadoLocal->descripcion }}. Los horarios disponibles son:
                        <b>{{ $mercadoLocal->horaentrada }}</b> hasta <b>{{ $mercadoLocal->horasalida }}</b>.
                        Nos
                        podes encontrar en <b>{{ $mercadoLocal->ubicacion }}</b>, en el municipio de
                        {{ $mercadoLocal->municipio }}
                    </p>
                    <a class="block w-full mt-4 px-3 py-2"
                        href="{{ route('usuarios.mercado', $mercadoLocal->id) }}">
                        <button
                            class="block w-full mt-4 px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
                            Ver Mercado
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <!--FIN DE MERCADO-->




        <div class="mt-6 p-4">
            <h2 class="text-center font-bold mb-4 text-3xl">Puestos Populares</h2>
            <div class="flex flex-col md:grid grid-cols-3 gap-6">
                <!--INICIO DE VENDEDOR-->
                @foreach ($vendedors->take(3) as $vendedor)
                <div>
                    <img class="h-[15rem] w-[40rem] object-cover"
                        src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="">
                    <h3 class="font-bold text-lg">Puesto de {{ $vendedor->nombre }} en
                        {{ $vendedor->mercadoLocal->nombre }}
                    </h3>
                    <a href="{{ route('usuarios.vendedor', $vendedor->id) }}">
                        <div class="flex gap-2 items-center">
                            <p>Ver Puesto </p>
                            <img width="18" src="{{ asset('imgs/arrow_left.png') }}" alt="">
                        </div>
                    </a>
                </div>
                <!--FIN DE VENDEDOR-->
                @endforeach

            </div>
        </div>

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

    </div>

</body>

</html>