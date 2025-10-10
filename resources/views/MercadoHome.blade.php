<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Área Home</title>
  <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon" />
  <style>
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fadeInUp { animation: fadeInUp 1s ease forwards; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-400 { animation-delay: 0.4s; }

    .gradient-text {
      background: linear-gradient(90deg, #f97316, #f59e0b);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .btn-primary:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 10px 20px rgba(249,115,22,0.25);
    }

    .card-hover:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .badge-class {
      background: linear-gradient(90deg, #f97316, #fb923c);
      color: white;
      font-weight: bold;
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
      border-radius: 9999px;
      position: absolute;
      top: 0.5rem;
      left: 0.5rem;
      text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-red-50 via-orange-50 to-white text-gray-800 overflow-x-hidden">

  {{-- Navbar Mercado --}}
  @include('components.navbar-mercado')

  <!-- Banner Mercado con Overlay -->
  <section class="relative w-full h-[25rem] md:h-[30rem] lg:h-[35rem] animate-fadeInUp">
    <img class="w-full h-full object-cover rounded-b-3xl shadow-xl transform hover:scale-105 transition duration-500"
      src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="Banner Mercado">
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/10 to-black/30 rounded-b-3xl"></div>
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 md:px-0">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold gradient-text drop-shadow-lg">
        {{ $mercadoLocal->nombre }}
      </h1>
      <p class="mt-4 text-white/90 text-sm sm:text-base md:text-lg max-w-2xl drop-shadow-md">
        {{ $mercadoLocal->descripcion }}
      </p>
    </div>
  </section>

  <!-- Botón Editar -->
  <div class="flex justify-center mt-8 animate-fadeInUp delay-200">
    <a href="{{ route('mercados.editar') }}"
      class="inline-block px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-bold rounded-xl shadow btn-primary transition">
      Editar Área
    </a>
  </div>

  <!-- Lista de Puestos - Masonry Style -->
  <section class="mt-16 px-6 max-w-7xl mx-auto">
    <h2 class="text-3xl font-extrabold text-center mb-12 gradient-text">Todos los Puestos</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      @foreach ($vendedors as $vendedor)
      <a href="{{ route('mercados.vervendedor', $vendedor->id) }}"
        class="relative bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition transform card-hover group">
        
        <div class="relative overflow-hidden h-64">
          <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
               src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}"
               alt="{{ $vendedor->nombre_del_local }}">
        </div>
        
        <div class="p-5 space-y-2">
          <h3 class="font-bold text-xl text-orange-600 group-hover:text-red-500 transition">{{ $vendedor->nombre_del_local }}</h3>
          <p class="text-gray-600">Tienda de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}</p>
          <div class="flex justify-between items-center mt-2">
            <div class="flex items-center gap-1">
              <span class="text-sm font-semibold">4.2</span>
              <img class="w-4" src="{{ asset('imgs/estrella.png') }}" alt="Estrella">
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </section>

  <!-- Footer -->
  @include('components.footer')

</body>
</html>
