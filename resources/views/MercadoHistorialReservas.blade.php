<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Archivos de Reservas - Tienda Kelly</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('components.navbar-mercado')

    <main class="flex-1 p-4 md:max-w-6xl mx-auto mt-10">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12 gradient-text">
            Todos los Archivos
        </h1>

        @php
            $archivedReservations = $reservations->filter(fn($reservation) => $reservation->estado == 'archivado');
        @endphp

        @if ($archivedReservations->isEmpty())
            <div class="text-center text-gray-500 text-xl md:text-3xl mt-32">
                No hay Reservas Archivadas 😔
            </div>
        @else
            <div class="space-y-8">
                @foreach ($archivedReservations as $reservation)
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        
                        {{-- Header de la reserva --}}
                        <div class="p-6 md:flex md:justify-between md:items-center bg-gradient-to-r from-gray-200 to-gray-100">
                            <div class="mb-4 md:mb-0">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Reserva #{{ $reservation->id }}</h2>
                                <p class="text-gray-600 md:text-lg">
                                    Pedido por: <span class="font-semibold">{{ $reservation->user->nombre }} {{ $reservation->user->apellido }}</span>
                                </p>
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-500 text-white">
                                    Archivado
                                </span>
                                <p class="text-gray-700 font-bold text-lg md:text-xl">Total: ${{ $reservation->total }}</p>
                            </div>
                        </div>

                        {{-- Items de la reserva --}}
                        <div class="p-6 space-y-4 md:space-y-6">
                            @foreach ($reservation->items as $item)
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

                                        <span class="px-2 py-1 rounded font-semibold bg-gray-400 text-white mt-2 inline-block">
                                            {{ ucfirst(str_replace('_', ' ', $item->estado)) }}
                                        </span>
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
