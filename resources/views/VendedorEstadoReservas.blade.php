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
                Mis Reservas
            </div>

            <div class="space-y-4">



                <!--INICIO DE RESERVA-->
                @foreach ($reservations as $reservation)
                @if ($reservation->estado != 'archivado')
                <div
                    class="p-4 border border-gray-200 rounded-lg justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <h2 class="text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">
                        Reserva:
                        @if ($reservation->estado == 'enviado')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-yellow-200 text-yellow-800 rounded">
                            Recibido
                        </span>
                        @elseif($reservation->estado == 'sin_existencias')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-red-200 text-red-800 rounded">
                            No hay Existencias
                            {{ $reservation->sin_existencias }}
                        </span>
                        @elseif($reservation->estado == 'sin_espera')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            Cancelado
                        </span>
                        @elseif($reservation->estado == 'en_espera')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            Se está Esperando
                        </span>
                        @elseif($reservation->estado == 'en_entrega')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            Se Está Entregando
                        </span>
                        @elseif($reservation->estado == 'recibido')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-green-200 text-green-800 rounded">
                            Ya se entregó
                        </span>
                        @elseif($reservation->estado == 'sin_recibir')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            No se ha Entregado
                        </span>
                        @elseif($reservation->estado == 'problemas')
                        <span
                            class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            Hay Problemas
                        </span>
                        @endif
                    </h2>

                    @foreach ($reservation->items as $item)
                    <div
                        class="my-2 p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                        <div class="flex items-center flex-1">
                            <img src="{{ asset('imgs/' . $item->product->imagen_referencia) }}"
                                alt="{{ $item->product->imagen_referencia }}"
                                class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                            <div>
                                <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                                    <span class="font-bold">
                                        {{ $item->product->name }} con
                                        {{ $item->reservation->user->nombre }}
                                        {{ $item->reservation->user->apellido }}
                                    </span>
                                </h2>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]">
                                    <b>Cantidad:</b> {{ $item->quantity }}
                                </p>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]">
                                    <b>Precio (c/u):</b> ${{ $item->precio }}
                                </p>
                                <p class="text-sm md:text-[1.5rem] text-gray-600 mb-[8px]">
                                    <b>Subtotal:</b> ${{ $item->subtotal }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <!--PREGUNTAS-->
                            @if ($item->estado == 'enviado' || $item->estado == 'en_espera' || $item->estado == 'sin_recibir')
                            <h2 class="text-xl font-bold mb-4 text-center">¿El pedido está listo?</h2>
                            <form id="form-{{ $item->id }}"
                                action="{{ route('vendedores.publicarestadoreserva', $item->id) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}"
                                    value="">

                                <div class="flex justify-between">
                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'en_entrega')"
                                        class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Mi Pedido Está Listo
                                    </button>

                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'sin_existencias')"
                                        class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Ya No Hay Existencias
                                    </button>
                                </div>
                            </form>
                            @elseif($item->estado == 'sin_espera')
                            <h2 class="text-xl font-bold mb-4 text-center">El Cliente No espero</h2>

                            <form id="form-{{ $item->id }}"
                                action="{{ route('vendedores.eliminarrreservationitem', $item->id) }}"
                                method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}"
                                    value="">

                                <div class="flex justify-between">
                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'eliminar')"
                                        class="bg-red-500 hover:bg-red-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Eliminar Reserva
                                    </button>
                                </div>
                            </form>
                            @elseif($reservation->estado == 'sin_recibir')

                            <h2 class="text-xl font-bold mb-4 text-center">El Cliente No ha Recibido el
                                Paquete ¿Hay problemas?</h2>
                            <form id="form-{{ $item->id }}"
                                action="{{ route('vendedores.publicarestadoreserva', $item->id) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}"
                                    value="">

                                <div class="flex justify-between">
                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'en_entrega')"
                                        class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Mi Pedido Está Listo
                                    </button>

                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'problemas')"
                                        class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Hay Problemas
                                    </button>
                                </div>
                            </form>
                            @elseif($item->estado == 'problema')
                            <h2 class="text-xl font-bold mb-4 text-center">Ya se Envio su producto.
                                <br> Lo puede recibir en: <b>El Cliente
                                    {{ $item->reserva->user->nombre }} está esperando. ¿Ya resolvió su
                                    problema y envío el producto?
                            </h2>
                            <form id="form-{{ $item->id }}"
                                action="{{ route('vendedores.publicarestadoreserva', $item->id) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}"
                                    value="">

                                <div class="flex justify-between">
                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'en_entrega')"
                                        class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Ya lo Envíe
                                    </button>

                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'sin_existencias')"
                                        class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        No hay Existencia
                                    </button>
                                </div>
                            </form>
                            @elseif($item->estado == 'recibido')
                            <h2 class="text-xl font-bold mb-4 text-center">El Cliente ya lo recibió
                            </h2>
                            <form id="form-{{ $item->id }}"
                                action="{{ route('vendedores.publicarestadoreserva', $item->id) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}"
                                    value="">

                                <div class="flex justify-between">
                                    <button type="button"
                                        onclick="setEstado('{{ $item->id }}', 'archivado')"
                                        class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Archivar
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                @endif
                @endforeach
                <div class="h-[40rem]"></div>


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