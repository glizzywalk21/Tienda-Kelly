<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
  <style>
    /* Animaciones y gradientes */
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 1s ease forwards; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-400 { animation-delay: 0.4s; }
    .gradient-text {
      background: linear-gradient(90deg, #6366f1, #3b82f6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    /* Hover efectos para botones principales */
    .btn-primary:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 10px 20px rgba(99,102,241,0.25);
    }
    /* Efecto sombra suave para tarjetas */
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-blue-100 to-white text-gray-800">

  <!-- Incluir Navbar -->
  @include('components.navbar')

  <!-- Bienvenida Mejorada -->
  <header class="mt-10 px-6 flex flex-col md:flex-row justify-between items-center gap-6">
    <div class="space-y-2 animate-fadeInUp">
      <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold gradient-text">
        ¡Hola, <span class="text-indigo-700">{{ Auth::user()->nombre }}</span>! 👋
      </h1>
      <h3 class="text-indigo-600 font-semibold text-lg md:text-xl lg:text-2xl delay-200">
        Bienvenido de nuevo a <span class="font-bold">Tienda Kelly</span>
      </h3>
    </div>
    <div class="animate-fadeInUp delay-400">
      <img class="rounded-full w-20 h-20 md:w-24 md:h-24 border-4 border-indigo-500 shadow-lg" src="{{ asset('storage/imgs/' . (Auth::user()->imagen_perfil ?? 'non-img.png')) }}" alt="Foto Usuario">
    </div>
  </header>

  <!-- Imagen principal -->
  <!-- Imagen principal -->
  <section class="mt-6 h-[60vh] rounded-xl shadow-inner mx-4 overflow-hidden">
      <img src="{{ asset('imgs/bkg.jpg') }}" alt="Imagen principal" class="w-full h-full object-cover transition-transform hover:scale-105 duration-500">
  </section>

  <!-- Mercados -->
  @foreach ($mercadoLocals as $mercadoLocal)
  <section class="my-12">
    <div class="flex flex-col md:grid md:grid-cols-2 gap-8 items-center max-w-6xl mx-auto rounded-xl overflow-hidden shadow-lg card-hover {{ $mercadoLocal->id % 2 == 0 ? 'bg-indigo-900 text-white' : 'bg-white' }}">
      @if ($mercadoLocal->id % 2 == 0)
      <img class="w-full h-full object-cover" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="">
      @endif
      <div class="p-8 space-y-5">
        <h2 class="font-extrabold text-3xl text-center">{{ $mercadoLocal->nombre }}</h2>
        <p class="text-sm leading-relaxed">
          {{ $mercadoLocal->descripcion }}
        </p>
        <a href="{{ route('usuarios.mercado', $mercadoLocal->id) }}">
          <button class="mt-4 w-full px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">
            Ver Mercado
          </button>
        </a>
      </div>
      @if ($mercadoLocal->id % 2 != 0)
      <img class="w-full h-full object-cover" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="">
      @endif
    </div>
  </section>
  @endforeach

  <!-- Puestos populares -->
  <section class="mt-12 px-6">
    <h2 class="text-center font-extrabold text-3xl mb-10">Puestos Populares</h2>
    <div class="grid gap-8 md:grid-cols-3">
      @foreach ($vendedors->take(3) as $vendedor)
      <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2 card-hover">
        <img class="h-56 w-full object-cover" src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="">
        <div class="p-6">
          <h3 class="font-bold text-lg">Puesto de {{ $vendedor->nombre }} en {{ $vendedor->mercadoLocal->nombre }}</h3>
          <a href="{{ route('usuarios.vendedor', $vendedor->id) }}" class="flex gap-2 items-center text-indigo-600 font-medium mt-2 hover:underline">
            Ver Puesto <img width="18" src="{{ asset('imgs/arrow_left.png') }}" alt="">
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Incluir Footer -->
  @include('components.footer')

</body>
</html>
