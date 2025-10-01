<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Historial de Reservas - Tienda Kelly</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
    <style>
        .fadeInUp {
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 via-blue-50 to-white flex flex-col min-h-screen">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Contenido principal -->
    <main class="flex-1 max-w-7xl mx-auto p-4 mt-10 fadeInUp">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12 gradient-text">Historial de Reservas</h1>

        @if ($reservations->isEmpty())
        <div class="text-center text-gray-600 text-xl md:text-3xl mt-32">
            No hay historial todavía 😔
        </div>
        @elseif($reservations->every(fn($reservation) => $reservation->estado == 'archivado'))
        <div class="space-y-6">
            @foreach ($reservations as $reservation)
            @if ($reservation->estado == 'archivado')
            <div class="bg-white p-6 rounded-3xl shadow-lg card-hover fadeInUp space-y-4">

                <!-- Items -->
                <div class="space-y-4">
                    @foreach ($reservation->items as $item)
                    <div
                        class="flex flex-col md:flex-row items-center gap-4 p-4 bg-gray-50 rounded-xl shadow-sm card-hover">
                        <img src="{{ asset('imgs/'. $item->product->imagen_referencia) }}"
                            alt="{{ $item->product->name }}"
                            class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-md">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 md:text-lg">
                                {{ $item->product->name }} - {{ $item->product->vendedor->nombre_del_local }}
                            </h3>
                            <p class="text-gray-600 text-sm md:text-base"><b>Cantidad:</b> {{ $item->quantity }}</p>
                            <p class="text-gray-600 text-sm md:text-base"><b>Precio (c/u):</b> ${{ $item->precio }}</p>
                            <p class="text-gray-600 text-sm md:text-base"><b>Subtotal:</b> ${{ $item->subtotal }}</p>
                            <p class="mt-1">
                                <span class="px-2 py-1 rounded font-semibold bg-gray-500 text-white">
                                    Archivado
                                </span>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Total y recibo -->
                <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <p class="text-gray-700 font-semibold md:text-lg">Total: ${{ $reservation->total }}</p>
                    <a href="{{ route('viewReceipt', $reservation->id) }}" target="_blank"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-2xl transition transform btn-hover text-center">
                        Ver Recibo
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </main>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>
