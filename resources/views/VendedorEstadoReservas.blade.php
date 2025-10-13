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
                Mis Reservas
            </div>

            <div class="space-y-4">



                <!-- INICIO DE RESERVA -->
                @foreach ($reservations as $reservation)
                @if ($reservation->estado != 'archivado')
                <div class="p-6 mb-6 border border-gray-300 rounded-xl shadow-sm bg-white hover:bg-indigo-50 transition">

                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-4">
                        <span>Reserva:</span>
                        @if ($reservation->estado == 'enviado')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-yellow-200 text-yellow-800">
                            Recibido
                        </span>
                        @elseif($reservation->estado == 'sin_existencias')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-red-200 text-red-800">
                            No hay Existencias {{ $reservation->sin_existencias }}
                        </span>
                        @elseif($reservation->estado == 'sin_espera')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-orange-200 text-orange-800">
                            Cancelado
                        </span>
                        @elseif($reservation->estado == 'en_espera')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-orange-200 text-orange-800">
                            Se está Esperando
                        </span>
                        @elseif($reservation->estado == 'en_entrega')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-orange-200 text-orange-800">
                            Se Está Entregando
                        </span>
                        @elseif($reservation->estado == 'recibido')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-green-200 text-green-800">
                            Ya se entregó
                        </span>
                        @elseif($reservation->estado == 'sin_recibir')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-orange-200 text-orange-800">
                            No se ha Entregado
                        </span>
                        @elseif($reservation->estado == 'problemas')
                        <span class="px-3 py-1 rounded text-sm font-semibold uppercase bg-orange-200 text-orange-800">
                            Hay Problemas
                        </span>
                        @endif
                    </h2>

                    @foreach ($reservation->items as $item)
                    <div class="my-4 p-4 border border-gray-200 rounded-lg flex flex-col md:flex-row gap-4 bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('imgs/' . $item->product->imagen_referencia) }}"
                                alt="{{ $item->product->imagen_referencia }}"
                                class="object-cover w-24 h-24 md:w-40 md:h-40 rounded-md">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                <span class="font-bold">
                                    {{ $item->product->name }} por
                                    <span class="text-indigo-600">
                                        {{ $item->reservation->user->nombre }} {{ $item->reservation->user->apellido }}
                                    </span>
                                </span>
                            </h3>
                            <ul class="text-indigo-700 space-y-1 text-sm md:text-base">
                                <li><strong>Cantidad:</strong> {{ $item->quantity }}</li>
                                <li><strong>Precio (c/u):</strong> <span class="text-black">${{ $item->precio }}</span></li>
                                <li><strong>Subtotal:</strong> <span class="text-black">${{ $item->subtotal }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6">
                        @if ($item->estado == 'enviado' || $item->estado == 'en_espera' || $item->estado == 'sin_recibir')
                        <h2 class="text-lg md:text-xl font-semibold mb-4 text-center text-gray-700">¿El pedido está listo?</h2>
                        <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                            <div class="flex flex-col md:flex-row gap-4 justify-center">
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'en_entrega')"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Mi Pedido Está Listo
                                </button>
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'sin_existencias')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Ya No Hay Existencias
                                </button>
                            </div>
                        </form>

                        @elseif($item->estado == 'sin_espera')
                        <h2 class="text-lg md:text-xl font-semibold mb-4 text-center text-gray-700">El Cliente No esperó</h2>
                        <form id="form-{{ $item->id }}" action="{{ route('vendedores.eliminarrreservationitem', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                            <div class="flex justify-center">
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'eliminar')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Eliminar Reserva
                                </button>
                            </div>
                        </form>

                        @elseif($reservation->estado == 'sin_recibir')
                        <h2 class="text-lg md:text-xl font-semibold mb-4 text-center text-gray-700">
                            El Cliente No ha Recibido el Paquete<br>¿Hay problemas?
                        </h2>
                        <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                            <div class="flex flex-col md:flex-row gap-4 justify-center">
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'en_entrega')"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Mi Pedido Está Listo
                                </button>
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'problemas')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Hay Problemas
                                </button>
                            </div>
                        </form>

                        @elseif($item->estado == 'problema')
                        <h2 class="text-lg md:text-xl font-semibold mb-4 text-center text-gray-700">
                            Ya se envió su producto.<br>
                            El Cliente {{ $item->reserva->user->nombre }} está esperando.<br>
                            ¿Ya resolvió su problema y envió el producto?
                        </h2>
                        <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                            <div class="flex flex-col md:flex-row gap-4 justify-center">
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'en_entrega')"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Ya lo Envié
                                </button>
                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'sin_existencias')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    No hay Existencia
                                </button>
                            </div>
                        </form>

                        @elseif($item->estado == 'recibido')
                        <h2 class="text-lg md:text-xl font-semibold mb-4 text-center text-gray-700">El Cliente ya lo recibió</h2>
                        <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                            <div class="flex justify-center">

                                <button type="button"
                                    onclick="setEstado('{{ $item->id }}', 'archivado')"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Archivar
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
                @endforeach
                <div class="h-[35rem]"></div>


                <script>
                    function setEstado(itemId, estado) {
                        // Establece el valor del input oculto con el estado seleccionado
                        document.getElementById('estado-' + itemId).value = estado;
                        // Envía el formulario correspondiente
                        document.getElementById('form-' + itemId).submit();
                    }
                </script>


                <!--FIN DE SEGMENTO DE RESERVA-->


            </div>
        </div>

    </main>

    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')
</body>


</html>