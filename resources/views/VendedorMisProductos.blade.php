<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Mis Productos</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-b from-slate-50 to-white text-slate-900">

    <!-- ===== Desktop Navbar ===== -->
    <div class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-sm sticky top-0 z-50 border-b border-slate-100">
        <a href="{{ route('vendedores.index') }}" class="group inline-flex items-center gap-2">
            <img src="{{ asset('images/shop.png') }}" alt="Logo" class="w-7 h-7">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                Tienda Kelly <span class="text-indigo-600 group-hover:text-indigo-700 transition-colors">Vendedores</span>
            </h1>
        </a>
        <nav class="flex gap-6">
            <a href="{{ route('vendedores.index') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}" class="font-medium uppercase text-xs md:text-sm text-indigo-700">Mis Productos</a>
            <a href="{{ route('vendedores.reservas') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mis Reservas</a>
            <a href="{{ route('vendedores.historial') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mi Historial</a>
            <a href="{{ route('vendedor.perfil') }}" class="font-semibold uppercase text-xs md:text-sm border border-indigo-600 text-indigo-600 px-3 py-1.5 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </nav>
    </div>

    <!-- ===== Mobile Bottom Bar ===== -->
    <div class="fixed bottom-4 left-0 right-0 md:hidden flex justify-center z-50">
        <div class="bg-slate-900/95 backdrop-blur rounded-2xl w-64 h-14 flex justify-around px-2 shadow-2xl">
            <a href="{{ route('vendedores.index') }}" class="grid place-items-center w-12" aria-label="Inicio">
                <img class="w-6" src="{{ asset('images/vendedor.home.png') }}" alt="Home Icon" />
            </a>
            <a href="{{ route('vendedores.productos') }}" class="grid place-items-center w-12" aria-label="Productos">
                <img class="w-6" src="{{ asset('images/vendedor.productos.png') }}" alt="Cart Icon" />
            </a>
            <a href="{{ route('vendedores.reservas') }}" class="grid place-items-center w-12" aria-label="Reservas">
                <img class="w-6" src="{{ asset('images/vendedor.reservas.png') }}" alt="Favorites Icon" />
            </a>
            <a href="{{ route('vendedores.historial') }}" class="grid place-items-center w-12" aria-label="Historial">
                <img class="w-6" src="{{ asset('images/mercado.historial.blancopng.png') }}" alt="Favorites Icon" />
            </a>
            <a href="{{ route('vendedor.perfil') }}" class="grid place-items-center w-12" aria-label="Perfil">
                <img class="w-6" src="{{ asset('images/vendedor.perfil.png') }}" alt="Profile Icon" />
            </a>
        </div>
    </div>

    <!-- ===== Main ===== -->
    <main class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8 py-8">

        <!-- Header vendedor -->
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div class="flex items-center gap-4">
                <img class="hidden md:block w-16 h-16 rounded-full object-cover ring-1 ring-slate-200"
                     src="{{ asset('images/' . $vendedor->imagen_de_referencia) }}" alt="Vendedor">
                <div>
                    <h1 class="text-xl md:text-2xl font-semibold text-slate-800">
                        {{ $vendedor->nombre_del_local }} en
                        <span class="font-bold text-indigo-600">{{ $vendedor->mercadoLocal->nombre }}</span>
                    </h1>
                    <p class="text-sm text-slate-600">
                        {{ $vendedor->nombre }} {{ $vendedor->apellidos }}
                    </p>
                </div>
            </div>

            <!-- Botón Agregar producto -->
            <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}"
               class="inline-flex items-center gap-2 px-4 h-10 rounded-md bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar producto
            </a>
        </div>

        <!-- Título -->
        <div class="mt-8 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-800">Mis Productos</h2>
            <p class="text-slate-500 mt-2">Administra tu catálogo: edita, elimina o crea nuevos productos.</p>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="mt-6 rounded-md border border-green-200 bg-green-50 text-green-700 px-4 py-3 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-6 rounded-md border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Grid de productos -->
        <section class="mt-8">
            @if ($productos->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200/60 p-10 text-center">
                    <img class="mx-auto w-24 mb-4 opacity-80" src="{{ asset('images/empty-cart.png') }}" alt="">
                    <h3 class="text-lg font-semibold text-slate-800">Aún no tienes productos</h3>
                    <p class="text-slate-500 mt-1">Cuando agregues productos, aparecerán aquí.</p>
                    <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}"
                       class="mt-6 inline-flex items-center gap-2 px-4 h-10 rounded-md bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        Agregar producto
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($productos as $producto)
                        <div class="group bg-white rounded-xl shadow-sm ring-1 ring-slate-200/70 overflow-hidden hover:shadow-md transition">
                            <div class="relative h-48 w-full overflow-hidden">
                                <img src="{{ asset('images/' . $producto->imagen_referencia) }}"
                                     alt="Imagen del Producto"
                                     class="h-full w-full object-cover group-hover:scale-[1.02] transition">
                                <span class="absolute top-3 left-3 text-[11px] px-2 py-0.5 rounded-full bg-white/90 ring-1 ring-slate-200 text-slate-700">
                                    #{{ $producto->id }}
                                </span>
                                <span class="absolute top-3 right-3 text-[11px] px-2 py-0.5 rounded-full
                                    {{ $producto->estado === 'Disponible' ? 'bg-green-50 text-green-700 ring-green-300 font-bold' : 'bg-amber-50 text-amber-700 ring-amber-200' }} ring-2">
                                    {{ $producto->estado }}
                                </span>
                            </div>

                            <div class="p-4 space-y-2">
                                <h3 class="text-base font-semibold text-slate-900 line-clamp-1">
                                    {{ $producto->name }}
                                </h3>
                                <p class="text-sm text-slate-600 line-clamp-2">
                                    {{ $producto->description }}
                                </p>

                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-sm text-slate-500">Precio</span>
                                    <span class="text-base font-semibold text-indigo-700">
                                        ${{ number_format($producto->price ?? 0, 2) }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-3 gap-2 pt-3">
                                    <a href="{{ route('vendedores.verproducto', $producto->id) }}"
                                       class="inline-flex items-center justify-center h-9 rounded-md text-xs font-bold bg-yellow-300 border border-slate-200 text-slate-700 hover:bg-slate-50">
                                        Ver
                                    </a>
                                    <a href="{{ route('vendedores.editarproducto', $producto->id) }}"
                                       class="inline-flex items-center justify-center h-9 rounded-md text-xs font-bold bg-blue-600 text-white hover:bg-blue-700">
                                        Editar
                                    </a>
                                    <form action="{{ route('vendedores.eliminarproducto', $producto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center h-9 rounded-md text-xs font-bold bg-rose-600 text-white hover:bg-rose-700"
                                                onclick="return confirm('¿Eliminar este producto?');">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    @include('components.footer')
</body>
</html>
