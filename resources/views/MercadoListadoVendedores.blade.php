<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Puesto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .btn-gradient {
            background: linear-gradient(90deg, #f97316, #ef4444);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(239,68,68,0.4);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-red-50 via-orange-50 to-white text-gray-800">

    {{-- Navbar Mercado --}}
    @include('components.navbar-mercado')

    <main class="p-4 md:p-8 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:justify-between items-center mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 text-center md:text-left">
                Lista de Vendedores
            </h1>
            <a href="{{ route('mercados.agregarvendedor') }}"
               class="mt-4 md:mt-0 px-6 py-3 text-white font-bold rounded-lg btn-gradient shadow-lg">
               Agregar Vendedor
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($vendedores as $vendedor)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover">
                <div class="relative">
                    <img src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" 
                         alt="{{ $vendedor->nombre }}" 
                         class="w-full h-48 object-cover rounded-t-2xl">
                    <span class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-lg font-semibold text-sm shadow-md">
                        Puesto #{{ $vendedor->numero_puesto }}
                    </span>
                </div>
                <div class="p-5 flex flex-col justify-between gap-3">
                    <div>
                        <h2 class="font-bold text-xl text-gray-800">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h2>
                        <p class="text-gray-600">En: <b>{{ $vendedor->mercadoLocal->nombre }}</b></p>
                        <p class="text-gray-600"><b>Tel:</b> {{ $vendedor->telefono }}</p>
                        <p class="text-gray-600"><b>Email:</b> {{ $vendedor->usuario }}</p>
                        <p class="mt-2 inline-block text-sm font-semibold px-3 py-1 bg-orange-100 text-orange-700 rounded-full">
                            {{ $vendedor->clasificacion }}
                        </p>
                    </div>
                    <div class="mt-4 flex justify-between gap-2">
                        <a href="{{ route('mercados.vervendedor', $vendedor->id) }}" 
                           class="flex-1 text-center px-4 py-2 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition">
                           Ver
                        </a>
                        <a href="{{ route('mercados.editarvendedor', $vendedor->id) }}" 
                           class="flex-1 text-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                           Editar
                        </a>
                        <form action="{{ route('mercados.eliminarvendedor', $vendedor->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    {{-- Footer Mercado --}}
    @include('components.footer')

</body>
</html>
