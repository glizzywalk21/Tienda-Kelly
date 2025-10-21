<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $product->name }} - Tienda Kelly</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
    <style>
        /* Animaciones */
        .fadeInUp {
            animation: fadeInUp 1s ease forwards;
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

        /* Botones hover */
        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }

        /* Gradiente en títulos */
        .gradient-text {
            background: linear-gradient(90deg, #6366f1, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Tarjetas */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover img {
            transform: scale(1.05);
        }

        .shadow-inner {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white overflow-x-hidden">

    <!-- Navbar reutilizable -->
    @include('components.navbar')

    <!-- Sección del Producto -->
    <section class="max-w-7xl mx-auto mt-12 px-4 md:px-0 grid grid-cols-1 md:grid-cols-2 gap-12 items-start fadeInUp">

        <!-- Imagen del producto -->
        <div class="relative">
            <img class="rounded-2xl w-full shadow-xl transform transition duration-700 hover:scale-105"
                src="{{ asset('images/' . $product->imagen_referencia) }}" alt="{{ $product->name }}">
        </div>

        <!-- ESTRELLAS (opcional) -->
        <!--
        <div class="flex items-center mb-4">
            <img class="w-6 mr-2" src="{{ asset('images/775819.svg') }}" alt="Rating Icon">
            <img class="w-6 mr-2" src="{{ asset('images/775819.svg') }}" alt="Rating Icon">
            <img class="w-6 mr-2" src="{{ asset('images/775819.svg') }}" alt="Rating Icon">
            <img class="w-6 mr-2" src="{{ asset('images/775819.svg') }}" alt="Rating Icon">
            <img class="w-6 mr-2" src="{{ asset('images/775819.svg') }}" alt="Rating Icon">
            <span class="text-lg text-gray-800">5.0</span>
        </div>
        -->

        <!-- Información y carrito -->
        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-inner">

            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 gradient-text">
                {{ $product->name }}
            </h1>

            <p class="text-gray-600 mb-6">{{ $product->description }}</p>

            <!-- FORMULARIO Add to Cart -->
            <form action="{{ route('usuarios.addcarrito', $product) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Cantidad -->
                <div class="flex items-center gap-4">
                    <span class="font-semibold text-gray-800">Cantidad:</span>
                    <div class="flex items-center gap-2">
                        <button type="button" aria-label="Disminuir cantidad"
                            class="bg-gray-200 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700"
                            onclick="decrement()">-</button>

                        <!-- Un solo input, dentro del form, para que se envíe correctamente -->
                        <input id="quantity" name="quantity" type="number" value="1" readonly
                            class="w-12 h-8 text-center border border-gray-400 rounded">

                        <button type="button" aria-label="Aumentar cantidad"
                            class="bg-gray-200 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700"
                            onclick="increment()">+</button>
                    </div>
                </div>

                <!-- Precio -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Precio</h2>
                    <p class="text-2xl font-bold text-gray-900">${{ $product->price }}</p>
                </div>

                <!-- Tallas (si aplica) -->
                @if ($product->fk_vendedors == '4')
                    <div class="space-y-2">
                        <span class="font-semibold text-gray-800">Seleccione su talla:</span>
                        <div class="grid grid-cols-6 gap-2">
                            @foreach ([34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45] as $talla)
                                <label class="cursor-pointer">
                                    <input type="radio" name="talla" value="{{ $talla }}" class="hidden peer" required>
                                    <div
                                        class="px-4 py-2 border rounded-lg text-center
                                                                        peer-checked:bg-gray-300 peer-checked:text-black hover:bg-gray-200">
                                        {{ $talla }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Acciones -->
                <div class="flex items-center justify-between gap-4 pt-2">

                    <!-- Botón Agregar al carrito (dentro del form) -->
                    <button type="submit"
                        class="btn-hover w-full md:w-96 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-bold py-3 rounded-xl shadow-lg transition transform">
                        Agregar al carrito
                    </button>

                    <!-- Botón Regresar con efecto GLASS -->
                    <div class="relative inline-block">
                        <!-- Fondo local para que el blur se note dentro de la tarjeta blanca -->
                        <div
                            class="absolute -inset-3 -z-10 rounded-3xl
                                    bg-[radial-gradient(120%_120%_at_0%_0%,rgba(147,197,253,0.45)_0%,transparent_60%),radial-gradient(120%_120%_at_100%_100%,rgba(196,181,253,0.45)_0%,transparent_60%)]">
                        </div>

                        <button type="button" onclick="history.back()" aria-label="Regresar a la página anterior" class="group relative inline-flex items-center gap-2 rounded-2xl px-4 py-2
                                       text-sm font-semibold text-black
                                       bg-white/25 hover:bg-white/30 active:bg-white/35
                                       backdrop-blur-2xl backdrop-saturate-150
                                       border border-white/50 ring-1 ring-black/5
                                       shadow-[inset_0_1px_0_rgba(255,255,255,0.65),0_8px_22px_rgba(0,0,0,0.12)]
                                       transition-all duration-300 active:scale-[0.98]
                                       focus:outline-none focus-visible:ring-2 focus-visible:ring-black/20">

                            <!-- highlight / brillo -->
                            <span class="pointer-events-none absolute inset-0 rounded-2xl
                                         before:content-[''] before:absolute before:inset-0 before:rounded-2xl
                                         before:bg-gradient-to-b before:from-white/70 before:to-white/15 before:opacity-60
                                         after:content-[''] after:absolute after:inset-x-2 after:top-0 after:h-px
                                         after:bg-white/80 after:rounded-full">
                            </span>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5"
                                class="w-5 h-5 shrink-0 text-black/90 transition-transform duration-300 group-hover:-translate-x-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                            <span class="relative z-10">Regresar</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <!-- Productos Recomendados -->
    <section class="max-w-7xl mx-auto mt-20 px-4 fadeInUp mb-10">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 gradient-text">Productos Recomendados</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $item)
                <a href="{{ route('usuarios.producto', $item->id) }}"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover transform transition duration-300">
                    <img class="w-full h-64 object-cover rounded-t-2xl"
                        src="{{ asset('images/' . $item->imagen_referencia) }}" alt="{{ $item->name }}">
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800">{{ $item->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ $item->vendedor->nombre_del_local }}</p>
                        <p class="text-indigo-600 font-semibold">${{ $item->price }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Scripts para cantidad -->
    <script>
        const inputQty = document.getElementById('quantity');

        function decrement() {
            let value = parseInt(inputQty.value, 10);
            if (value > 1) value--;
            inputQty.value = value;
        }
        function increment() {
            let value = parseInt(inputQty.value, 10);
            inputQty.value = value + 1;
        }
    </script>

    <!-- Incluir Footer -->
    @include('components.footer')
</body>

</html>