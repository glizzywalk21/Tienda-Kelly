<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Admin General</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
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
            <a href="{{ route('admin.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Area</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
            <a href="{{ route('AdminProfileVista')}}"
                class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </div>
    </nav>



    <!-- Inicio de nav movil-->
    <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
            <div class="flex items-center  ">
                <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">

                <a href="{{ route('AdminProfileVista')}}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
            </div>
        </div>
        <!--FIN DE NAVBAR MOBIL-->
    </div>

    <div class="mt-14 w-full max-w-6xl mx-auto px-4">

        <!-- Encabezado del puesto -->
        <div class="flex flex-col lg:flex-row justify-between items-center mb-10">
            <h1 class="text-3xl lg:text-5xl font-extrabold text-gray-800 mb-4 lg:mb-0">
                Puesto #{{ $vendedor->numero_puesto }} - {{ $vendedor->nombre_del_local }}
            </h1>
            <img class="w-32 h-32 lg:w-48 lg:h-48 object-cover rounded-full border-4 border-indigo-500 shadow-lg"
                src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="User Icon">
        </div>

        <!-- Cartas de productos -->
        <div class="flex flex-wrap justify-center mt-5 gap-6">
            @if ($products->isEmpty())
            <div class="w-full text-center text-xl text-gray-500 py-20">
                🛒 No hay productos disponibles en este momento. ¡Vuelve pronto!
            </div>
            @else
            @foreach ($products as $product)
            <div class="w-full sm:w-[48%] lg:w-[30%] bg-white rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105 hover:shadow-xl p-4 mb-6">
                <img class="w-full h-[250px] rounded-md object-cover mb-4"
                    src="{{ asset('imgs/'.$product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}">
                <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ $product->vendedor->nombre_del_local }}</p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-yellow-500 font-semibold">{{ $product->clasificacion }}</span>
                    <div class="flex items-center space-x-1">
                        <span class="text-gray-700 font-medium">4.2</span>
                        <img class="w-5 h-5" src="{{ asset('imgs/estrella.png') }}" alt="Estrella">
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>



    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')


</body>

</html>