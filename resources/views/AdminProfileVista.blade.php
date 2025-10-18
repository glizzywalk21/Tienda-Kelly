<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
    <title>Perfil · Admin</title>
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

    <!-- NAVBAR DESKTOP -->
    <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
        <a href="{{ route('admin.index') }}" class="focus:outline-none focus:ring-2 focus:ring-indigo-400 rounded">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Áreas</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
            <a href="{{ route('reservations.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Reservas</a>
            <a href="{{ route('AdminProfileVista') }}"
                class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </div>
    </nav>

    <!-- NAVBAR MÓVIL (FIJA) -->
    <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around items-center">
            <a href="{{ route('admin.index') }}" aria-label="Inicio">
                <img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="">
            </a>
            <a href="{{ route('admin.vendedores') }}" aria-label="Vendedores">
                <img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="">
            </a>
            <a href="{{ route('admin.clientes') }}" aria-label="Clientes">
                <img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="">
            </a>
            <a href="{{ route('reservations.index') }}" aria-label="Reservas">
                <img class="w-6" src="{{ asset('images/reserva.png') }}" alt="">
            </a>
            <a href="{{ route('AdminProfileVista') }}" aria-label="Perfil">
                <img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="">
            </a>

        </div>
    </div>

    <!-- HERO -->
    <header class="relative overflow-hidden">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(1200px_600px_at_100%_-10%,rgba(79,70,229,0.15),transparent)]">
        </div>
        <div class="relative mx-auto max-w-6xl px-4 pt-10 pb-24 md:pb-28">
            <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight text-indigo-600">Panel del Administrador</h2>
            <p class="mt-3 max-w-2xl text-sm md:text-base text-gray-600">
                Gestiona áreas, vendedores y clientes desde un único lugar.
            </p>
        </div>
    </header>

    @php
        // KPIs dinámicos (sin tocar rutas/controlador)
        $areas = \App\Models\MercadoLocal::count();
        $vendedores = \App\Models\Vendedor::count();
        $clientes = \App\Models\User::where('id', '!=', 1)->count(); // asumiendo id=1 es admin
        $reservas = \App\Models\Reservation::count();
    @endphp

    <!-- CONTENIDO -->
    <main class="flex-1">
        <section class="mx-auto max-w-6xl px-4 -mt-16 md:-mt-20 pb-32 md:pb-36">
            <!-- Tarjeta de perfil -->
            <div class="rounded-3xl bg-white shadow-xl ring-1 ring-gray-200 p-6 md:p-8">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <div
                        class="relative h-28 w-28 md:h-32 md:w-32 rounded-full ring-2 ring-indigo-100 ring-offset-2 ring-offset-white shadow bg-white/70 p-1 overflow-hidden">
                        <img src="{{ asset('images/admin.png') }}" {{-- ojo: en minúsculas si el archivo es admin.png
                            --}} alt="Avatar administrador" class="h-full w-full rounded-full object-contain" {{-- usa
                            object-cover si prefieres que “llene” recortando --}} loading="lazy" decoding="async"
                            onerror="this.src='{{ asset('images/ClienteIcon.png') }}';">
                    </div>
                    <div class="flex-1 min-w-0 text-center md:text-left">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900">Administrador General</h3>
                        <p class="text-sm text-gray-500">Administrador de TiendaKelly</p>
                        <div class="mt-1 text-sm text-gray-600 break-all">admin@minishop.sv</div>

                        <!-- Acciones rápidas -->
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            <a href="{{ route('admin.crearmercados') }}"
                                class="group rounded-2xl border border-gray-200 bg-white p-4 hover:shadow-md transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <div class="flex items-center gap-3">
                                    <img class="w-6" src="{{ asset('images/admin.agregar.mercados.png') }}" alt="">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Agregar área</p>
                                        <p class="text-xs text-gray-500 group-hover:text-gray-600">Crear nueva área del
                                            mercado</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.crearvendedores') }}"
                                class="group rounded-2xl border border-gray-200 bg-white p-4 hover:shadow-md transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <div class="flex items-center gap-3">
                                    <img class="w-5" src="{{ asset('images/admin.agregar.vendedor.png') }}" alt="">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Agregar vendedor</p>
                                        <p class="text-xs text-gray-500 group-hover:text-gray-600">Registrar un nuevo
                                            puesto</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.vendedores') }}"
                                class="group rounded-2xl border border-gray-200 bg-white p-4 hover:shadow-md transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <div class="flex items-center gap-3">
                                    <img class="w-5" src="{{ asset('images/admin.vendedores.png') }}" alt="">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Vendedores</p>
                                        <p class="text-xs text-gray-500 group-hover:text-gray-600">Listado y gestión</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.clientes') }}"
                                class="group rounded-2xl border border-gray-200 bg-white p-4 hover:shadow-md transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <div class="flex items-center gap-3">
                                    <img class="w-5" src="{{ asset('images/admin.usuarios.png') }}" alt="">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Clientes</p>
                                        <p class="text-xs text-gray-500 group-hover:text-gray-600">Historial y control
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Botón cerrar sesión -->
                        <form action="{{ route('logout') }}" method="GET" class="mt-6">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-2 rounded-2xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400">
                                <img class="w-4" src="{{ asset('images/tuerca.png') }}" alt="">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MÉTRICAS RÁPIDAS -->
            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-3">
                <a href="{{ route('admin.index') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Áreas</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($areas) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

                <a href="{{ route('admin.vendedores') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Vendedores</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($vendedores) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

                <a href="{{ route('admin.clientes') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Clientes</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($clientes) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

                <a href="{{ route('reservations.index') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Reservas</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($reservas) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>
            </div>
        </section>
    </main>

    <!-- FOOTER (oculto en móvil para no chocar con la bottom bar fija) -->
    <footer class="mt-auto hidden md:block">
        @include('components.footer')
    </footer>

</body>

</html>