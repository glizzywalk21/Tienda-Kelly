<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body>


    <!-- Desktop Navbar -->
    <div class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
        <a href="{{ route('vendedores.index') }}">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                Tienda Kelly <span class="text-indigo-400 font-bold">Vendedores</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('vendedores.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mis Productos</a>
            <a href="{{ route('vendedores.reservas') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Reservas</a>
            <a href="{{ route('vendedores.historial') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mis Historial</a>
            <a href="{{ route('vendedor.perfil') }}"
                class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
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


    <main class="p-4">

        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <div class="flex justify-between mt-5">
                <div class="ml-[2%]">
                    <h1 class="md:text-[1.5rem] text-[1rem]">{{ $vendedor->nombre_del_local }} en <span
                            class="font-semibold"> {{ $vendedor->mercadoLocal->nombre }}</span></h1>
                    <h3 class="text-indigo-400 font-bold text-[1rem]">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}
                    </h3>
                </div>
                <div class="md:hidden mr-[5%] mt-4 rounded-full w-[8rem] h-[8rem] ">
                    <img class="rounded-full object-cover "
                        src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="User Icon">
                </div>
            </div>
            <div class="text-center md:font-semibold text-[2rem] md:text-[4rem] ">
                Mi Historial
            </div>

            <div class="space-y-4">



                <!--INICIO DE RESERVA-->
                @if ($reservations->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay
                    Historial Todavia</span>
                @else
                @foreach ($reservations as $reservation)
                @if ($reservation->estado == 'archivado')
                <div
                    class="p-4 border border-gray-200 rounded-lg  justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">

                    <h2 class=" text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Reserva:
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-gray-200 text-gray-800 rounded">

                            Ya esta Archivado

                        </span>
                    </h2>
                    <h2 class=" text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]"><span
                            class="font-bold">Entregado a:</span> {{ $reservation->user->nombre }}
                        {{ $reservation->user->apellido }}
                    </h2>

                    <p class="text-sm md:text-[1.5rem] text-gray-600 font-bold mb-[8px]">Total:
                        ${{ $reservation->total }}</p>
                    <p class="text-sm md:text-[1.5rem] text-gray-600  mb-[8px]"><b>Fecha de Entrega:</b>
                        {{ $reservation->updated_at }}
                    </p>

                    @foreach ($reservation->items as $item)
                    <!--INICIO DE CARTA-->
                    <div
                        class="my-2 p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                        <div class="flex items-center">
                            <img src="{{ asset('imgs/' . $item->product->imagen_referencia) }}"
                                alt="{{ $item->product->imagen_referencia }}"
                                class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                            <div>
                                <h2
                                    class=" text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                                    <span class="font-bold">{{ $item->product->name }}
                                </h2>
                                <p class="text-sm md:text-[1.25rem] text-gray-600  mb-[8px]">
                                    <b>Cantidad:</b> {{ $item->quantity }}
                                </p>
                                <p class="text-sm md:text-[1.25rem] text-gray-600  mb-[8px]"><b>Precio
                                        (c/u)
                                        :</b> ${{ $item->precio }}</p>
                                <p class="text-sm md:text-[1.5rem] text-gray-600  mb-[8px]">
                                    <b>Subtotal:</b> ${{ $item->subtotal }}
                                </p>
                            </div>

                        </div>

                    </div>
                    @endforeach
                    <!--FIN DE CARTA-->
                </div>
                @endif
                @endforeach
                @endif
                <!--FIN DE SEGMENTO DE RESERVA-->


            </div>
        </div>

    </main>
    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')
</body>

</html>