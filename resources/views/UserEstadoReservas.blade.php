<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos - Tienda Kelly</title>
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

        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 via-blue-50 to-white flex flex-col min-h-screen">

    @include('components.navbar')

    <main class="flex-1 max-w-7xl mx-auto p-4 mt-10 fadeInUp">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12 gradient-text">Mis Reservas</h1>

        @php
            $visibleReservations = $reservations->filter(fn($reservation) => $reservation->items->where('estado', '!=', 'archivado')->isNotEmpty());
        @endphp

        @if ($visibleReservations->isEmpty())
            <div class="text-center text-gray-700 text-xl md:text-3xl mt-32">
                No hay Reservas Todavía 😔
            </div>
        @else
            <div class="space-y-8">
                @foreach ($visibleReservations as $reservation)
                    <div class="bg-white rounded-3xl shadow-lg card-hover fadeInUp overflow-hidden">

                        {{-- Header de la reserva --}}
                        <div class="p-6 md:flex md:justify-between md:items-center bg-gray-100">
                            <div class="mb-4 md:mb-0">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-900">Reserva #{{ $reservation->id }}</h2>
                                <p class="text-gray-700 md:text-lg">
                                    Pedido por: <span class="font-semibold">{{ $reservation->user->nombre }} {{ $reservation->user->apellido }}</span>
                                </p>
                            </div>
                            <p class="text-gray-900 font-bold text-lg md:text-xl">Total: ${{ $reservation->total }}</p>
                        </div>

                        {{-- Items --}}
                        <div class="p-6 space-y-4 md:space-y-6">
                            @foreach ($reservation->items->where('estado', '!=', 'archivado') as $item)
                                <div class="flex flex-col md:flex-row items-center gap-4 p-4 bg-gray-100 rounded-xl shadow-sm card-hover">
                                    <img src="{{ asset('imgs/'. $item->product->imagen_referencia) }}" alt="{{ $item->product->name }}"
                                        class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-md">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 md:text-lg">{{ $item->product->name }} - {{ $item->product->vendedor->nombre_del_local }}</h3>
                                        <p class="text-gray-700 text-sm md:text-base"><b>Cantidad:</b> {{ $item->quantity }}</p>
                                        <p class="text-gray-700 text-sm md:text-base"><b>Precio (c/u):</b> ${{ $item->precio }}</p>
                                        <p class="text-gray-700 text-sm md:text-base"><b>Subtotal:</b> ${{ $item->subtotal }}</p>

                                        {{-- Estado y botón --}}
                                        @if($item->estado == 'en_entrega')
                                            <div class="flex items-center gap-4 mt-2">
                                                <span class="px-2 py-1 rounded font-semibold bg-orange-200 text-orange-800">
                                                    En entrega
                                                </span>
                                                <form action="{{ route('usuarios.publicarestadoreserva', $item->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="estado" value="recibido">
                                                    <button type="submit"
                                                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-2xl transition transform btn-hover">
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

    @include('components.footer')

                </div>
            </div>
        </div>
    </footer>
                <div id="successModal"
    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 transition-opacity duration-300 hidden">
    
    <!-- Aquí se aplica la clase custom para la animación -->
    <div class="bg-white rounded-2xl shadow-2xl p-6 w-11/12 max-w-md relative modal-content-animation">
        
        <!-- Botón de Cierre -->
        <button id="closeSuccessModalBtn"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition duration-150 p-2 rounded-full hover:bg-gray-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>

        <div class="flex items-center space-x-4 mb-4">
            <!-- Icono de Éxito (Checkmark) -->
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">¡Operación Exitosa!</h2>
        </div>

        <!-- Contenido del Mensaje -->
        <p id="modalMessageContent" class="text-gray-600 mb-6 leading-relaxed">
            <!-- El mensaje de éxito se insertará aquí con JavaScript -->
        </p>

        <div class="flex justify-end">
            <button id="okBtn"
                class="px-6 py-2 bg-green-500 text-white font-medium rounded-xl hover:bg-green-600 transition duration-200 shadow-md">
                Aceptar
            </button>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const successModal = document.getElementById('successModal');
        const modalMessageContent = document.getElementById('modalMessageContent');
        const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
        const okBtn = document.getElementById('okBtn');
        const messageToDisplay = <?php echo json_encode(session('success') ? session('success') : null); ?>;
        
        function closeSuccessModal() {
            if (successModal) {
                successModal.classList.add('hidden');
            }
        }
        if (closeSuccessModalBtn) {
            closeSuccessModalBtn.addEventListener('click', closeSuccessModal);
        }
        if (okBtn) {
            okBtn.addEventListener('click', closeSuccessModal);
        }
        
        // Cierra al hacer click fuera del contenido
        if (successModal) {
            successModal.addEventListener('click', (event) => {
                if (event.target === successModal) {
                    closeSuccessModal();
                }
            });
        }
        if (messageToDisplay !== null) {
            if (successModal && modalMessageContent) {
                modalMessageContent.textContent = messageToDisplay;
                successModal.classList.remove('hidden'); // Muestra el modal
            }
        }
    });
</script>

</body>

</html>
