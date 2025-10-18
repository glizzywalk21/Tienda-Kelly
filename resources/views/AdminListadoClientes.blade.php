<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Admin · Clientes</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800"><!-- STICKY FOOTER LAYOUT -->

  <!-- NAVBAR DESKTOP -->
  <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
    <a href="{{ route('admin.index') }}">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
        TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
      </h1>
    </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
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

  <!-- NAVBAR MÓVIL (FIJA) -->
  <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
    <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around items-center">
      <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Inicio"></a>
      <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Vendedores"></a>
      <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Clientes"></a>
      <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil"></a>
    </div>
  </div>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="flex-1 max-w-6xl mx-auto px-4 pt-10 pb-28"><!-- flex-1 mantiene el footer abajo -->
    <!-- TÍTULO + BUSCADOR -->
    <header class="mb-8">
      <h2 class="text-center text-4xl md:text-5xl font-extrabold text-indigo-600">Listado de Clientes</h2>

      <!-- Flash messages -->
      @if (session('success'))
        <div class="mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 text-sm">
          {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 text-sm">
          {{ session('error') }}
        </div>
      @endif

      <!-- Buscador (filtra en cliente) -->
      <div class="mt-6 flex items-center gap-3">
        <div class="relative flex-1">
          <input id="search"
                 type="text"
                 placeholder="Buscar por nombre, correo o teléfono…"
                 class="w-full rounded-2xl border-gray-300 bg-white/80 px-4 py-3 pr-10 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300">
          <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M17 10.5A6.5 6.5 0 1 1 4 10.5a6.5 6.5 0 0 1 13 0Z"/>
          </svg>
        </div>
        <span id="count" class="hidden text-sm text-gray-600"></span>
      </div>
    </header>

    <!-- GRID DE TARJETAS -->
    @if ($clientes->count() > 0)
      <section id="cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($clientes as $cliente)
          <article class="client-card group overflow-hidden rounded-2xl bg-white shadow ring-1 ring-gray-200 hover:shadow-lg transition"
                   data-name="{{ Str::lower(($cliente->nombre ?? '').' '.($cliente->apellido ?? '')) }}"
                   data-email="{{ Str::lower($cliente->usuario ?? '') }}"
                   data-phone="{{ Str::lower($cliente->telefono ?? '') }}">
            <div class="flex items-center gap-4 p-5">
              <div class="relative h-16 w-16 shrink-0 overflow-hidden rounded-xl ring-1 ring-gray-200">
                <img
                  src="{{ asset('images/AguacateQuintal.jpg') }}"
                  alt="Avatar"
                  class="h-full w-full object-cover">
              </div>
              <div class="min-w-0">
                <h3 class="truncate text-base font-bold text-gray-900">
                  {{ $cliente->nombre }} {{ $cliente->apellido }}
                </h3>
                <p class="truncate text-sm text-gray-600">{{ $cliente->usuario }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Tel: {{ $cliente->telefono }}</p>
              </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t p-4">
              <form action="{{ route('admin.eliminarclientes', $cliente->id) }}" method="POST"
                    onsubmit="return confirmDelete(event, '{{ $cliente->nombre }} {{ $cliente->apellido }}')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-4 py-2 text-xs font-semibold text-white shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400">
                  <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 7h12m-9 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m-7 0h8l-1 13a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 7Z"/>
                  </svg>
                  Eliminar
                </button>
              </form>
            </div>
          </article>
        @endforeach
      </section>

      <!-- PAGINACIÓN -->
      <div class="mt-10">
        {{ $clientes->onEachSide(1)->links() }}
      </div>
    @else
      <!-- EMPTY STATE -->
      <div class="mt-16 rounded-3xl border border-dashed border-indigo-200 bg-indigo-50/40 p-10 text-center">
        <h3 class="text-xl font-semibold text-indigo-700">No hay clientes registrados</h3>
        <p class="mt-2 text-sm text-gray-600">Cuando se registren, aparecerán aquí.</p>
      </div>
    @endif
  </main>

  <!-- FOOTER pegado al fondo (oculto en móvil para no chocar con la bottom bar fija) -->
  <footer class="mt-auto hidden md:block">
    @include('components.footer')
  </footer>

  <script>
    // Confirmación al eliminar
    function confirmDelete(e, nombre) {
      if (!confirm(`¿Eliminar al cliente "${nombre}"? Esta acción no se puede deshacer.`)) {
        e.preventDefault();
        return false;
      }
      return true;
    }

    // Filtro en cliente (nombre, correo, teléfono)
    const searchInput = document.getElementById('search');
    const cardsGrid   = document.getElementById('cards');
    const countBadge  = document.getElementById('count');

    const normalize = (s) => (s || '').toString().trim().toLowerCase();

    function applyFilter() {
      if (!cardsGrid) return;
      const q = normalize(searchInput?.value);
      const cards = cardsGrid.querySelectorAll('.client-card');
      let visible = 0;

      cards.forEach(card => {
        const haystack = [card.dataset.name, card.dataset.email, card.dataset.phone].join(' ');
        const show = haystack.includes(q);
        card.classList.toggle('hidden', !show);
        if (show) visible++;
      });

      if (q && countBadge) {
        countBadge.textContent = `${visible} resultado${visible === 1 ? '' : 's'}`;
        countBadge.classList.remove('hidden');
      } else {
        countBadge.classList.add('hidden');
      }
    }

    searchInput?.addEventListener('input', applyFilter);
  </script>
</body>
</html>
