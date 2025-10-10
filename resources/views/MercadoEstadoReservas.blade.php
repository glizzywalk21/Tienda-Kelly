<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos - Tienda Kelly</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('components.navbar-mercado')

    <main class="flex-1 p-4 md:max-w-6xl mx-auto mt-10">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12 gradient-text">
            Todas las Reservas
        </h1>

        @php
            $visibleReservations = $reservations->filter(fn($reservation) => $reservation->items->where('estado', '!=', 'archivado')->isNotEmpty());
        @endphp

        @if ($visibleReservations->isEmpty())
            <div class="text-center text-gray-500 text-xl md:text-3xl mt-32">
                No hay Reservas Todavía 😔
            </div>
        @else
            <div class="space-y-8">
                @foreach ($visibleReservations as $reservation)
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        
                        {{-- Header de la reserva --}}
                        <div class="p-6 md:flex md:justify-between md:items-center bg-gradient-to-r from-red-100 to-pink-50">
                            <div class="mb-4 md:mb-0">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Reserva #{{ $reservation->id }}</h2>
                                <p class="text-gray-600 md:text-lg">
                                    Pedido por: <span class="font-semibold">{{ $reservation->user->nombre }} {{ $reservation->user->apellido }}</span>
                                </p>
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $reservation->estado == 'enviado' ? 'bg-amber-300 text-white' : '' }}
                                    {{ $reservation->estado == 'en_entrega' ? 'bg-orange-200 text-orange-800' : '' }}
                                    {{ $reservation->estado == 'recibido' ? 'bg-green-200 text-green-800' : '' }}
                                    {{ $reservation->estado == 'archivado' ? 'bg-gray-500 text-white' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $reservation->estado)) }}
                                </span>
                                <p class="text-gray-700 font-bold text-lg md:text-xl">Total: ${{ $reservation->total }}</p>
                            </div>
                        </div>

                        {{-- Items de la reserva --}}
                        <div class="p-6 space-y-4 md:space-y-6">
                            @foreach ($reservation->items->where('estado', '!=', 'archivado') as $item)
                                <div class="flex flex-col md:flex-row items-center gap-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                                    <img src="{{ asset('imgs/' . $item->product->imagen_referencia) }}"
                                        alt="{{ $item->product->name }}"
                                        class="w-20 h-20 md:w-32 md:h-32 object-cover rounded-md">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 md:text-lg">
                                            {{ $item->product->name }} <span class="text-gray-500">de {{ $item->product->vendedor->nombre_del_local }}</span>
                                        </h3>
                                        <p class="text-gray-600 text-sm md:text-base"><b>Cantidad:</b> {{ $item->quantity }}</p>
                                        <p class="text-gray-600 text-sm md:text-base"><b>Precio (c/u):</b> ${{ $item->precio }}</p>
                                        <p class="text-gray-600 text-sm md:text-base"><b>Subtotal:</b> ${{ $item->subtotal }}</p>

                                        {{-- Estado y acción --}}
                                        @if($item->estado == 'en_entrega')
                                            <div class="flex items-center gap-3 mt-2">
                                                <span class="px-2 py-1 rounded font-semibold bg-orange-200 text-orange-800">
                                                    En entrega
                                                </span>
                                                <form action="{{ route('usuarios.publicarestadoreserva', $item->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="estado" value="recibido">
                                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-2xl transition transform hover:scale-105">
                                                        Confirmar Recepción
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="px-2 py-1 rounded font-semibold 
                                                {{ $item->estado == 'enviado' ? 'bg-amber-300 text-white' : '' }}
                                                {{ $item->estado == 'recibido' ? 'bg-green-200 text-green-800' : '' }}
                                                {{ $item->estado == 'sin_existencias' ? 'bg-red-200 text-red-800' : '' }}
                                                {{ $item->estado == 'en_espera' ? 'bg-orange-200 text-orange-800' : '' }}">
                                                {{ ucfirst(str_replace('_', ' ', $item->estado)) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    {{-- Footer --}}
    @include('components.footer')

</body>
</html>
