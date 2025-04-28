<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
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

    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center md:font-bold text-[2rem] md:text-[4rem] ">
                Todos los Archivos
            </div>

            <div class="space-y-4">


                <!--INICIO DE RESERVA-->
                @if ($reservations->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Reservas Todavía</span>
                @else
                @foreach ($reservations as $reservation)
                @if ($reservation->estado != 'entregado')
                <div
                    class="p-4 border border-gray-200 rounded-lg justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <h2 class="text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Reserva:
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-green-200 text-green-800 rounded">
                            @if ($reservation->estado == 'enviado')
                            Recibido
                            @endif
                            {{ $reservation->estado }}
                        </span>
                    </h2>
                    <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                        <span class="font-bold">Pedido Por</span> {{ $reservation->user->nombre }} {{ $reservation->user->apellido }}
                    </h2>
                    <p class="text-sm md:text-[1.5rem] text-gray-600 font-bold mb-[8px]">Total: ${{ $reservation->total }}</p>

                    @foreach ($reservation->items as $item)
                    <div
                        class="my-2 p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                        <div class="flex items-center">
                            <img src="{{ asset('imgs/' . $item->product->imagen_referencia) }}"
                                alt="{{ $item->product->imagen_referencia }}"
                                class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                            <div>
                                <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                                    <span class="font-bold">{{ $item->product->name }} de <b>{{ $item->product->vendedor->nombre_del_local }}</b>
                                </h2>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]"><b>Cantidad:</b> {{ $item->quantity }}</p>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]"><b>Precio (c/u):</b> ${{ $item->precio }}</p>
                                <p class="text-sm md:text-[1.5rem] text-gray-600 mb-[8px]"><b>Subtotal:</b> ${{ $item->subtotal }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @endforeach
                @endif

                <!--FIN DE SEGMENTO DE RESERVA-->


            </div>
        </div>

    </main>
    <footer class="bg-[#292526] pb-16">
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

</html>