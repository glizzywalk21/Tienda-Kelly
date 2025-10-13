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
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Historial</a>
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
        <div class="w-full bg-white p-8 rounded-xl shadow-md">
            <div class="flex justify-between items-start flex-wrap gap-4 mt-5">
                <div class="ml-2">
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-800">
                        {{ $vendedor->nombre_del_local }} en
                        <span class="font-bold text-indigo-600">{{ $vendedor->mercadoLocal->nombre }}</span>
                    </h1>
                    <h3 class="text-indigo-500 font-medium text-base mt-1">
                        {{ $vendedor->nombre }} {{ $vendedor->apellidos }}
                    </h3>
                </div>
                <div class="md:hidden mr-4 mt-2 w-32 h-32 rounded-full overflow-hidden">
                    <img class="w-full h-full object-cover rounded-full"
                        src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="User Icon">
                </div>
            </div>

            <div class="text-center text-3xl md:text-5xl font-bold text-gray-700 my-8">
                Mi Historial
            </div>

            <div class="space-y-6">
                <!-- INICIO DE RESERVA -->
                @if ($reservations->isEmpty())
                <span class="flex justify-center text-2xl text-gray-500 my-28">
                    No hay Historial Todavía
                </span>
                @else
                @foreach ($reservations as $reservation)
                @if ($reservation->estado == 'archivado')
                <div class="p-6 border border-gray-200 rounded-xl bg-gray-50 hover:bg-indigo-50 transition">

                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 flex items-center gap-4">
                        <span>Reserva:</span>
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-gray-300 text-gray-800">
                            Ya está Archivado
                        </span>
                    </h2>

                    <h2 class="text-lg md:text-xl font-bold text-gray-700 mb-2">
                        Entregado a:
                        <span class="text-indigo-700">{{ $reservation->user->nombre }} {{ $reservation->user->apellido }}</span>

                    </h2>

                    <p class="text-base md:text-lg text-gray-600 font-semibold mb-1">
                        <b class="text-indigo-600">Total:</b> ${{ $reservation->total }}
                    </p>
                    <p class="text-base md:text-lg text-gray-600 mb-4">
                        <b class="text-indigo-600">Fecha de Entrega:</b> {{ $reservation->updated_at }}
                    </p>

                    @foreach ($reservation->items as $item)
                    <!-- INICIO DE CARTA -->
                    <div class="my-4 p-4 border border-gray-200 rounded-lg flex flex-col md:flex-row gap-4 bg-white hover:bg-gray-50 transition">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('imgs/' . $item->product->imagen_referencia) }}"
                                alt="{{ $item->product->imagen_referencia }}"
                                class="object-cover w-24 h-24 md:w-40 md:h-40 rounded-md">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg md:text-2xl font-semibold text-gray-800 mb-2">
                                {{ $item->product->name }}
                            </h3>
                            <ul class="text-gray-700 space-y-1 text-sm md:text-base">
                                <li><strong>Cantidad:</strong> {{ $item->quantity }}</li>
                                <li><strong>Precio (c/u):</strong> ${{ $item->precio }}</li>
                                <li><strong>Subtotal:</strong> ${{ $item->subtotal }}</li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    <!-- FIN DE CARTA -->
                </div>
                @endif
                @endforeach
                @endif
                <!-- FIN DE SEGMENTO DE RESERVA -->
            </div>
        </div>
    </main>


    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')
</body>

</html>