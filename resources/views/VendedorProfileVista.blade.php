<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <title>Perfil del Vendedor</title>
</head>

<body class="bg-slate-50 text-slate-900">

    <!-- NAV DESKTOP -->
    <header class="hidden md:block sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-6">
            <div class="h-16 flex items-center justify-between">
                <a href="{{ route('vendedores.index') }}" class="group inline-flex items-center gap-3">
                    <img src="{{ asset('imgs/shop.png') }}" class="w-8 h-8" alt="Logo">
                    <h1 class="text-2xl font-extrabold tracking-tight">
                        Tienda Kelly <span class="text-indigo-600 group-hover:text-indigo-700 transition">Vendedores</span>
                    </h1>
                </a>
                <nav class="flex items-center gap-8">
                    <a class="text-sm font-medium hover:text-indigo-700" href="{{ route('vendedores.index') }}">Mi Puesto</a>
                    <a class="text-sm font-medium hover:text-indigo-700" href="{{ route('vendedores.productos') }}">Mis Productos</a>
                    <a class="text-sm font-medium hover:text-indigo-700" href="{{ route('vendedores.reservas') }}">Mis Reservas</a>
                    <a class="text-sm font-medium hover:text-indigo-700" href="{{ route('vendedores.historial') }}">Mi Historial</a>
                    <a class="text-sm font-semibold border border-indigo-600 text-indigo-600 px-3 py-1.5 rounded-md hover:bg-indigo-600 hover:text-white transition" href="{{ route('vendedor.perfil') }}">Perfil</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- NAV MÓVIL -->
    <div class="md:hidden fixed bottom-5 left-0 right-0 z-50 flex justify-center">
        <nav class="bg-slate-900 text-white/90 rounded-2xl shadow-2xl w-[300px] h-16 px-3 flex items-center justify-around">
            <a href="{{ route('vendedores.index') }}"><img class="w-6" src="{{ asset('imgs/vendedor.home.png') }}" alt=""></a>
            <a href="{{ route('vendedores.productos') }}"><img class="w-6" src="{{ asset('imgs/vendedor.productos.png') }}" alt=""></a>
            <a href="{{ route('vendedores.reservas') }}"><img class="w-6" src="{{ asset('imgs/vendedor.reservas.png') }}" alt=""></a>
            <a href="{{ route('vendedores.historial') }}"><img class="w-6" src="{{ asset('imgs/mercado.historial.blancopng.png') }}" alt=""></a>
            <a href="{{ route('vendedor.perfil') }}"><img class="w-6" src="{{ asset('imgs/vendedor.perfil.png') }}" alt=""></a>
        </nav>
    </div>

    <!-- HERO AMPLIO -->
    <section class="bg-gradient-to-br from-indigo-600 via-indigo-500 to-indigo-400">
        <div class="max-w-6xl mx-auto px-6">
            <div class="py-12 md:py-16">
                <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white drop-shadow-sm">
                    Tienda <span class="text-white/90">Kelly</span>
                </h2>
                <p class="mt-3 text-white/90 text-lg">Panel del vendedor</p>
            </div>
        </div>
    </section>

    <!-- PERFIL + DATOS EN CARD CON ESPACIO -->
    <main class="max-w-5xl mx-auto px-6">
        <section class="-mt-10 md:-mt-14">
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200/70 p-8 md:p-10">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                    <img class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover ring-4 ring-white shadow"
                         src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="Foto del vendedor">

                    <div class="flex-1 text-center md:text-left space-y-3">
                        <div class="flex items-center justify-center md:justify-start gap-1 text-amber-500">
                            @for ($i = 0; $i < 5; $i++)
                                <img class="w-5 h-5" src="{{ asset('imgs/estrella.png') }}" alt="star">
                            @endfor
                            <span class="ml-2 text-sm text-slate-600">5.0</span>
                        </div>

                        <h3 class="text-2xl md:text-3xl font-bold text-slate-900">
                            {{ $vendedor->nombre }} {{ $vendedor->apellidos }}
                        </h3>
                        <p class="text-slate-600">{{ '@' . $vendedor->usuario }}</p>

                        <div class="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-xl border border-slate-200 p-4">
                                <p class="text-xs uppercase tracking-wide text-slate-500">Puesto</p>
                                <p class="mt-1 text-lg font-semibold">{{ $vendedor->nombre_del_local }}</p>
                            </div>
                            @if($vendedor->mercadoLocal)
                                <div class="rounded-xl border border-slate-200 p-4">
                                    <p class="text-xs uppercase tracking-wide text-slate-500">Mercado</p>
                                    <p class="mt-1 text-lg font-semibold text-indigo-700">{{ $vendedor->mercadoLocal->nombre }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ACCIONES EN GRID CON MÁS RESPIRO -->
        <section class="mt-10 md:mt-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('vendedores.agregarproducto', $vendedor->id) }}"
                   class="group bg-white rounded-2xl p-6 ring-1 ring-slate-200/70 hover:shadow-md transition space-y-2">
                    <div class="flex items-center gap-3">
                        <img class="w-6" src="{{ asset('imgs/AddSelectedIcon.png') }}" alt="">
                        <h4 class="text-lg font-semibold text-slate-900">Agregar productos</h4>
                        <span class="ml-auto text-indigo-600 group-hover:translate-x-0.5 transition">→</span>
                    </div>
                    <p class="text-sm text-slate-600">Crea un nuevo producto para tu catálogo.</p>
                </a>

                <a href="{{ route('vendedores.editar', $vendedor->id) }}"
                   class="group bg-white rounded-2xl p-6 ring-1 ring-slate-200/70 hover:shadow-md transition space-y-2">
                    <div class="flex items-center gap-3">
                        <img class="w-5" src="{{ asset('imgs/EditSelectedIcon.png') }}" alt="">
                        <h4 class="text-lg font-semibold text-slate-900">Editar mi puesto</h4>
                        <span class="ml-auto text-indigo-600 group-hover:translate-x-0.5 transition">→</span>
                    </div>
                    <p class="text-sm text-slate-600">Actualiza datos del puesto y tu imagen.</p>
                </a>

                <a href="{{ route('vendedores.reservas') }}"
                   class="group bg-white rounded-2xl p-6 ring-1 ring-slate-200/70 hover:shadow-md transition space-y-2">
                    <div class="flex items-center gap-3">
                        <img class="w-5" src="{{ asset('imgs/admin.vendedores.png') }}" alt="">
                        <h4 class="text-lg font-semibold text-slate-900">Mi buzón</h4>
                        <span class="ml-auto text-indigo-600 group-hover:translate-x-0.5 transition">→</span>
                    </div>
                    <p class="text-sm text-slate-600">Revisa pedidos y su estado.</p>
                </a>

                <a href="{{ route('vendedores.historial') }}"
                   class="group bg-white rounded-2xl p-6 ring-1 ring-slate-200/70 hover:shadow-md transition space-y-2">
                    <div class="flex items-center gap-3">
                        <img class="w-5" src="{{ asset('imgs/mercado.historial.png') }}" alt="">
                        <h4 class="text-lg font-semibold text-slate-900">Historial</h4>
                        <span class="ml-auto text-indigo-600 group-hover:translate-x-0.5 transition">→</span>
                    </div>
                    <p class="text-sm text-slate-600">Consulta pedidos pasados y registros.</p>
                </a>
            </div>

            <form action="{{ route('logout') }}" method="GET" class="m-8 justify-center flex">
                @csrf
                <button type="submit"
                        class="w-64 h-12 rounded-2xl bg-rose-600 text-white font-semibold hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-600">
                    Cerrar cuenta
                </button>
            </form>
        </section>
    </main>

    @include('components.footer')
</body>
</html>
