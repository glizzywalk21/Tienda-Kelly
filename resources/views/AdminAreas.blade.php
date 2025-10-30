<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <title>Áreas - Panel Admin</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">

    <style>
        .fadeInUp {
            animation: fadeInUp .6s ease forwards;
        }
        @keyframes fadeInUp {
            0% { opacity:0; transform: translateY(12px); }
            100% { opacity:1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800 min-h-screen">

    <!-- NAVBAR DESKTOP -->
    <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
    <a href="{{ route('admin.index') }}">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.areas') }}"
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

    <!-- NAVBAR MOBILE (BOTTOM BAR) -->
    <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                    <a href="{{ route('admin.index') }}">
                    <img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Home Icon">
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.vendedores') }}">
                    <img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Sellers Icon">
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.clientes') }}">
                    <img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Users Icon">
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('AdminProfileVista') }}">
                    <img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil Icon">
                </a>
            </div>
        </div>
    </div>
    <!-- /NAVBAR MOBILE -->

    <main class="max-w-7xl mx-auto pt-10 pb-32 px-4 md:px-8 fadeInUp">

        <!-- TÍTULO + BOTÓN AGREGAR ÁREA -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="space-y-1">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    Áreas / Mercados
                </h1>
                <p class="text-indigo-600 font-semibold text-base md:text-lg">
                    Administración de mercados registrados
                </p>
            </div>

            <div class="flex justify-start md:justify-end">
                <a href="{{ route('admin.crearmercados') }}"
                   class="inline-flex items-center font-extrabold px-5 py-3 bg-white border shadow-md rounded-xl hover:text-indigo-600 transition">
                    <img class="w-7 mr-3" src="{{ asset('images/AddIcon.png') }}" alt="Add Icon">
                    Agregar Área
                </a>
            </div>
        </div>

        <!-- MENSAJE DE CONFIRMACIÓN AL CREAR ÁREA -->
        @if(session('usuario') && session('password'))
            <div class="mt-6 bg-green-500 text-white text-center py-4 px-6 rounded-md shadow-md">
                <strong>¡Nueva área creada llamada "{{ session('nombre') }}"!</strong><br>
                Las credenciales del mercado son las siguientes:<br>
                <span><strong>Usuario:</strong> {{ session('usuario') }}</span><br>
                <span><strong>Contraseña:</strong> {{ session('password') }}</span>
                <p>Son únicas, no las pierdas.</p>
            </div>
        @endif

        @if (session('success'))
            <div class="mt-6 bg-green-500 text-white text-center py-3 px-6 rounded-md shadow-md font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-6 bg-red-500 text-white text-center py-3 px-6 rounded-md shadow-md font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <!-- GRID DE LAS ÁREAS / MERCADOS -->
        <section class="mt-10">
            @if ($mercadoLocals->isEmpty())
                <div class="text-center text-gray-600 text-lg md:text-2xl py-20">
                    No hay áreas registradas todavía 😔
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6 justify-items-center">
                    @foreach ($mercadoLocals as $mercadoLocal)
                        <!-- CARD DE UN MERCADO -->
                        <div class="w-[90%] rounded-2xl bg-white shadow-lg overflow-hidden transition transform hover:-translate-y-1 hover:shadow-2xl">

                            <!-- Imagen -->
                            <img
                                class="w-full h-48 object-cover"
                                src="{{ asset('images/'.$mercadoLocal->imagen_referencia) }}"
                                alt="{{ $mercadoLocal->imagen_referencia }}"
                            >

                            <!-- Texto -->
                            <div class="p-4 text-center">
                                <h2 class="text-lg font-bold text-gray-800">
                                    {{ $mercadoLocal->nombre }}
                                </h2>
                                <p class="text-sm text-gray-600 text-justify mt-2">
                                    {{ $mercadoLocal->descripcion }}
                                </p>
                            </div>

                            <!-- Botones -->
                            <div class="flex justify-center gap-4 pb-4">
                                <!-- EDITAR -->
                                <a href="{{ route('admin.editarmercados',$mercadoLocal->id) }}"
                                   class="px-4 py-2 text-xs font-semibold text-white rounded shadow-md
                                          bg-gradient-to-r from-indigo-600 to-indigo-600
                                          hover:from-indigo-400 hover:to-indigo-400 transition">
                                    Editar
                                </a>

                                <!-- ELIMINAR -->
                                <form action="{{ route('admin.eliminarmercados',$mercadoLocal->id) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta área?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 text-xs font-semibold text-white rounded shadow-md
                                               bg-gradient-to-r from-red-600 to-red-600
                                               hover:from-red-400 hover:to-red-400 transition">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /CARD -->
                    @endforeach
                </div>
            @endif
        </section>

    </main>

</body>
</html>
