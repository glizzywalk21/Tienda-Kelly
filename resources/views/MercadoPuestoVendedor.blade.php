<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $vendedor->nombre_del_local }} - Tienda Kelly</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
    <style>
        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-orange-50 via-orange-100 to-white overflow-x-hidden">

    <!-- Navbar Mercado -->
    @include('components.navbar-mercado')

    <!-- Perfil del Vendedor -->
    <section class="max-w-7xl mx-auto mt-10 px-4 md:px-0 text-center animate-fadeInUp">
        <img class="w-40 h-40 md:w-60 md:h-60 rounded-full mx-auto object-cover shadow-lg"
             src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="{{ $vendedor->nombre_del_local }}">
        <h1 class="text-3xl md:text-5xl font-extrabold mt-4 text-orange-600">{{ $vendedor->nombre_del_local }}</h1>
        <p class="text-gray-700 mt-1 md:text-lg">
            Puesto #{{ $vendedor->numero_puesto }} - <span class="font-semibold">{{ $mercadoLocal->nombre }}</span>
        </p>
    </section>

    <!-- Productos -->
    <section class="max-w-7xl mx-auto mt-12 px-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($products as $product)
        <a href="{{ route('usuarios.producto', $product->id) }}"
           class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 btn-hover group transition">
            <div class="relative overflow-hidden">
                <img class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                     src="{{ asset('imgs/' . $product->imagen_referencia) }}"
                     alt="{{ $product->name }}">
            </div>
            <div class="p-4 space-y-2">
                <h2 class="font-bold text-xl uppercase text-orange-600">{{ $product->name }}</h2>
                <p class="text-gray-700 text-sm">{{ $product->description }}</p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-orange-500 font-bold text-lg">${{ $product->price }}</span>
                    <div class="flex items-center gap-1">
                        <span class="font-semibold">4.2</span>
                        <img class="w-4" src="{{ asset('imgs/estrella.png') }}" alt="Estrella">
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </section>

    <!-- Paginación -->
    <div class="max-w-7xl mx-auto my-10 flex justify-center gap-3">
        {{ $products->links() }}
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>
