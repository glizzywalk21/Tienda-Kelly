<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Admin General</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('admin.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                Tienda <span class="text-purple-600"><b>Admin</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mercados</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Clientes</a>
            <a href="{{ route('AdminProfileVista')}}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>



    <!-- Inicio de nav movil-->
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


    <div class="w-screen hidden md:block">
        <img class="w-full h-[25rem] object-cover" src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}" alt="Banner Image">
    </div>

    <div class="mt-14  w-[90%] mx-auto ">

        <div class="flex justify-between text-center  w-[90%] mx-auto "> <!--Contenedor Principal-->
            <div>
                <div class=" lg:text-[60px] font-semibold">
                    {{ $mercadoLocal->nombre }}
                </div>
                <div class=" lg:text-[40px]">
                    Ubicado en {{ $mercadoLocal->ubicacion }}
                </div>
            </div>
        </div>
        <!--El titulo-->

        <!--BOTONES-->
        <div class="flex flex-wrap mt-5 lg:mt-10">
            <div class="flex flex-wrap my-auto">
                <!-- Botón: Todos Los puestos -->
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="todos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg font-semibold {{ request('clasificacion') == 'todos' || !request('clasificacion') ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">TODOS LOS PUESTOS</span>
                    </button>
                </form>

                <!-- Botón: Comedores -->
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="comedor">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'comedor' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Comedores</span>
                    </button>
                </form>

                <!-- Botones adicionales -->
                <!-- Agrega todos los botones de la misma manera, aquí solo se muestran algunos ejemplos -->
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="ropa">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'ropa' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Ropa</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="artesanias">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'artesanias' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Artesanias</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="granosbasicos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'granosbasicos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Granos Basicos</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="mariscos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'mariscos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Mariscos</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="carnes">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'carnes' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Carnes</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="lacteos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'lacteos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Lacteos</span>
                    </button>
                </form>

                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="aves">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'aves' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Aves</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="plasticos">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'plasticos' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Plasticos</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="frutasyverduras">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'frutasyverduras' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Frutas y Verduras</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="emprendimiento">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'emprendimiento' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Emprendimiento</span>
                    </button>
                </form>
                <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                    <input type="hidden" name="clasificacion" value="otros">
                    <button type="submit" class="flex items-center h-8 lg:h-11 border px-2 py-1 rounded-md mr-2 mb-2 text-xs lg:text-lg {{ request('clasificacion') == 'otros' ? 'bg-blue-300 border-blue-300 text-white font-bold' : 'bg-white hover:border-gray-600 border-gray-300 hover:font-semibold' }}">
                        <span class="ml-1">Otros</span>
                    </button>
                </form>

                <!-- Continúa con el mismo patrón para los otros botones -->
            </div>
        </div>

        <!--FIN BOTONES-->

        <!--Comienzo de las cartas -->

        <div class="flex flex-wrap justify-center mt-5 text-sm gap-[10px]  lg:gap-[40px]">
            <!-- INICIO DE CARTA-->
            @if ($vendedors->isEmpty())
            <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Vendedores Inscritos</span>
            @else
            @foreach ($vendedors as $vendedor)

            <a href="{{ route('admin.vervendedores',$vendedor->id) }}" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="User Icon">
                <h3 class="font-bold mt-5">{{ $vendedor->nombre_del_local}}</h3>
                <h3 class="mb-2">Propietario: {{ $vendedor->nombre}} {{$vendedor->apellidos }}</h3>
                <div class="flex justify-between">
                    <h3>
                        @if ($vendedor->clasificacion == 'frutasyverduras')
                        Frutas y Verduras
                        @elseif ( $vendedor->clasificacion == 'comedor')
                        Comedor
                        @else
                        {{ $vendedor->clasificacion }}
                        @endif
                    </h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5 " src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>

            </a>
            @endforeach
            @endif
            <!--FIN DE CARTA-->





        </div>
    </div>
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
                <p>Dirección: San Rafael cedros, Cuscatlan</p>

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


</body>

</html>