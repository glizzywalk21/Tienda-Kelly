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
            <a href="{{ route('UserProfileVista') }}" class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class=" absolute left-0 right-0 bottom-0">
        <div class="md:hidden bottom-0 relative flex justify-center left-0 right-0 z-10 ">
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
                        <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--  FIN Mobile Navbar -->
    <main class="md:p-[3rem] flex z-10 left-0 right-0">
        <div class="w-full bg-white p-8 rounded-lg md:shadow-lg">
            <div class="text-center md:font-bold text-[2rem] md:text-[4rem] ">
                Mis Reservas
            </div>

            <div class="space-y-4">
                @if ($reservations->isEmpty() || $reservations->every(fn($reservation) => $reservation->estado == 'archivado'))
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Reservas Todavía</span>
                @else
                <!-- INICIO DE RESERVA -->
                @foreach ($reservations as $reservation)

                @if ($reservation->estado != 'archivado')
                <div class="p-4 font-sans font-light border-gray-200 rounded-lg justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <a href="{{ route('viewReceipt', $reservation->id) }}" target="_blank" class="inline-flex items-center px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Ver Recibo
                    </a>


                    <h2 class="text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Reserva:
                        @if ($reservation->estado == 'enviado')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[0.5rem] md:px-[0.5rem] text-s md:text-[16px] font-semibold bg-amber-300 text-white rounded">
                            Enviado
                        </span>
                        @elseif($reservation->estado == 'sin_existencias')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-red-200 text-red-800 rounded">
                            No hay Existencias
                            {{ $reservation->sin_existencias }}
                        </span>
                        @elseif($reservation->estado == 'sin_espera')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-red-200 text-red-800 rounded">
                            Cancelado
                        </span>
                        @elseif($reservation->estado == 'en_espera')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            Se está Esperando
                        </span>
                        @elseif($reservation->estado == 'en_entrega')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            Ya lo puede Recoger
                        </span>
                        @elseif($reservation->estado == 'recibido')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-green-200 text-green-800 rounded">
                            Ya se entregó
                        </span>
                        @elseif($reservation->estado == 'sin_recibir')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            No ha recibido el Producto
                        </span>
                        @elseif($reservation->estado == 'problemas')
                        <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                            El Vendedor tiene Problemas
                        </span>
                        @endif
                    </h2>
                    <p class="text-sm md:text-[1.5rem] text-gray-600 font-bold mb-[8px]">Total: ${{ $reservation->total }}</p>

                    @foreach ($reservation->items as $item)
                    <!-- INICIO DE CARTA -->
                    <<div class="my-2 p-4 border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                        <div class="flex items-center">
                            <img src="{{ asset('imgs/'. $item->product->imagen_referencia) }}" alt="{{  $item->product->imagen_referencia }}" class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                            <div>
                                <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                                    <span class="font-bold">{{ $item->product->name }}</span> en {{ $item->product->vendedor->nombre_del_local }}
                                </h2>
                                <p>
                                    <span class="texts-sm md:text-[1.25rem] text-gray-600 mb-[8px] font-semibold">Estado del Producto:</span>
                                    @if ($item->estado == 'enviado')
                                    <span class="px-2 uppercase w-fit py-0.5 md:py-[0.5rem] md:px-[0.5rem] text-s md:text-[16px] font-semibold bg-amber-300 text-white rounded">
                                        Enviado
                                    </span>
                                    @elseif($item->estado == 'sin_existencias')
                                    <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-red-200 text-red-800 rounded">
                                        No hay Existencias
                                        {{ $item->sin_existencias }}
                                    </span>
                                    @elseif($item->estado == 'sin_espera')
                                    <span class="px-1 uppercase py-0.5 text-s md:text-[1rem] font-semibold bg-red-200 text-red-800 rounded">
                                        Cancelado
                                    </span>
                                    @elseif($item->estado == 'en_espera')
                                    <span class="px-1 uppercase py-0.5 text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                                        Se está Esperando
                                    </span>
                                    @elseif($item->estado == 'en_entrega')
                                    <span class="px-1 uppercase py-0.5 text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800">
                                        Ya lo puede Recoger
                                    </span>
                                    @elseif($item->estado == 'recibido' || $item->estado == 'archivado')
                                    <span class="px-1 uppercase py-0.5 text-s md:text-[1rem] font-semibold bg-green-200 text-green-800 rounded">
                                        Ya lo Recibió
                                    </span>
                                    @elseif($item->estado == 'sin_recibir')
                                    <span class="px-1 uppercase py-0.5 text-s md:text-[1rem] font-semibold bg-orange-200 text-orange-800 rounded">
                                        No ha recibido el Producto
                                    </span>
                                    @elseif($item->estado == 'problemas')
                                    <span class="px-1 uppercase py-0.5 text-s md:text-[1rem] font-semiboldd bg-orange-200 text-orange-800 rounded">
                                        El Vendedor tiene Problemas
                                    </span>
                                    @endif
                                </p>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]"><b>Cantidad:</b> {{ $item->quantity }}</p>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]"><b>Precio (c/u):</b> ${{ $item->precio }}</p>
                                <p class="text-sm md:text-[1.5rem] text-gray-600 mb-[8px]"><b>Subtotal:</b> ${{ $item->subtotal }}</p>
                            </div>

                            @if ($item->estado == 'sin_existencias')
                            <h2 class="text-xl font-bold mb-4 text-center">Ahorita no hay existencias. ¿Esperará?</h2>
                            <form id="form-{{ $item->id }}" action="{{ route('usuarios.publicarestadoreserva', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">

                                <div class="flex justify-between">
                                    <button type="button" onclick="setEstado('{{ $item->id }}', 'en_espera')" class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Esperaré
                                    </button>

                                    <button type="button" onclick="setEstado('{{ $item->id }}', 'sin_espera')" class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        No Esperaré
                                    </button>
                                </div>
                            </form>
                            @elseif($item->estado == 'en_entrega')
                            <h2 class="text-xl font-bold mb-4 text-center">Ya se Envio su producto. <br> Lo puede recibir en: <b>El Porton Principal de TiendaKelly</b> <br> Ya lo Recibio?</h2>
                            <form id="form-{{ $item->id }}" action="{{ route('usuarios.publicarestadoreserva', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">

                                <div class="flex justify-between">
                                    <button type="button" onclick="setEstado('{{ $item->id }}', 'recibido')" class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Recibido
                                    </button>

                                    <button type="button" onclick="setEstado('{{ $item->id }}', 'sin_recibir')" class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        No lo he Recibido
                                    </button>
                                </div>
                            </form>
                            @elseif($item->estado == 'problemas')
                            <h2 class="text-xl font-bold mb-4 text-center">El Vendedor {{ $item->vendedor->nombre }} tiene problemas con su producto. ¿Desea Esperar?</h2>
                            <form id="form-{{ $item->id }}" action="{{ route('usuarios.publicarestadoreserva', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">

                                <div class="flex justify-between">
                                    <button type="button" onclick="setEstado('{{ $item->id }}', 'en_espera')" class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Voy a Esperar
                                    </button>

                                    <button type="button" onclick="setEstado('{{ $item->id }}', 'sin_espera')" class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        No voy a esperar
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

            <!-- FIN DE RESERVA -->
            @endif

            <script>
                function setEstado(itemId, estado) {
                    // Establecer el valor del estado en el input oculto
                    document.getElementById('estado-' + itemId).value = estado;

                    // Enviar el formulario
                    document.getElementById('form-' + itemId).submit();
                }
            </script>

            <!--FIN DE SEGMENTO DE RESERVA-->


        </div>
        </div>

    </main>
    <footer class="bg-[#292526] pb-16 pt-[5rem] bottom-0 relative ">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b>
                    <h2>Contact Us</h2>
                </b>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>
            </div>
            <div>

                <b>
                    <b>
                        <h2>Sobre nosotros</h2>
                    </b>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
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