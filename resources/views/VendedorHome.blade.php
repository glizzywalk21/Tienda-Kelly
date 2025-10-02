<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Tienda Kelly Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('vendedores.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text- font-bold">
                Tienda Kelly <span class="text-rose-400 font-bold">Vendedores</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('vendedores.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mis Productos</a>
            <a href="{{ route('vendedores.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mi Reservas</a>
            <a href="{{ route('vendedores.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mis Historial</a>
            <a href="{{ route('vendedor.perfil') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
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

    <h1 class="md:hidden text-3xl md:text-4xl lg:text-5xl font-black pl-2 mb-6">
        Tienda Kelly <span class="text-orange-600  uppercase"><b>Vendedor</b></span>
    </h1>
    <div class="flex justify-between mt-5">
        <div class="ml-[2%]">
            <h1>Hola! Bienvenido &#x1F44B;</h1>
            <h3 class="text-rose-500 font-bold">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
        </div>
        <div class="md:hidden mr-[5%] mt-4 rounded-full w-12 ">
            <img class="rounded-full object-cover " src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}"
                alt="User Icon">
        </div>
    </div>

    <div class="flex flex-col xl:flex-row justify-center items-center w-screen">

        <!-- Contenedor Principal -->


        <!-- Imagen -->
        <div class="w-full md:w-auto md:flex-shrink-0 flex justify-center md:justify-start">
            <img class="w-[10rem] h-[10rem] md:w-[52rem] md:h-[25rem] object-cover object-center rounded-full md:rounded-[25px] mx-auto"
                src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="Banner Image">
        </div>


        <!-- Etiquetas -->
        <div
            class="flex flex-col  justify-center items-center lg:items-start md:ml-8 mt-4 lg:mt-0 text-center lg:text-left">

            <div class="font-bold text-[1.5rem] lg:text-[2rem] ">
                {{ $vendedor->nombre_del_local }}
            </div>
            <div class="text-[1rem] lg:font-semibold  lg:text-[1.3rem] mt-2">
                Propietario: <span>{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</span>
            </div>
            <div class="font-semibold text-[1rem] lg:text-[1.3rem] mt-2">
                Puesto #{{ $vendedor->numero_puesto }} - <span class=""> en {{ $mercadoLocal->nombre }}</span>
            </div>
            <!-- Añade más etiquetas aquí -->
            <div class="text-[1rem] lg:font-semibold  lg:text-[1.3rem] mt-2">
                Correo Electronico: <span>{{ $vendedor->usuario }}</span>
            </div>

            <div class="mt-4 md:mt-[2rem] xl:mt-[3rem]">
                <a href="{{ route('vendedores.editar', $vendedor->id) }}"
                    class="lg:px-[2rem] lg:py-[1rem] lg:text-[1rem] px-4 py-3 text-sm font-medium text-white bg-rose-400 rounded-md mt-2 hover:bg-rose-500"
                    type="button">EDITAR MI PUESTO</a>
            </div>

        </div>

    </div>


    <div class="flex mt-16 justify-around w-[90%] mx-auto">
        <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}" class="btn btn-primary btn-sm float-right "
            data-placement="left">

            <span class="flex items-center px-3 py-2 uppercase rounded-md font-bold">
                <img class="w-[3rem] mr-2" src="{{ asset('imgs/AddIcon.png') }}" alt="User Icon">
                Agregar Productos
            </span>
        </a>



    </div>


    <!-- Fin Principal -->


    <!-- CARTAS -->
    <div class="flex flex-wrap justify-center mt-10 text-sm gap-4 md:gap-[50px]">
        @if ($products->isEmpty())
        <p class="md:text-[1.75rem] text-[1.5rem] py-[18rem] font-semibold text-gray-600">No hay Productos en Venta
        </p>
        @else
        @foreach ($products as $product)
        <a href="{{ route('vendedores.verproducto', $product->id) }}"
            class="w-full sm:w-[48%] md:w-[25%] mb-8 p-4 hover:shadow-lg hover:ease-in-out rounded-md">
            <img class="w-full h-[300px] rounded-md overflow-hidden object-cover"
                src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                alt="{{ $product->imagen_referencia }}">
            <div class="flex ">
                <h1 class="font-bold uppercase text-2xl mt-5 m-[1rem]">{{ $product->name }}</h1>
            </div>
            <h3 class="mb-2 text-xl">${{ $product->price }}</h3>
            <div class="flex justify-between">
                <h3>{{ $product->description }}</h3>
            </div>
        </a>
        @endforeach
        @endif
    </div>


    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white p-[3rem]">
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