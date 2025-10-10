<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Perfil de vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
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



    <div class="mx-auto max-w-lg"> <!-- Añadido un margen inferior -->
        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="{{ route('admin.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./AdminEstadoPedidos"><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <?php $id = 1; ?>
                    <a href="{{ route('AdminProfileVista')}}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>
            <!--FIN DE NAVBAR MOBIL-->
        </div>
    </div>




    <div class="mt-14  w-[90%] mx-auto md:text-[30px]">

        <!--CIRCULO-->

        <div class="flex flex-col md:flex-row justify-between items-center w-[90%] mx-auto space-y-4 md:space-y-0 md:space-x-4"> <!-- Contenedor Principal -->
            <div class="flex flex-col md:flex-row items-start space-y-4 md:space-y-0 md:space-x-4"> <!-- Contenedor para la imagen y la información -->
                <div class="w-full md:w-[15rem] h-[15rem]"> <!-- Contenedor de la imagen -->
                    <img class="w-full h-full object-cover rounded-[15%]" src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="Imagen de Referencia">
                </div>
                <div> <!-- Contenedor de la información -->
                    <div class="text-[1.5rem] md:text-[2rem] font-semibold">
                        Puesto #{{ $vendedor->numero_puesto}} - <span class="font-bold">{{ $mercadoLocal->nombre }}</span>
                    </div>
                    <div class="text-[2.5rem] md:text-[4rem] font-bold mt-2">
                        {{ $vendedor->nombre_del_local }}
                    </div>
                </div>
            </div>
        </div>


        <!--Fin Principal-->


        <div class="flex flex-wrap justify-center mt-10 text-sm md:gap-[50px]">

            <!--CARTA-->
            @foreach ($products as $product)
            <a href="{{ route('admin.verproducto', $product->id)}}" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset( 'imgs/'.$product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}">
                <h1 class="font-bold uppercase text-2xl mt-5 m-[1rem]">
                    {{ $product->name }}
                </h1>
                <h3 class="mb-2 text-xl">${{ $product->price }}</h3>
                <div class="flex justify-between">
                    <h3>{{ $product->description }}</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </a>
            @endforeach
            <!--FIN CARTA-->



        </div>




    </div>
    <!--Incluyendo el footer desde componentes-->
    @include('components.footer')

</body>

</html>