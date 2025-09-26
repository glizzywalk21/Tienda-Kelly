<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VendedorProfileVista</title>
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
    <div>
        <div class="bg-rose-400 h-[160px] flex items-center justify-center">
            <h3 class="font-bold text-center text-[4rem]">Tienda<span class="text-white ml-2">Kelly</span></h3>
        </div>
        <div class="flex justify-center mt-5">
            <img class="w-20 bg-white rounded-full shadow-md  "
                src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="User Icon">
        </div>
        <div class="flex justify-center mt-2 ">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <img class="w-3 h-3 ml-1" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
            <h3 class="text-[10px]"> <span class="ml-2">5.0</span></h3>
        </div>
        <div class="text-center mt-3">
            <h3 class="text-xs">{{ $vendedor->nombre_del_local }}</h3>
            <h3 class="font-bold">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
            <h3 class="text-xs">{{ $vendedor->usuario }}</h3>
        </div>

        <div class="w-[50%] mx-auto mt-16">
            <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/AddSelectedIcon.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">Agregar Productos</h3> <!-- Alineado a la derecha -->
                </div>
            </a>
            <a href="{{ route('vendedores.editar', $vendedor->id) }}">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/EditSelectedIcon.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">Editar Mi Puesto</h3> <!-- Alineado a la derecha -->
                </div>
            </a>
            <a href="{{ route('vendedores.reservas') }}">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/BuzonSelectedIcon.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">Mi Buzon</h3> <!-- Alineado a la derecha -->

                </div>
            </a>
            <a href="{{ route('vendedores.historial') }}">
                <div class=" mx-auto flex items-center mt-10">
                    <img class="w-5" src="{{ asset('imgs/mercado.historial.png') }}" alt="User Icon">
                    <h3 class="flex-grow text-left font-bold ml-5">historial</h3> <!-- Alineado a la derecha -->

                </div>
            </a>










            <form action="{{ route('logout') }}" method="GET">
                @csrf
                <div class="mx-auto flex items-center mt-10 mb-16">
                    <img class="w-5" src="{{ asset('imgs/tuerca.png') }}" alt="User Icon">
                    <button type="submit" class="flex-grow text-left font-bold ml-5">Cerrar Cuenta</button>
                    <!-- Alineado a la derecha -->
                </div>
            </form>




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