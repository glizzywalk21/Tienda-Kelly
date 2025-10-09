<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Mi Carrito - Tienda Kelly</title>
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

        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }


        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .payment-container {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            margin-top: 20px;
            background-color: #fefefe;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #3b82f6;
            outline: none;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 via-blue-50 to-white flex flex-col min-h-screen">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Contenido principal -->
    <main class="flex-1 max-w-7xl mx-auto p-4 mt-10 fadeInUp">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12 gradient-text">Mi Carrito</h1>

        @if (session('success'))
        <div class="bg-emerald-600 w-full md:w-1/2 mx-auto text-white font-semibold p-4 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
        @endif

        @if ($cartItems->isEmpty())
        <div class="text-center text-gray-500 text-xl md:text-3xl mt-32">
            Tu carrito está vacío 😔
        </div>
        @else
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Columna izquierda: productos -->
            <div class="md:col-span-2 space-y-6">
                @foreach ($cartItems as $cartItem)
                <div
                    class="bg-gradient-to-br from-white to-blue-50 shadow-lg rounded-3xl p-6 flex flex-col md:flex-row items-center gap-6 card-hover fadeInUp">
                    <img src="{{ asset('imgs/' . $cartItem->product->imagen_referencia) }}"
                        alt="{{ $cartItem->product->name }}"
                        class="w-full md:w-44 h-44 object-cover rounded-2xl shadow-md">

                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $cartItem->product->name }}</h2>
                        <p class="text-gray-600 text-lg mb-1">Precio: ${{ $cartItem->product->price }} c/u</p>
                        <p class="text-gray-700 text-lg font-semibold">Cantidad: {{ $cartItem->quantity }}</p>
                        @if ($cartItem->talla >= 34 || $cartItem->talla == 45)
                        <p class="text-gray-800 font-bold mt-2">Talla:
                            {{ $cartItem->talla}}
                        </p>
                        @endif
                        <p class="text-gray-800 font-bold mt-2">Subtotal: ${{ $cartItem->product->price * $cartItem->quantity }}</p>
                    </div>

                    <div>
                        <form action="{{ route('usuarios.eliminarcarrito', $cartItem->fk_product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-3 rounded-2xl transition transform btn-hover">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Columna derecha: total y reserva con mini-resumen y PAGO -->
            <div class="space-y-6">
                <div
                    class="bg-gradient-to-br from-white to-blue-50 shadow-2xl rounded-3xl p-6 flex flex-col items-center card-hover">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Total: <span id="cart-total-display">${{ number_format($total, 2) }}</span></h2>

                    <!-- Mini resumen de productos -->
                    <div class="flex flex-col gap-3 w-full mb-6">
                        @foreach ($cartItems as $cartItem)
                        <div class="flex items-center justify-between bg-white rounded-xl p-2 shadow">
                            <img src="{{ asset('imgs/' . $cartItem->product->imagen_referencia) }}"
                                alt="{{ $cartItem->product->name }}" class="w-12 h-12 object-cover rounded-md">
                            <div class="flex-1 mx-2">
                                <p class="text-gray-800 font-semibold text-sm">{{ $cartItem->product->name }}</p>
                                <p class="text-gray-600 text-xs">x{{ $cartItem->quantity }}</p>
                            </div>
                            <p class="text-gray-800 font-bold text-sm">${{ $cartItem->product->price * $cartItem->quantity }}</p>
                        </div>
                        @endforeach
                    </div>
                    <form id="form-reserva-wrapper" action="{{ route('usuarios.reservar') }}" method="POST" class="w-full text-center mb-4" style="display: none;">
                        @csrf
                        @if ($cartItems->isEmpty() || $total < 5)
                        <button type="button"
                            class="w-full bg-gray-400 text-white font-semibold px-8 py-3 rounded-2xl cursor-not-allowed">
                            Guardar Reserva
                        </button>
                        @if ($total < 5)
                        <p class="mt-4 text-gray-600 text-center">
                            Pedido mínimo $5. Faltan ${{ 5 - $total }} para reservar.
                        </p>
                        @endif
                        @else
                        <!-- El botón debe tener este ID para ser encontrado por JS -->
                        <button type="submit" id="btn-guardar-reserva"
                            class="w-full bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-semibold px-8 py-3 rounded-2xl transition transform btn-hover">
                            Guardar Reserva
                        </button>
                        @endif
                    </form>
                    <!-- Bloque de Pago Total -->
                    <div class="payment-container w-full" id="payment-container">

                        <!-- Botón para Iniciar Pago (Usa number_format) -->
                        <button id="btn-pagar-total" class="w-full btn-hover"
                            style="background-color: #10b981; color: white; padding: 12px 15px; border: none; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 1.1em;">
                            Pagar Ahora ${{ number_format($total, 2) }}
                        </button>

                        <!-- Formulario de Pago (Oculto) -->
                        <div id="formulario-pago-total"
                            style="display: none; margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ddd;">

                            <h5 style="font-weight: bold; margin-bottom: 10px; color: #374151;">Datos de la Tarjeta
                                (Simulación)</h5>

                            <form id="form-tarjeta-total" class="pago-form">
                                @csrf
                                <input type="hidden" name="total" value="{{ $total }}">

                                <label style="display: block; font-size: 0.9em; color: #4b5563;">Nombre Completo en
                                    Tarjeta</label>
                                <input type="text" placeholder="Nombre Completo" required class="form-input">

                                <label style="display: block; font-size: 0.9em; color: #4b5563;">No. Tarjeta</label>
                                <input type="text" placeholder="xxxx xxxx xxxx xxxx" required pattern="[0-9 ]{13,19}"
                                    class="form-input">

                                <div style="display: flex; gap: 10px;">
                                    <div style="flex: 1;">
                                        <label style="display: block; font-size: 0.9em; color: #4b5563;">Vencimiento
                                            (MM/AA)</label>
                                        <input type="text" placeholder="MM/AA" required pattern="(0[1-9]|1[0-2])\/\d{2}"
                                            class="form-input">
                                    </div>
                                    <div style="flex: 1;">
                                        <label style="display: block; font-size: 0.9em; color: #4b5563;">CVV</label>
                                        <input type="text" placeholder="xxx" required pattern="\d{3,4}"
                                            class="form-input">
                                    </div>
                                </div>

                                <button type="submit" class="w-full btn-hover"
                                    style="background-color: #059669; color: white; padding: 12px 15px; border: none; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 1.1em; margin-top: 5px;">
                                    Confirmar Pago ${{ number_format($total, 2) }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif 
    </main> 

    <!-- Footer: Tu código de footer explícito -->
    <footer class="bg-[#292526] pb-16 mt-auto w-full">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
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
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales,
                    brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
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


    <!-- Estructura del Modal de Éxito -->
    <div id="successModal"
        class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 transition-opacity duration-300 hidden">

        <div class="bg-white rounded-2xl shadow-2xl p-6 w-11/12 max-w-md relative modal-content-animation">

            <button id="closeSuccessModalBtn"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition duration-150 p-2 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="flex items-center space-x-4 mb-4">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800">¡Operación Exitosa!</h2>
            </div>

            <p id="modalMessageContent" class="text-gray-600 mb-6 leading-relaxed"></p>

            <div class="flex justify-end">
                <button id="okBtn"
                    class="px-6 py-2 bg-green-500 text-white font-medium rounded-xl hover:bg-green-600 transition duration-200 shadow-md">
                    Aceptar
                </button>
            </div>
        </div>
    </div>


    <script>
        // --- LÓGICA DE MODAL ---
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

        function showSuccessModal(message) {
            if (successModal && modalMessageContent) {
                modalMessageContent.textContent = message;
                successModal.classList.remove('hidden');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            // Inicialización del modal
            if (closeSuccessModalBtn) {
                closeSuccessModalBtn.addEventListener('click', closeSuccessModal);
            }
            if (okBtn) {
                okBtn.addEventListener('click', closeSuccessModal);
            }
            if (successModal) {
                successModal.addEventListener('click', (event) => {
                    if (event.target === successModal) {
                        closeSuccessModal();
                    }
                });
            }
            if (messageToDisplay !== null) {
                showSuccessModal(messageToDisplay);
            }

            // --- Lógica de Pago por Tarjeta (Simulación) ---
            const btnPagarTotal = document.getElementById('btn-pagar-total');
            const formPagoTotal = document.getElementById('formulario-pago-total');
            const formTarjetaTotal = document.getElementById('form-tarjeta-total');
            const cartTotalDisplay = document.getElementById('cart-total-display');
            const paymentContainer = document.getElementById('payment-container');
            const formReservaWrapper = document.getElementById('form-reserva-wrapper');


            if (btnPagarTotal && formPagoTotal && formTarjetaTotal && paymentContainer) {
                // El listener para el botón "Pagar Ahora"
                btnPagarTotal.addEventListener('click', function() {
                    btnPagarTotal.style.display = 'none'; // Oculta el botón 'Pagar Ahora'
                    formPagoTotal.style.display = 'block'; // Muestra el formulario de la tarjeta

                    // Ocultar el contenedor completo del botón "Guardar Reserva". 
                    if (formReservaWrapper) {
                        formReservaWrapper.style.display = 'none';
                    }
                });

                // 2. Formulario Submit -> Simula el Pago y Muestra Éxito
                formTarjetaTotal.addEventListener('submit', function(e) {
                    e.preventDefault();

                    formPagoTotal.style.display = 'none';

                    const totalMonto = cartTotalDisplay ? cartTotalDisplay.textContent : '$XX.XX';

                    showSuccessModal(`¡Pago de ${totalMonto} exitoso! Tu compra ha sido confirmada y se está procesando.`);

                    paymentContainer.innerHTML = '<div style="text-align: center; background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; font-weight: bold;">¡Pago Completado! Gracias por tu compra.</div>';

                    if (formReservaWrapper) {
                        formReservaWrapper.style.display = 'block';
                    }
                });
            }
        });
    </script>
</body>
</html>