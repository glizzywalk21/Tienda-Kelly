<!-- Navbar Desktop -->
<div class="hidden md:flex p-4 items-center justify-between shadow-md bg-white">
  <a href="{{ route('mercados.index') }}">
    <h1 class="text-3xl md:text-4xl font-extrabold gradient-text">
      Tienda Kelly: <span class="text-red-600">Mercado</span>
    </h1>
  </a>
  <div class="flex gap-6">
    <a href="{{ route('mercados.index') }}" class="font-semibold hover:text-red-500 transition">Hogar</a>
    <a href="{{ route('mercados.listavendedores') }}" class="font-semibold hover:text-red-500 transition">Vendedores</a>
    <a href="{{ route('mercados.reservas') }}" class="font-semibold hover:text-red-500 transition">Reservas</a>
    <a href="{{ route('mercados.historial') }}" class="font-semibold hover:text-red-500 transition">Historial</a>
    <a href="{{ route('mercados.perfil') }}" class="font-semibold bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
      Perfil
    </a>
  </div>
</div>

<!-- Navbar Mobile -->
<div class="fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center z-50">
  <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around items-center shadow-lg">
    <a href="{{ route('mercados.index') }}"><img class="w-6" src="{{ asset('imgs/mercado.home.nav.png') }}" alt="Home"></a>
    <a href="{{ route('mercados.listavendedores') }}"><img class="w-6" src="{{ asset('imgs/mercado.vendedores.nav.png') }}" alt="Vendedores"></a>
    <a href="{{ route('mercados.reservas') }}"><img class="w-6" src="{{ asset('imgs/mercado.reservas.nav.png') }}" alt="Reservas"></a>
    <a href="{{ route('mercados.historial') }}"><img class="w-6" src="{{ asset('imgs/mercado.historial.nav.png') }}" alt="Historial"></a>
    <a href="{{ route('mercados.perfil') }}"><img class="w-6" src="{{ asset('imgs/mercado.perfil.nav.png') }}" alt="Perfil"></a>
  </div>
</div>
