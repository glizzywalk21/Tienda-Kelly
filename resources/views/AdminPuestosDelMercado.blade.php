<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Admin General</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">
    <!-- Desktop Navbar -->
    <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
        <a href="{{ route('admin.index') }}">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Areas</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
            <a href="{{ route('AdminProfileVista')}}"
                class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </div>
    </nav>



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




    <div class="mt-14  w-[90%] mx-auto ">

        <div class="flex justify-between  w-[90%] mx-auto "> <!--Contenedor Principal-->
            <div>
                <div class=" lg:text-[60px]">
                    Puesto #{{ $vendedor->numero_puesto}} {{ $vendedor->nombre_del_local }}
                </div>
            </div>

            <div>
                <img class="w-[200px] h-[200px] object-cover rounded-full" src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="User Icon">
            </div>

        </div>

        <!--Comienzo de las cartas -->

        <div class="flex flex-wrap justify-center mt-5 text-sm gap-[10px]  lg:gap-[40px]">
            <!-- INICIO DE CARTA-->
            @if ($products->isEmpty())
            <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Vendedores Inscritos</span>
            @else
            @foreach ($products as $product)
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/'.$product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}">
                <h3 class="font-bold mt-5">{{ $product->name }}</h3>
                <h3 class="mb-2">{{ $product->vendedor->nombre_del_local }}</h3>
                <div class="flex justify-between">
                    <h3>{{ $product->clasificacion }}</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5 " src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>

            </div>
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


</body>

</html>