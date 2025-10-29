<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Admin · Clientes</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">

  <!-- SweetAlert2: tema Material UI (robusto y elegante) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui@5/material-ui.min.css">
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
      <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('images/admin.home.nav.png') }}"
          alt="Inicio"></a>
      <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}"
          alt="Vendedores"></a>
      <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('images/admin.users.nav.png') }}"
          alt="Clientes"></a>
      <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}"
          alt="Perfil"></a>
    </div>
  </div>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="flex-1 max-w-6xl mx-auto px-4 pt-10 pb-28">
    <!-- TÍTULO + BUSCADOR -->
    <header class="mb-8">
      <h2 class="text-center text-4xl md:text-5xl font-extrabold text-indigo-600">Listado de Clientes</h2>

      <!-- Flash messages (puedes dejarlas o cambiarlas por Swal si quieres) -->
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
          <input id="search" type="text" placeholder="Buscar por nombre, correo o teléfono…"
            class="w-full rounded-2xl border-gray-300 bg-white/80 px-4 py-3 pr-10 shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300">
          <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="m21 21-4.35-4.35M17 10.5A6.5 6.5 0 1 1 4 10.5a6.5 6.5 0 0 1 13 0Z" />
          </svg>
        </div>
        <span id="count" class="hidden text-sm text-gray-600"></span>
      </div>
    </header>

    <!-- GRID DE TARJETAS -->
    @if ($clientes->count() > 0)
      <section id="cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($clientes as $cliente)
          <article
            class="client-card group overflow-hidden rounded-2xl bg-white shadow ring-1 ring-gray-200 hover:shadow-lg transition"
            data-name="{{ strtolower(($cliente->nombre ?? '') . ' ' . ($cliente->apellido ?? '')) }}"
            data-email="{{ strtolower($cliente->usuario ?? '') }}" data-phone="{{ strtolower($cliente->telefono ?? '') }}">

            <div class="flex items-center gap-4 p-5">
              <div class="flex items-center gap-4 w-full">
                <div class="relative h-16 w-16 shrink-0 overflow-hidden rounded-xl ring-1 ring-gray-200">
                  <img src="{{ $cliente->avatar_url }}" alt="Avatar de {{ $cliente->nombre }} {{ $cliente->apellido }}"
                    class="h-full w-full object-cover" loading="lazy" decoding="async"
                    onerror="this.src='{{ asset('images/default-avatar.jpg') }}'">
                </div>

                <div class="min-w-0 flex-1">
                  <h3 class="text-lg font-semibold text-gray-800 truncate">
                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                  </h3>
                  <p class="text-sm text-gray-600 truncate">
                    <span class="font-semibold text-indigo-500">Cliente</span>
                  </p>
                  <p class="text-sm text-gray-600 truncate"><b>Correo:</b> {{ $cliente->usuario }}</p>
                  <p class="text-xs text-gray-500 mt-0.5"><b>Tel:</b> {{ $cliente->telefono }}</p>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t p-4">
              <form action="{{ route('admin.eliminarclientes', $cliente->id) }}" method="POST"
                onsubmit="return confirmDelete(event, '{{ $cliente->nombre }} {{ $cliente->apellido }}')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-4 py-2 text-xs font-semibold text-white shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400">
                  <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M6 7h12m-9 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m-7 0h8l-1 13a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 7Z" />
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

  <!-- FOOTER -->
  <footer class="mt-auto hidden md:block">
    @include('components.footer')
  </footer>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    (() => {
      // Helper anti-XSS
      function escapeHtml(s = '') {
        return String(s).replace(/[&<>"']/g, m => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[m]));
      }

      // HAZLA GLOBAL para el onsubmit inline
      window.confirmDelete = async function (e, nombre) {
        const form = e.target || e.currentTarget;
        if (!form) return true;
        if (form.dataset.confirmed === '1') return true;
        e.preventDefault();

        // Fallback si SweetAlert2 no cargó
        if (typeof Swal === 'undefined' || typeof Swal.fire !== 'function') {
          if (window.confirm(`¿Eliminar al cliente "${nombre}"? Esta acción no se puede deshacer.`)) {
            form.dataset.confirmed = '1';
            form.submit();
          }
          return false;
        }

        try {
          const result = await Swal.fire({
            icon: 'warning',
            iconColor: '#ef4444',
            title: '¿Eliminar cliente?',
            html: `
          <p class="text-base text-gray-900 font-semibold">${escapeHtml(nombre)}</p>
          <p class="mt-2 text-sm text-gray-600">Esta acción no se puede deshacer.</p>
        `,
            width: 520,
            backdrop: 'rgba(15,23,42,0.45)',
            showCancelButton: true,
            reverseButtons: true,
            allowOutsideClick: false,
            focusCancel: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            buttonsStyling: false, // usamos Tailwind
            customClass: {
              popup: 'rounded-2xl shadow-2xl',
              title: 'text-xl text-center',
              htmlContainer: 'text-center',
              actions: 'flex justify-center gap-3 mt-6',
              confirmButton: 'inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400',
              cancelButton: 'inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100'
            },
            didOpen: () => {
              // Forzamos layout ícono + texto en línea (por si hay CSS global raro)
              const c = Swal.getConfirmButton();
              if (c) {
                c.innerHTML = `
              <span class="flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 6h18M8 6l1-2h6l1 2M6 6l1 14a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-14"/>
                </svg>
                <span>Eliminar</span>
              </span>
            `;
              }
              const k = Swal.getCancelButton();
              if (k) k.textContent = 'Cancelar';
            }
          });

          if (result.isConfirmed) {
            form.dataset.confirmed = '1';
            form.submit();
          }
          return false;
        } catch (err) {
          // Si algo falla, usamos confirm() y seguimos
          console.error('SweetAlert2 error:', err);
          if (window.confirm(`¿Eliminar al cliente "${nombre}"? Esta acción no se puede deshacer.`)) {
            form.dataset.confirmed = '1';
            form.submit();
          }
          return false;
        }
      };
    })();
  </script>

</body>

</html>