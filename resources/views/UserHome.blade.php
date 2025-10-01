<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Inicio</title>
  <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
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

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

  <!-- Desktop Navbar -->
  <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
    <a href="{{ route('usuarios.index') }}" class="flex items-center gap-2">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
        Tienda <span class="text-indigo-600">Kelly</span>
      </h1>
    </a>
    <div class="flex gap-8">
      <a href="{{ route('usuarios.index') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Hogar</a>
      <a href="{{ route('usuarios.carrito') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Carrito</a>
      <a href="{{ route('usuarios.reservas') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Reservas</a>
      <a href="{{ route('usuarios.historial') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Historial</a>
      <a href="{{ route('UserProfileVista') }}" class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
        Perfil
      </a>
    </div>
  </nav>

  <!-- Mobile Navbar -->
  <div class="bottom-bar fixed bottom-3 left-0 right-0 md:hidden flex justify-center z-50">
    <div class="bg-gray-900 shadow-xl rounded-2xl w-72 h-14 flex justify-around items-center px-3">
      <a href="{{ route('usuarios.index') }}" class="bg-white rounded-full p-2 shadow-lg">
        <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
      </a>
      <a href="{{ route('usuarios.carrito') }}">
        <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
      </a>
      <a href="{{ route('usuarios.reservas') }}">
        <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
      </a>
      <a href="{{ route('UserProfileVista') }}">
        <img class="w-8 h-8 rounded-full object-cover border-2 border-white shadow" src="{{ asset('imgs/' . Auth::user()->imagen_de_referencia) }}" alt="Profile Icon" />
      </a>
    </div>
  </div>

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
  <section class="mt-6 h-[60vh] bg-no-repeat bg-cover bg-center rounded-xl shadow-inner mx-4 transition-transform hover:scale-105 duration-500" style="background-image: url({{ asset('imgs/bkg.jpeg') }});">
  </section>

  <!-- Botones Nosotros/Vision/Mision -->
  <section class="flex my-8 justify-center gap-6 flex-wrap">
    <button class="flex items-center px-6 py-3 bg-white border shadow-md rounded-xl btn-primary transition">
      <img class="w-7 mr-3" src="{{ asset('imgs/NosotrosIcon.png') }}" alt="Nosotros">
      Nosotros
    </button>
    <button class="flex items-center px-6 py-3 bg-white border shadow-md rounded-xl btn-primary transition">
      <img class="w-7 mr-3" src="{{ asset('imgs/VisionIcon.png') }}" alt="Visión">
      Visión
    </button>
    <button class="flex items-center px-6 py-3 bg-white border shadow-md rounded-xl btn-primary transition">
      <img class="w-7 mr-3" src="{{ asset('imgs/MisionIcon.png') }}" alt="Misión">
      Misión
    </button>
  </section>

  <!-- Mercados -->
  @foreach ($mercadoLocals as $mercadoLocal)
  <section class="my-10">
    <div class="flex flex-col md:grid md:grid-cols-2 gap-8 items-center max-w-6xl mx-auto rounded-xl overflow-hidden shadow-lg card-hover {{ $mercadoLocal->id % 2 == 0 ? 'bg-indigo-900 text-white' : 'bg-white' }}">
      @if ($mercadoLocal->id % 2 == 0)
      <img class="w-full h-full object-cover" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="">
      @endif
      <div class="p-8 space-y-5">
        <h2 class="font-extrabold text-3xl text-center">{{ $mercadoLocal->nombre }}</h2>
        <p class="text-sm leading-relaxed">
          {{ $mercadoLocal->descripcion }}. Horario: <b>{{ $mercadoLocal->horaentrada }}</b> - <b>{{ $mercadoLocal->horasalida }}</b>.
          Ubicación: <b>{{ $mercadoLocal->ubicacion }}</b>, {{ $mercadoLocal->municipio }}.
        </p>
        <a href="{{ route('usuarios.mercado', $mercadoLocal->id) }}">
          <button class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-semibold shadow-lg hover:scale-105 transition">
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

  <!-- Footer -->
  <footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 p-10">
      <div>
        <h2 class="font-bold text-xl mb-2">Contáctanos</h2>
        <p>Whatsapp: <a href="https://wa.me/50369565421" class="underline">+503 6956 5421</a></p>
        <p>Email: contacto@TiendaKelly.sv</p>
        <p>Dirección: San Rafael Cedros, Cuscatlán</p>
      </div>
      <div>
        <h2 class="font-bold text-xl mb-2">Sobre Nosotros</h2>
        <p>Apoyamos a los vendedores locales y municipales brindando soluciones tecnológicas para fortalecer los mercados comunitarios.</p>
      </div>
      <div class="text-center md:text-right">
        <h1 class="text-3xl font-black mb-4">Tienda <span class="text-blue-500">Kelly</span></h1>
        <div class="flex gap-3 justify-center md:justify-end">
          <img class="w-8 invert hover:scale-110 transition" src="{{ asset('imgs/facebook.png') }}" alt="">
          <img class="w-8 invert hover:scale-110 transition" src="{{ asset('imgs/google.png') }}" alt="">
          <img class="w-8 invert hover:scale-110 transition" src="{{ asset('imgs/linkedin.png') }}" alt="">
          <img class="w-8 invert hover:scale-110 transition" src="{{ asset('imgs/twitter.png') }}" alt="">
          <img class="w-8 hover:scale-110 transition" src="{{ asset('imgs/youtube.png') }}" alt="">
        </div>
      </div>
    </div>
    <div class="w-full h-[2px] bg-gray-700"></div>
    <p class="text-center py-4 text-gray-400 text-sm">© 2025 Tienda Kelly - Todos los derechos reservados</p>
  </footer>

</body>
</html>
