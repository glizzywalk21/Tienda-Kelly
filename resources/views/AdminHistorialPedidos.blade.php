<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Admin · Reservas</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

  <!-- NAVBAR DESKTOP -->
  <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
  <a href="{{ route('admin.index') }}">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
        TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
      </h1>
    </a>
    <div class="flex gap-8">
  <a href="{{ route('admin.areas') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Áreas</a>
      <a href="{{ route('admin.vendedores') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
      <a href="{{ route('admin.clientes') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
      <a href="{{ route('reservations.index') }}" class="font-semibold uppercase text-sm text-indigo-600">Reservas</a>
      <a href="{{ route('AdminProfileVista') }}"
         class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
        Perfil
      </a>
    </div>
  </nav>

  <!-- NAVBAR MÓVIL -->
  <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
    <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around items-center">
  <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Inicio"></a>
      <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Vendedores"></a>
      <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Clientes"></a>
      <a href="{{ route('reservations.index') }}"><img class="w-6" src="{{ asset('images/ReservasIcon.png') }}" alt="Reservas"></a>
      <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil"></a>
    </div>
  </div>

  <main class="flex-1 pb-28 md:pb-16">
    <div class="mx-auto max-w-6xl px-4 pt-10">
      <header class="mb-8">
        <h2 class="text-center text-4xl md:text-5xl font-extrabold text-indigo-600">Reservas</h2>

        @if(session('success'))
          <div class="mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 text-sm">
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 text-sm">
            {{ session('error') }}
          </div>
        @endif

        <!-- Buscador (servidor + cliente) -->
        <form method="GET" action="{{ route('reservations.index') }}" class="mt-6 flex items-center gap-3">
          <div class="relative flex-1">
            <input id="search"
                   name="q"
                   value="{{ $q ?? '' }}"
                   type="text"
                   placeholder="Buscar por #reserva, cliente, correo, estado, área o puesto…"
                   class="w-full rounded-2xl border-gray-300 bg-white/80 px-4 py-3 pr-10 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300">
            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M17 10.5A6.5 6.5 0 1 1 4 10.5a6.5 6.5 0 0 1 13 0Z"/>
            </svg>
          </div>
          <button type="submit"
                  class="rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Buscar
          </button>
          <span id="count" class="hidden text-sm text-gray-600"></span>
        </form>
      </header>

      @if ($reservations->count() > 0)
        <section id="cards" class="space-y-4">
          @foreach ($reservations as $r)
            @php
              $estado = strtolower($r->estado ?? 'pendiente');
              $badge =
                $estado === 'pagada'     ? 'bg-green-100 text-green-700 ring-green-200' :
                ($estado === 'entregada' ? 'bg-blue-100 text-blue-700 ring-blue-200' :
                ($estado === 'cancelada' ? 'bg-red-100 text-red-700 ring-red-200' :
                                            'bg-yellow-100 text-yellow-700 ring-yellow-200'));

              // --- vendedores únicos por reserva ---
              $vendorNames = $r->items->map(function($it){
                  $v = $it->vendedor;
                  return $v
                    ? (trim($v->nombre_del_local ?: (($v->nombre ?? '').' '.($v->apellidos ?? ''))))
                    : null;
              })->filter()->unique()->values();

              $singleVendor = $vendorNames->count() === 1 ? $vendorNames->first() : null;
              $vendorsLabel = $singleVendor
                  ? $singleVendor
                  : ($vendorNames->isEmpty() ? '—' : ($vendorNames->take(1)->implode(', ').' +'.($vendorNames->count()-1)));

              // áreas (opcional)
              $markets = $r->items->map(fn($it)=>$it->vendedor?->mercadoLocal?->nombre)->filter()->unique()->values();

              $itemsCount  = $r->items?->count() ?? 0;
              $firstItem   = $r->items?->first();
              $firstName   = $firstItem?->product->nombre ?? $firstItem?->descripcion ?? '—';
              $img         = $firstItem?->product->imagen_referencia ?? null;
              $clienteName = trim(($r->user->nombre ?? '').' '.($r->user->apellido ?? ''));
              $clienteMail = $r->user->usuario ?? '';

              // Para el filtro en vivo (incluye vendedor y área)
              $haystack = "#{$r->id} {$estado} {$clienteName} {$clienteMail} ".
                          implode(' ', $vendorNames->all()).' '.implode(' ', $markets->all());
            @endphp

            <article
              class="res-card group flex items-stretch gap-4 rounded-2xl bg-white ring-1 ring-gray-200 p-4 hover:shadow-md transition"
              data-haystack="{{ Str::lower($haystack) }}">

              <div class="relative h-16 w-16 shrink-0 overflow-hidden rounded-xl ring-1 ring-gray-200 bg-white">
                <img
                  src="{{ $img ? asset('images/'.$img) : asset('images/ReservasIcon.png') }}"
                  alt="Imagen referencia"
                  class="h-full w-full object-cover">
              </div>

              <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2">
                  <h3 class="truncate text-base font-bold text-gray-900">Reserva #{{ $r->id }}</h3>
                  <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold ring-1 {{ $badge }}">
                    {{ ucfirst($estado) }}
                  </span>
                </div>

                <div class="mt-1 grid grid-cols-1 md:grid-cols-2 gap-x-6 text-sm text-gray-600">
                  <p class="truncate">
                    <span class="font-medium text-gray-800">Cliente:</span>
                    {{ $clienteName ?: 'N/D' }}
                    <span class="text-gray-400"> · </span>
                    {{ $clienteMail ?: '—' }}
                  </p>

                  <p class="truncate">
                    <span class="font-medium text-gray-800">
                      {{ $singleVendor ? 'Puesto:' : 'Puestos:' }}
                    </span>
                    {{ $vendorsLabel }}
                  </p>

                  <p>
                    <span class="font-medium text-gray-800">Fecha:</span>
                    {{ optional($r->created_at)->format('d/m/Y H:i') }}
                  </p>

                  <p class="truncate">
                    <span class="font-medium text-gray-800">Áreas:</span>
                    {{ $markets->isEmpty() ? '—' : $markets->take(2)->implode(', ') }}
                    @if($markets->count() > 2)
                      <span class="text-gray-400"> +{{ $markets->count() - 2 }}</span>
                    @endif
                  </p>

                  <p class="truncate">
                    <span class="font-medium text-gray-800">Artículos:</span>
                    {{ $itemsCount }}
                    @if($firstName && $itemsCount > 0)
                      <span class="text-gray-400"> · </span>
                      {{ Str::limit($firstName, 40) }} @if($itemsCount > 1) +{{ $itemsCount - 1 }} @endif
                    @endif
                  </p>

                  <p>
                    <span class="font-medium text-gray-800">Total:</span>
                    ${{ number_format($r->total ?? 0, 2) }}
                  </p>
                </div>
              </div>

              <div class="flex items-center">
                <a href="{{ route('reservations.show', $r->id) }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                  Ver
                </a>
              </div>
            </article>
          @endforeach
        </section>

        <div class="mt-10">
          {{ $reservations->onEachSide(1)->links() }}
        </div>
      @else
        <div class="mt-16 rounded-3xl border border-dashed border-indigo-200 bg-indigo-50/40 p-10 text-center">
          <h3 class="text-xl font-semibold text-indigo-700">No hay reservas registradas</h3>
          <p class="mt-2 text-sm text-gray-600">Cuando existan pedidos, aparecerán aquí.</p>
        </div>
      @endif
    </div>
  </main>

  <footer class="mt-auto hidden md:block">
    @include('components.footer')
  </footer>

  <script>
    // Filtro en vivo (incluye vendedor/área gracias al data-haystack)
    const searchInput = document.getElementById('search');
    const cardsWrap   = document.getElementById('cards');
    const countBadge  = document.getElementById('count');

    function normalize(s){ return (s||'').toString().trim().toLowerCase(); }
    function applyFilter(){
      if(!cardsWrap) return;
      const q = normalize(searchInput?.value);
      const cards = cardsWrap.querySelectorAll('.res-card');
      let visible = 0;
      cards.forEach(c=>{
        const hay = c.dataset.haystack || '';
        const show = hay.includes(q);
        c.classList.toggle('hidden', !show);
        if(show) visible++;
      });
      if(q && countBadge){
        countBadge.textContent = `${visible} resultado${visible===1?'':'s'}`;
        countBadge.classList.remove('hidden');
      }else{
        countBadge.classList.add('hidden');
      }
    }
    searchInput?.addEventListener('input', applyFilter);
  </script>
</body>
</html>
