<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Editar Puesto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">
    <!-- Desktop Navbar -->
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

    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Home"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Sellers"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Users"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Profile"></a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="p-6 mx-auto">
        <div class="w-full bg-white p-8 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-indigo-500 flex items-center justify-center gap-2">
                Lista de Vendedores
            </h1>

            <a class="inline-block mb-6 bg-indigo-700 hover:bg-indigo-500 text-white text-sm px-5 py-2 rounded-lg shadow transition"
                href="{{ route('admin.crearvendedores') }}">
                Agregar Vendedores
            </a>

            <div class="space-y-4">
                @foreach ($vendedors as $vendedor)
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">

                    <!-- Imagen + Info -->
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/'. $vendedor->imagen_de_referencia) }}"
                            alt="Imagen"
                            class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover ring-2 ring-indigo-700 shadow-sm">

                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h2>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-indigo-500">Puesto N° {{ $vendedor->numero_puesto }}</span>
                                en <b>{{ $vendedor->mercadoLocal->nombre }}</b>
                            </p>
                            <p class="text-sm text-gray-600"> <b>Telefono:</b> {{ $vendedor->telefono }}</p>
                            <p class="text-sm text-gray-600"> <b>Correo:</b> {{ $vendedor->usuario }}</p>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-2 md:gap-3">
                        <a class="px-4 py-2 text-xs font-medium text-white bg-green-500 rounded-lg shadow hover:bg-green-600 transition flex items-center gap-1"
                            href="{{ route('admin.vervendedores', $vendedor->id) }}">
                            Ver
                        </a>
                        <a class="px-4 py-2 text-xs font-medium text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition flex items-center gap-1"
                            href="{{ route('admin.editarvendedores', $vendedor->id) }}">
                            Editar
                        </a>
                        <form action="{{ route('admin.eliminarvendedores', $vendedor->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-xs font-medium text-white bg-red-500 rounded-lg shadow hover:bg-red-600 transition flex items-center gap-1">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>


    <!-- Footer -->
    @include('components.footer')
</body>

</html>
