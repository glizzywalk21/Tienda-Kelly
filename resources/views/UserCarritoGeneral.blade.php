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
        </div>
    </main>
    <footer class="bg-[#292526] pb-16">
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

            <!-- Columna derecha: total y reserva con mini-resumen -->
            <div class="space-y-6">
                <div
                    class="bg-gradient-to-br from-white to-blue-50 shadow-2xl rounded-3xl p-6 flex flex-col items-center card-hover">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Total: ${{ $total }}</h2>

                    <!-- Mini resumen de productos -->
                    <div class="flex flex-col gap-3 w-full mb-6">
                        @foreach ($cartItems as $cartItem)
                        <div class="flex items-center justify-between bg-white rounded-xl p-2 shadow">
                            <img src="{{ asset('imgs/' . $cartItem->product->imagen_referencia) }}"
                                alt="{{ $cartItem->product->name }}"
                                class="w-12 h-12 object-cover rounded-md">
                            <div class="flex-1 mx-2">
                                <p class="text-gray-800 font-semibold text-sm">{{ $cartItem->product->name }}</p>
                                <p class="text-gray-600 text-xs">x{{ $cartItem->quantity }}</p>
                            </div>
                            <p class="text-gray-800 font-bold text-sm">${{ $cartItem->product->price * $cartItem->quantity }}</p>
                        </div>
                        @endforeach
                    </div>

                    <!-- Botón de reserva -->
                    <form action="{{ route('usuarios.reservar') }}" method="POST" class="w-full text-center">
                        @csrf
                        @if ($cartItems->isEmpty() || $total < 5)
                        <button type="button"
                            class="bg-gray-400 text-white font-semibold px-8 py-3 rounded-2xl cursor-not-allowed">
                            Guardar Reserva
                        </button>
                        @if ($total < 5)
                        <p class="mt-4 text-gray-600 text-center">
                            Pedido mínimo $5. Faltan ${{ 5 - $total }} para reservar.
                        </p>
                        @endif
                        @else
                        <button type="submit"
                            class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-semibold px-8 py-3 rounded-2xl transition transform btn-hover">
                            Guardar Reserva
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="mt-auto">
        @include('components.footer')
    </footer>

</body>
</html>