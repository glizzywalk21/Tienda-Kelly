<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
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
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Areas</a>
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

    <div class="mx-auto  mt-10 mb-32 "> <!-- Añadido un margen inferior -->

        <!--INICIO DE NAVBAR MOBIL-->
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

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="mt-10 px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="space-y-2 animate-fadeInUp">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold gradient-text">Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-indigo-600 font-semibold text-lg md:text-xl lg:text-2xl delay-200">Administrador General</h3>
                </div>
            </div>

            @if(session('usuario') && session('password'))
            <div class="bg-green-500 text-white text-center py-4 px-6 rounded-md mb-6 mx-4">
                <strong>¡Nueva area creada llamado "{{ session('nombre')}}"!</strong><br>
                Las credenciales del mercado son las siguientes:<br>
                <span><strong>Usuario:</strong> {{ session('usuario') }}</span><br>
                <span><strong>Contraseña:</strong> {{ session('password') }}</span>
                <p>Son Unicas asi que no se le olvide!</p>
            </div>
            @endif
            <!---->
            <div class="mt-6 h-[60vh] rounded-xl shadow-inner mx-4 overflow-hidden">
                <img class="w-full h-full object-cover " src="{{ asset('imgs/index.jpg') }}" alt="Banner Image">
            </div>

            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <a href="{{ route('admin.crearmercados') }}" class="btn btn-primary btn-sm float-right" data-placement="left">

                    <span class="flex items-center font-extrabold px-6 py-3 bg-white border shadow-md rounded-xl btn-primary transition hover:text-indigo-600 transition">
                        <img class="w-7 mr-3 " src="{{ asset('imgs/AddIcon.png') }}" alt="User Icon">
                        Agregar Area
                    </span>
                </a>
            </div>

            <!--Incio de la secciones para editar o eliminar segun el admin desee-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6 mt-5 px-4 md:px-8 justify-items-center">
                @foreach ($mercadoLocals as $mercadoLocal)
                <!-- CARD -->
                <div class="w-[90%] rounded-2xl shadow-lg overflow-hidden transition transform hover:-translate-y-1 hover:shadow-2xl">

                    <!-- Imagen -->
                    <img class="w-full h-48 object-cover"
                        src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}"
                        alt="{{ $mercadoLocal->imagen_referencia }}">

                    <!-- Texto -->
                    <div class="p-4 text-center">
                        <h1 class="text-lg font-bold text-gray-800">{{ $mercadoLocal->nombre }}</h1>
                        <p class="text-sm text-gray-600 text-justify mt-2">
                            El {{ $mercadoLocal->nombre }} se encuentra en {{ $mercadoLocal->ubicacion }},
                            en el municipio de {{ $mercadoLocal->municipio }}.
                            En el horario siguiente: {{ $mercadoLocal->horaentrada }} - {{ $mercadoLocal->horasalida }}.
                            {{ $mercadoLocal->descripcion }}
                        </p>
                    </div>

                    <!-- Botones dentro de la card -->
                    <div class="flex justify-center gap-4 pb-4">
                        <!-- EDITAR -->
                        <a href="{{ route('admin.editarmercados',$mercadoLocal->id) }}"
                            class="px-4 py-2 text-xs font-semibold text-white rounded shadow-md 
                      bg-gradient-to-r from-indigo-600 to-indigo-600 
                      hover:from-indigo-400 hover:to-indigo-400 transition">
                            Editar
                        </a>

                        <!-- ELIMINAR -->
                        <form action="{{ route('admin.eliminarmercados',$mercadoLocal->id) }}" method="POST">
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
                @endforeach
            </div>

            <!--FIN DE PLANTILLA -->
            <!--Final de la seccion de editar o eliminar-->
        </div>
    </div>

    <!--Incluyendo el footer desde los compones-->
    @include('components.footer')
</body>

</html>