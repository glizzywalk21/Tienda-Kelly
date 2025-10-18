<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Estado de Pedidos · Tienda Kelly</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
  <style>
    .fadeInUp { animation: fadeInUp .5s ease forwards; opacity: 0; }
    @keyframes fadeInUp { 0%{opacity:0;transform:translateY(12px)} 100%{opacity:1;transform:translateY(0)} }
    .card-hover:hover { transform: translateY(-3px); transition: transform .2s ease, box-shadow .2s ease; box-shadow: 0 18px 35px rgba(0,0,0,.08); }
    .chip { padding: .25rem .75rem; border-radius: .5rem; font-size: .75rem; font-weight: 600; text-transform: uppercase; }
    .btn { display:inline-flex; align-items:center; justify-content:center; padding:.5rem 1rem; border-radius:.5rem; font-weight:600; font-size:.875rem; }
    .btn-green{ background:#16a34a; color:#fff; } .btn-green:hover{ background:#15803d; }
    .btn-red  { background:#dc2626; color:#fff; } .btn-red:hover  { background:#b91c1c; }
    .btn-amber{ background:#d97706; color:#fff; } .btn-amber:hover{ background:#b45309; }
  </style>
</head>
<body class="bg-slate-50">

  <!-- Desktop Navbar -->
  <div class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-sm sticky top-0 z-50">
    <a href="{{ route('vendedores.index') }}" class="group">
      <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
        Tienda Kelly <span class="text-indigo-500 font-extrabold group-hover:text-indigo-600 transition">Vendedores</span>
      </h1>
    </a>
    <nav class="flex gap-6">
      <a href="{{ route('vendedores.index') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600">Mi Puesto</a>
      <a href="{{ route('vendedores.productos') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600">Mis Productos</a>
      <a href="{{ route('vendedores.reservas') }}" class="text-sm font-medium text-indigo-600">Mis Reservas</a>
      <a href="{{ route('vendedores.historial') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600">Mi Historial</a>
      <a href="{{ route('vendedor.perfil') }}" class="text-sm font-semibold border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">Perfil</a>
    </nav>
  </div>

  <!-- Mobile Bottom Navbar -->
  <div class="fixed bottom-3 left-0 right-0 md:hidden flex justify-center z-40">
    <div class="bg-gray-900 rounded-2xl w-72 h-14 flex justify-around items-center px-4 shadow-lg">
      <a href="{{ route('vendedores.index') }}"><img class="w-6" src="{{ asset('images/vendedor.home.png') }}" alt=""></a>
      <a href="{{ route('vendedores.productos') }}"><img class="w-6" src="{{ asset('images/vendedor.productos.png') }}" alt=""></a>
      <a href="{{ route('vendedores.reservas') }}"><img class="w-6" src="{{ asset('images/vendedor.reservas.png') }}" alt=""></a>
      <a href="{{ route('vendedores.historial') }}"><img class="w-6" src="{{ asset('images/mercado.historial.blancopng.png') }}" alt=""></a>
      <a href="{{ route('vendedor.perfil') }}"><img class="w-6" src="{{ asset('images/vendedor.perfil.png') }}" alt=""></a>
    </div>
  </div>

  <main class="max-w-6xl mx-auto px-4 md:px-6 py-6 md:py-10">
    <!-- Header vendedor -->
    <section class="bg-white rounded-2xl shadow-sm p-5 md:p-7 mb-6 md:mb-10 flex items-start gap-5 shadow-xl">
      <div class="hidden md:block">
        <img class="w-24 h-24 rounded-full object-cover ring-2 ring-indigo-100"
             src="{{ asset('images/' . $vendedor->imagen_de_referencia) }}" alt="Vendedor" />
      </div>
      <div class="flex-1">
        <h2 class="text-xl md:text-2xl font-extrabold text-slate-800">
          {{ $vendedor->nombre_del_local }}
        </h2>
        <p class="text-slate-600">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</p>
        <div class="mt-3 flex flex-wrap items-center gap-2 text-sm">
          <span class="chip bg-slate-200 text-slate-700">Reservas activas</span>
          <span class="text-slate-600">Gestiona el estado y notifica a tus clientes</span>
        </div>
      </div>
    </section>

    <h3 class="text-2xl md:text-4xl font-extrabold text-slate-800 mb-6 md:mb-8 text-center">Mis Reservas</h3>

    @php
      $activos = $reservations->filter(fn($r) => $r->estado !== 'archivado');
    @endphp

    @if ($activos->isEmpty())
      <section class="bg-white rounded-2xl shadow-sm p-10 text-center fadeInUp">
        <img src="{{ asset('images/empty-box.png') }}" alt="" class="mx-auto w-26 h-26 md:w-28 md:h-28 opacity-70 mb-4">
        <p class="text-slate-600 text-lg">No tienes reservas activas por ahora.</p>
        <p class="text-slate-500 text-sm">Cuando lleguen, aparecerán aquí.</p>
      </section>
    @else
      <div class="space-y-6">
        @foreach ($reservations as $reservation)
          @if ($reservation->estado != 'archivado')
            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 md:p-6 card-hover fadeInUp">
              <!-- Encabezado de reserva -->
              <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                  <h4 class="text-xl font-bold text-slate-800">Reserva #{{ $reservation->id }}</h4>
                  @php
                    $badgeClass = 'bg-slate-200 text-slate-800';
                    $label = ucfirst(str_replace('_',' ', $reservation->estado));
                    switch ($reservation->estado) {
                      case 'enviado'        : $badgeClass='bg-yellow-100 text-yellow-800'; $label='Recibido'; break;
                      case 'sin_existencias': $badgeClass='bg-rose-100 text-rose-800';   $label='Sin existencias'; break;
                      case 'sin_espera'     : $badgeClass='bg-orange-100 text-orange-800'; $label='Cancelado'; break;
                      case 'en_espera'      : $badgeClass='bg-amber-100 text-amber-800'; $label='En espera'; break;
                      case 'en_entrega'     : $badgeClass='bg-blue-100 text-blue-800';   $label='En entrega'; break;
                      case 'recibido'       : $badgeClass='bg-emerald-100 text-emerald-800'; $label='Entregado'; break;
                      case 'sin_recibir'    : $badgeClass='bg-orange-100 text-orange-800'; $label='Sin recibir'; break;
                      case 'problemas'      : $badgeClass='bg-rose-100 text-rose-800';   $label='Con problemas'; break;
                    }
                  @endphp
                  <span class="chip {{ $badgeClass }}">{{ $label }}</span>
                </div>
                <div class="text-right">
                  <p class="text-sm text-slate-500">Creada: {{ optional($reservation->created_at)->format('d/m/Y H:i') }}</p>
                  @if(property_exists($reservation,'total')) 
                    <p class="text-sm text-slate-700 font-semibold">Total: ${{ number_format($reservation->total,2) }}</p>
                  @endif
                </div>
              </div>

              <!-- Items -->
              <div class="mt-4 space-y-4">
                @foreach ($reservation->items as $item)
                  <article class="p-4 md:p-5 border border-slate-200 rounded-xl bg-slate-50 hover:bg-slate-100 transition">
                    <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-5">
                      <img src="{{ asset('images/' . $item->product->imagen_referencia) }}"
                           alt="{{ $item->product->name }}"
                           class="w-24 h-24 md:w-36 md:h-36 object-cover rounded-md ring-1 ring-white shadow-sm">

                      <div class="flex-1">
                        <h5 class="text-lg font-bold text-slate-800">
                          {{ $item->product->name }}
                          <span class="text-slate-500 font-normal">· Cliente:</span>
                          <span class="text-indigo-600 font-semibold">
                            {{ $item->reservation->user->nombre }} {{ $item->reservation->user->apellido }}
                          </span>
                        </h5>

                        <dl class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                          <div>
                            <dt class="text-slate-500">Cantidad</dt>
                            <dd class="text-slate-800 font-semibold">{{ $item->quantity }}</dd>
                          </div>
                          <div>
                            <dt class="text-slate-500">Precio (c/u)</dt>
                            <dd class="text-slate-800 font-semibold">${{ number_format($item->precio,2) }}</dd>
                          </div>
                          <div>
                            <dt class="text-slate-500">Subtotal</dt>
                            <dd class="text-slate-800 font-semibold">${{ number_format($item->subtotal,2) }}</dd>
                          </div>
                          <div>
                            @php
                              $istate = $item->estado;
                              $iClass='bg-slate-200 text-slate-800';
                              $iLab = ucfirst(str_replace('_',' ', $istate));
                              switch ($istate) {
                                case 'enviado'        : $iClass='bg-yellow-100 text-yellow-800'; $iLab='Recibido'; break;
                                case 'sin_existencias': $iClass='bg-rose-100 text-rose-800';     $iLab='Sin existencias'; break;
                                case 'sin_espera'     : $iClass='bg-orange-100 text-orange-800'; $iLab='Cancelado'; break;
                                case 'en_espera'      : $iClass='bg-amber-100 text-amber-800';   $iLab='En espera'; break;
                                case 'en_entrega'     : $iClass='bg-blue-100 text-blue-800';     $iLab='En entrega'; break;
                                case 'recibido'       : $iClass='bg-emerald-100 text-emerald-800';$iLab='Entregado'; break;
                                case 'sin_recibir'    : $iClass='bg-orange-100 text-orange-800'; $iLab='Sin recibir'; break;
                                case 'problemas'      : $iClass='bg-rose-100 text-rose-800';     $iLab='Con problemas'; break;
                              }
                            @endphp
                            <dt class="text-slate-500">Estado</dt>
                            <dd><span class="chip {{ $iClass }}">{{ $iLab }}</span></dd>
                          </div>
                        </dl>

                        <!-- Acciones -->
                        <div class="mt-4">
                          @if (in_array($item->estado, ['enviado','en_espera','sin_recibir']))
                            <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST" class="flex flex-wrap gap-3">
                              @csrf
                              <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                              <button type="button" data-item="{{ $item->id }}" data-next="en_entrega" class="btn btn-green action-btn">Mi pedido está listo</button>
                              <button type="button" data-item="{{ $item->id }}" data-next="sin_existencias" class="btn btn-red action-btn">Ya no hay existencias</button>
                            </form>

                          @elseif ($item->estado == 'sin_espera')
                            <form id="form-{{ $item->id }}" action="{{ route('vendedores.eliminarrreservationitem', $item->id) }}" method="POST" class="flex gap-3">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                              <button type="button" data-item="{{ $item->id }}" data-next="eliminar" class="btn btn-red action-btn">Eliminar reserva</button>
                            </form>

                          @elseif ($reservation->estado == 'sin_recibir')
                            <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST" class="flex flex-wrap gap-3">
                              @csrf
                              <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                              <button type="button" data-item="{{ $item->id }}" data-next="en_entrega" class="btn btn-green action-btn">Mi pedido está listo</button>
                              <button type="button" data-item="{{ $item->id }}" data-next="problemas" class="btn btn-amber action-btn">Hay problemas</button>
                            </form>

                          @elseif ($item->estado == 'problemas')
                            <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST" class="flex flex-wrap gap-3">
                              @csrf
                              <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                              <button type="button" data-item="{{ $item->id }}" data-next="en_entrega" class="btn btn-green action-btn">Ya lo envié</button>
                              <button type="button" data-item="{{ $item->id }}" data-next="sin_existencias" class="btn btn-red action-btn">No hay existencia</button>
                            </form>

                          @elseif ($item->estado == 'recibido')
                            <!-- CORREGIDO: nombre de ruta correcto -->
                            <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST" class="flex gap-3">
                              @csrf
                              <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">
                              <button type="button" data-item="{{ $item->id }}" data-next="archivado" class="btn btn-green action-btn">Archivar</button>
                            </form>
                          @endif
                        </div>
                      </div>
                    </div>
                  </article>
                @endforeach
              </div>
            </section>
          @endif
        @endforeach
        <div class="h-12"></div>
      </div>
    @endif
  </main>

  @include('components.footer')

  <script>
    // Fallback clásico
    function setEstado(itemId, estado) {
      const form  = document.getElementById('form-' + itemId);
      const input = document.getElementById('estado-' + itemId);
      if (!form || !input) return;
      input.value = estado;
      form.submit();
    }

    // Envío con fetch (sin recargar) + fallback a submit si falla
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
          const itemId = e.currentTarget.getAttribute('data-item');
          const next   = e.currentTarget.getAttribute('data-next');
          const form   = document.getElementById('form-' + itemId);
          const hidden = document.getElementById('estado-' + itemId);
          if (!form || !hidden) return setEstado(itemId, next);

          hidden.value = next;

          try {
            const fd = new FormData(form);
            const resp = await fetch(form.action, {
              method: form.method || 'POST',
              headers: { 'X-Requested-With': 'XMLHttpRequest' },
              body: fd
            });
            if (!resp.ok) throw new Error('HTTP ' + resp.status);

            // Realimentación visual rápida
            const article = e.currentTarget.closest('article');
            article?.classList.add('ring-2','ring-emerald-200');
            // Opcional: actualizar badge de estado localmente (simple)
            // Aquí podrías manipular el DOM con el nuevo estado si tu endpoint responde JSON

            // Refrescar para asegurar consistencia con servidor
            location.reload();

          } catch (err) {
            // Fallback
            form.submit();
          }
        });
      });
    });
  </script>
</body>
</html>
