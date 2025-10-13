<!DOCTYPE html>
<html lang="es" class="scroll-smooth antialiased">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Tienda Kelly — Panel Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon" />
</head>

<body class="bg-gradient-to-b from-slate-50 to-white text-slate-900">
    <!-- ===== Desktop Navbar ===== -->
    <header
        class="hidden md:flex px-6 lg:px-10 py-4 bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/70 items-center justify-between shadow-sm sticky top-0 z-50 border-b border-slate-100">
        <a href="{{ route('vendedores.index') }}" class="group inline-flex items-center gap-2">
            <img src="{{ asset('imgs/shop.png') }}" alt="Logo Tienda Kelly" class="w-8 h-8" />
            <h1 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                Tienda Kelly <span
                    class="text-indigo-600 group-hover:text-indigo-700 transition-colors">Vendedores</span>
            </h1>
        </a>
        <nav class="flex gap-2 lg:gap-4">
            <a href="{{ route('vendedores.index') }}"
                class="px-3 py-2 rounded-xl font-medium uppercase text-xs tracking-wide hover:text-indigo-700 hover:bg-indigo-50 transition">Mi
                Puesto</a>
            <a href="{{ route('vendedores.productos') }}"
                class="px-3 py-2 rounded-xl font-medium uppercase text-xs tracking-wide hover:text-indigo-700 hover:bg-indigo-50 transition">Mis
                Productos</a>
            <a href="{{ route('vendedores.reservas') }}"
                class="px-3 py-2 rounded-xl font-medium uppercase text-xs tracking-wide hover:text-indigo-700 hover:bg-indigo-50 transition">Mis
                Reservas</a>
            <a href="{{ route('vendedores.historial') }}"
                class="px-3 py-2 rounded-xl font-medium uppercase text-xs tracking-wide hover:text-indigo-700 hover:bg-indigo-50 transition">Mi
                Historial</a>
            <a href="{{ route('vendedor.perfil') }}"
                class="px-3 py-2 rounded-xl font-semibold uppercase text-xs tracking-wide border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white transition">Perfil</a>
        </nav>
    </header>

    <!-- ===== Mobile Bottom Bar ===== -->
    <nav aria-label="Navegación móvil" class="fixed bottom-4 left-0 right-0 md:hidden flex justify-center z-50">
        <div class="bg-slate-900/95 backdrop-blur rounded-2xl w-[19rem] h-14 flex justify-around px-2 shadow-2xl">
            <a href="{{ route('vendedores.index') }}" class="grid place-items-center w-12" aria-label="Inicio">
                <img class="w-6" src="{{ asset('imgs/vendedor.home.png') }}" alt="Inicio" />
            </a>
            <a href="{{ route('vendedores.productos') }}" class="grid place-items-center w-12"
                aria-label="Mis Productos">
                <img class="w-6" src="{{ asset('imgs/vendedor.productos.png') }}" alt="Productos" />
            </a>
            <a href="{{ route('vendedores.reservas') }}" class="grid place-items-center w-12" aria-label="Mis Reservas">
                <img class="w-6" src="{{ asset('imgs/vendedor.reservas.png') }}" alt="Reservas" />
            </a>
            <a href="{{ route('vendedores.historial') }}" class="grid place-items-center w-12" aria-label="Historial">
                <img class="w-6" src="{{ asset('imgs/mercado.historial.blancopng.png') }}" alt="Historial" />
            </a>
            <a href="{{ route('vendedor.perfil') }}" class="grid place-items-center w-12" aria-label="Perfil">
                <img class="w-6" src="{{ asset('imgs/vendedor.perfil.png') }}" alt="Perfil" />
            </a>
        </div>
    </nav>

    <!-- ===== Header / Saludo del Vendedor ===== -->
    <header class="mt-10 px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="space-y-2 animate-fadeInUp">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold">
                ¡Hola, <span class="text-indigo-700">{{ $vendedor->nombre }}</span>! 👋
            </h1>
            <h3 class="text-indigo-600 font-semibold text-lg md:text-xl lg:text-2xl delay-200">
                Bienvenido de nuevo a <span class="font-bold">Tienda Kelly</span>
            </h3>
        </div>

        <div class="animate-fadeInUp delay-400">
            <img class="rounded-full w-20 h-20 md:w-24 md:h-24 border-4 border-indigo-500 shadow-lg object-cover"
                src="{{ asset('imgs/' . ($vendedor->imagen_de_referencia ?? 'non-img.png')) }}"
                alt="Foto de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}">
        </div>
    </header>

    <!-- ===== Tarjeta de Perfil del Puesto ===== -->
    <section class="px-6 lg:px-10 mt-10 ">
        <div class="max-w-7xl mx-auto shadow-lg">
            <div
                class="grid lg:grid-cols-[1fr,auto] gap-6 lg:gap-10 items-center bg-white rounded-3xl p-6 md:p-8 shadow-sm ring-1 ring-slate-200/60">
                <div class="space-y-2">
                    <h3 class="text-2xl md:text-3xl font-bold">{{ $vendedor->nombre_del_local }}</h3>
                    <p class="text-slate-600">Propietario: <span
                            class="font-medium text-slate-800">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</span>
                    </p>
                    <p class="text-slate-600">Puesto #{{ $vendedor->numero_puesto }} — <span
                            class="font-medium text-slate-800">en {{ $mercadoLocal->nombre }}</span></p>
                    <p class="text-slate-600">Correo electrónico: <span
                            class="font-medium text-slate-800">{{ $vendedor->usuario }}</span></p>
                </div>
                <!-- Imagen del vendedor: avatar en móvil, banner en escritorio -->
                <div class="w-full md:w-auto">
                    <!-- Avatar (solo móvil) -->
                    <img
                        class="md:hidden rounded-full w-24 h-24 border-4 border-indigo-500 shadow-lg object-cover mx-auto mb-4"
                        src="{{ asset('imgs/' . ($vendedor->imagen_de_referencia ?? 'non-img.png')) }}"
                        alt="Foto de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}">

                    <!-- Banner (solo desktop) -->
                    <img
                        class="hidden md:block w-full md:w-[52rem] md:h-[25rem] object-cover object-center rounded-3xl shadow-lg ring-1 ring-slate-200/60"
                        src="{{ asset('imgs/' . ($vendedor->imagen_de_referencia ?? 'non-img.png')) }}"
                        alt="Banner de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA Agregar Producto ===== -->
    <section class="px-6 lg:px-10 mt-10 justify-center flex">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}"
                class="group w-full md:w-auto inline-flex items-center justify-center gap-3 bg-indigo-700 hover:bg-indigo-600 text-white font-bold uppercase tracking-wide rounded-2xl px-6 py-3 transition-transform duration-200 hover:scale-[1.02] shadow">
                <img class="w-6 h-6" src="{{ asset('imgs/AddIcon.png') }}" alt="Agregar" />
                <span>Agregar productos</span>
            </a>
        </div>
    </section>

    <!-- ===== Listado de Productos ===== -->
    <section class="px-6 lg:px-10 mt-8 mb-20">
        <div class="max-w-7xl mx-auto">
            @if ($products->isEmpty())
                <div class="grid place-items-center py-24 bg-white rounded-3xl ring-1 ring-slate-200/60">
                    <p class="text-xl md:text-2xl font-semibold text-slate-500">No hay productos en venta aún</p>
                    <p class="text-slate-400 mt-1">Agrega tu primer producto para empezar a vender.</p>
                </div>
            @else
                <div class="flex items-baseline justify-between mb-4">
                    <h4 class="text-xl font-semibold">Mis productos</h4>
                    <p class="text-sm text-slate-500">{{ $products->count() }} en total</p>
                </div>
                <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <li>
                            <a href="{{ route('vendedores.verproducto', $product->id) }}"
                                class="group block bg-white rounded-2xl overflow-hidden ring-1 ring-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                                <div class="relative">
                                    <img src="{{ asset('imgs/' . $product->imagen_referencia) }}" alt="{{ $product->name }}"
                                        class="w-full h-56 object-cover group-hover:scale-[1.02] transition-transform duration-300" />
                                </div>
                                <div class="p-4">
                                    <h5 class="font-bold text-lg leading-tight line-clamp-1">{{ $product->name }}</h5>
                                    <p class="text-indigo-700 font-semibold mt-1">${{ number_format($product->price, 2) }}</p>
                                    <p class="text-sm text-slate-600 mt-2 line-clamp-2">{{ $product->description }}</p>
                                    <div class="mt-3 flex items-center justify-between text-xs text-slate-500">
                                        <span>ID: {{ $product->id }}</span>
                                        <span class="inline-flex items-center gap-1 group-hover:text-indigo-700">
                                            Ver detalles
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>

    <!-- ===== Footer (incluido) ===== -->
    @include('components.footer')
</body>

</html>