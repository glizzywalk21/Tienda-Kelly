<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Reserva · Detalle</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

@php
  $estado   = strtolower($reservation->estado ?? 'pendiente');
  $badgeCls =
      $estado === 'pagada'     ? 'bg-green-100 text-green-700 ring-green-200' :
      ($estado === 'entregada' ? 'bg-blue-100 text-blue-700 ring-blue-200' :
      ($estado === 'cancelada' ? 'bg-red-100 text-red-700 ring-red-200' :
                                 'bg-yellow-100 text-yellow-700 ring-yellow-200'));
  $cliente  = trim(($reservation->user->nombre ?? '').' '.($reservation->user->apellido ?? ''));
  $correo   = $reservation->user->usuario ?? '';
@endphp

<body class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

  <!-- NAVBAR DESKTOP -->
  <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
    <a href="{{ route('admin.index') }}">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
        TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
      </h1>
    </a>
    <div class="flex gap-8">
      <a href="{{ route('admin.index') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Áreas</a>
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
      <!-- ENCABEZADO -->
      <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
          <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
            Reserva #{{ $reservation->id }}
          </h2>
          <div class="mt-2 flex flex-wrap items-center gap-3">
            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold ring-1 {{ $badgeCls }}">
              {{ ucfirst($estado) }}
            </span>
            <span class="text-sm text-gray-600">
              Fecha: {{ optional($reservation->created_at)->format('d/m/Y H:i') }}
            </span>
          </div>
        </div>

        <div class="flex items-center gap-3">
          {{-- Forzar descarga directa del recibo --}}
          <a href="{{ route('reservas.pdf', $reservation->id) }}?download=1"
             download="recibo_reserva_{{ $reservation->id }}.pdf"
             class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Descargar Recibo (PDF)
          </a>
          <a href="{{ route('reservations.index') }}"
             class="rounded-xl bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">
            ← Volver al listado
          </a>
        </div>
      </div>

      <!-- CLIENTE Y RESUMEN -->
      <section class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <article class="rounded-2xl bg-white p-5 ring-1 ring-gray-200">
          <h3 class="text-sm font-semibold text-gray-700">Cliente</h3>
          <div class="mt-3 space-y-1 text-sm text-gray-700">
            <p class="font-medium">{{ $cliente ?: 'N/D' }}</p>
            <p class="text-gray-600">{{ $correo ?: '—' }}</p>
          </div>
        </article>

        <article class="rounded-2xl bg-white p-5 ring-1 ring-gray-200">
          <h3 class="text-sm font-semibold text-gray-700">Retiro</h3>
          <p class="mt-3 text-sm text-gray-700 capitalize">
            {{ $reservation->retiro ?: '—' }}
          </p>
        </article>

        <article class="rounded-2xl bg-white p-5 ring-1 ring-gray-200">
          <h3 class="text-sm font-semibold text-gray-700">Resumen</h3>
          <div class="mt-3 text-sm text-gray-700">
            <div class="flex justify-between">
              <span>Artículos</span>
              <span>{{ $reservation->items->count() }}</span>
            </div>
            <div class="mt-2 flex justify-between font-semibold">
              <span>Total</span>
              <span>${{ number_format($reservation->total ?? 0, 2) }}</span>
            </div>
          </div>
        </article>
      </section>

      <section class="mt-6 rounded-2xl bg-white p-4 ring-1 ring-yellow-200">
        <p class="text-sm text-yellow-600">
          Esta vista es <b>únicamente de lectura</b> para el Administrador. La gestión de estado la realiza el vendedor correspondiente.
        </p>
      </section>

      <!-- ÍTEMS -->
      <section class="mt-6 rounded-2xl bg-white ring-1 ring-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b">
          <h3 class="text-sm font-semibold text-gray-700">Artículos de la reserva</h3>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Producto</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Vendedor</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Área</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Cant.</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Precio</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600">Subtotal</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
              @forelse ($reservation->items as $it)
                @php
                  $prodName = $it->product->nombre ?? $it->nombre ?? '—';
                  $img = $it->product->imagen_referencia ?? null;
                  $vend = $it->vendedor;
                  $vendName = $vend
                      ? ($vend->nombre_del_local ?: trim(($vend->nombre ?? '').' '.($vend->apellidos ?? '')))
                      : '—';
                  $area = $vend?->mercadoLocal?->nombre ?? '—';
                @endphp
                <tr>
                  <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                      <div class="h-12 w-12 overflow-hidden rounded-lg ring-1 ring-gray-200 bg-white shrink-0">
                        <img src="{{ $img ? asset('images/'.$img) : asset('images/ReservasIcon.png') }}"
                             alt="Prod"
                             class="h-full w-full object-cover">
                      </div>
                      <div class="min-w-0">
                        <div class="text-sm font-medium text-gray-900">{{ $prodName }}</div>
                        @if(!empty($it->descripcion))
                          <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($it->descripcion, 70) }}</div>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-700">{{ $vendName }}</td>
                  <td class="px-4 py-3 text-sm text-gray-700">{{ $area }}</td>
                  <td class="px-4 py-3 text-right text-sm text-gray-700">{{ $it->quantity }}</td>
                  <td class="px-4 py-3 text-right text-sm text-gray-700">${{ number_format($it->precio ?? 0, 2) }}</td>
                  <td class="px-4 py-3 text-right text-sm font-semibold text-gray-900">${{ number_format($it->subtotal ?? 0, 2) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                    No hay artículos en esta reserva.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>

    </div>
  </main>

  <footer class="mt-auto hidden md:block">
    @include('components.footer')
  </footer>
</body>
</html>
