<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Producto · Admin · TiendaKelly</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

@php
  // Relaciones seguras
  $vend   = $product->vendedor ?? null;
  $area   = $vend?->mercadoLocal ?? null;

  $price  = number_format($product->price ?? 0, 2);
  $stock  = $product->stock ?? null;
  $img    = $product->imagen_referencia ? asset('images/'.$product->imagen_referencia) : asset('images/placeholder.png');

  // Etiquetas/estados
  $stockBadge = is_null($stock)
    ? 'bg-gray-100 text-gray-700 ring-gray-200'
    : ($stock > 0 ? 'bg-green-100 text-green-700 ring-green-200' : 'bg-red-100 text-red-700 ring-red-200');

  $vendName = $vend
    ? ($vend->nombre_del_local ?: trim(($vend->nombre ?? '').' '.($vend->apellidos ?? '')))
    : '—';

  $areaName = $area->nombre ?? '—';
@endphp

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800 min-h-screen flex flex-col">

  <!-- NAVBAR DESKTOP -->
  <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
  <a href="{{ route('admin.index') }}">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
        TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
      </h1>
    </a>
    <div class="flex gap-8">
  <a href="{{ route('admin.areas') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Área</a>
      <a href="{{ route('admin.vendedores') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
      <a href="{{ route('admin.clientes') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
      <a href="{{ route('AdminProfileVista')}}"
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
      <a href="{{ route('AdminProfileVista')}}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil"></a>
    </div>
  </div>

  <main class="flex-1 pb-28 md:pb-12">
    <div class="mx-auto mt-8 md:mt-10 px-4 max-w-7xl">
      {{-- Flash messages --}}
      @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 text-sm">
          {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 text-sm">
          {{ session('error') }}
        </div>
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        {{-- Imagen del producto --}}
        <div class="rounded-2xl overflow-hidden shadow ring-1 ring-gray-200 bg-white">
          <img class="w-full h-[360px] md:h-[520px] object-cover" src="{{ $img }}" alt="Producto">
        </div>

        {{-- Detalle del producto (sin compra) --}}
        <div class="bg-white p-6 rounded-2xl shadow ring-1 ring-gray-200">
          <div class="flex items-start justify-between gap-4">
            <h2 class="font-extrabold text-2xl lg:text-3xl text-gray-900 leading-tight">
              {{ $product->name }}
            </h2>

            @if(!is_null($stock))
              <span class="shrink-0 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $stockBadge }}">
                {{ $stock > 0 ? "Stock: $stock" : 'Sin stock' }}
              </span>
            @endif
          </div>

          <div class="mt-2 text-sm text-gray-600">
            Vendedor:
            <span class="font-medium text-gray-800">{{ $vendName }}</span>
            @if($vend)
              <a href="{{ route('admin.vervendedores', $vend->id) }}"
                 class="ml-2 text-indigo-600 hover:text-indigo-500 underline decoration-indigo-300">
                Ver puesto
              </a>
            @endif
          </div>

          <div class="mt-1 text-sm text-gray-600">
            Área: <span class="font-medium text-gray-800">{{ $areaName }}</span>
            @if($area)
              <a href="{{ route('admin.vermercados', $area->id) }}"
                 class="ml-2 text-indigo-600 hover:text-indigo-500 underline decoration-indigo-300">
                Ver área
              </a>
            @endif
          </div>

          <p class="mt-5 text-gray-700 leading-relaxed">
            {{ $product->description }}
          </p>

          <div class="mt-6 rounded-xl bg-indigo-50/60 ring-1 ring-indigo-200 p-4 flex items-center justify-between">
            <span class="text-sm text-gray-600">Precio</span>
            <span class="text-2xl font-extrabold text-indigo-700">${{ $price }}</span>
          </div>

          {{-- Propiedades adicionales --}}
          <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            @if(!empty($product->clasificacion))
              <div class="rounded-lg border border-gray-200 p-3">
                <div class="text-xs text-gray-500">Clasificación</div>
                <div class="text-sm font-medium text-gray-800">{{ $product->clasificacion }}</div>
              </div>
            @endif

            @if(!empty($product->estado))
              <div class="rounded-lg border border-gray-200 p-3">
                <div class="text-xs text-gray-500">Estado</div>
                <div class="text-sm font-medium text-gray-800 capitalize">{{ $product->estado }}</div>
              </div>
            @endif

            @if(!empty($product->sku))
              <div class="rounded-lg border border-gray-200 p-3">
                <div class="text-xs text-gray-500">SKU</div>
                <div class="text-sm font-medium text-gray-800">{{ $product->sku }}</div>
              </div>
            @endif

            @if(!empty($product->created_at))
              <div class="rounded-lg border border-gray-200 p-3">
                <div class="text-xs text-gray-500">Creado</div>
                <div class="text-sm font-medium text-gray-800">
                  {{ optional($product->created_at)->format('d/m/Y H:i') }}
                </div>
              </div>
            @endif
          </div>

          {{-- Acciones admin (solo navegación) --}}
          <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ url()->previous() }}"
               class="rounded-xl bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">
              ← Volver
            </a>
            @if($vend)
              <a href="{{ route('admin.vervendedores', $vend->id) }}"
                 class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-indigo-700 ring-1 ring-indigo-200 hover:bg-indigo-50">
                Ver puesto del vendedor
              </a>
            @endif
          </div>
        </div>
      </div>

      {{-- Otros productos del mismo vendedor (solo vista) --}}
      @if(isset($related) && $related->count() > 0)
        <section class="mt-16">
          <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-900 mb-6">Otros productos del vendedor</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($related as $p)
              @php
                $pimg = $p->imagen_referencia ? asset('images/'.$p->imagen_referencia) : asset('images/placeholder.png');
              @endphp
              <a href="{{ route('admin.verproducto', $p->id) }}"
                 class="group bg-white rounded-2xl shadow ring-1 ring-gray-200 overflow-hidden hover:shadow-lg transition">
                <div class="h-48 w-full overflow-hidden bg-white">
                  <img class="h-full w-full object-cover group-hover:scale-105 transition" src="{{ $pimg }}" alt="{{ $p->name }}">
                </div>
                <div class="p-4">
                  <h3 class="font-semibold text-gray-900 truncate">{{ $p->name }}</h3>
                  <div class="mt-2 text-indigo-600 font-bold">${{ number_format($p->price ?? 0, 2) }}</div>
                </div>
              </a>
            @endforeach
          </div>
        </section>
      @endif
    </div>
  </main>

  @include('components.footer')
</body>
</html>