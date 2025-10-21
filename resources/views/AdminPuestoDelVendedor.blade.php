<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Puesto del vendedor</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

  <!-- NAV DESKTOP -->
  <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
    <a href="{{ route('admin.index') }}">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
        TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
      </h1>
    </a>
    <div class="flex gap-8">
      <a href="{{ route('admin.index') }}"
        class="font-medium uppercase text-sm hover:text-indigo-600 transition">Área</a>
      <a href="{{ route('admin.vendedores') }}"
        class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
      <a href="{{ route('admin.clientes') }}"
        class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
      <a href="{{ route('AdminProfileVista') }}"
        class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
        Perfil
      </a>
    </div>
  </nav>

  <!-- NAV MÓVIL -->
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

  <main class="max-w-6xl mx-auto px-4 pt-10 pb-28">

    <!-- BOTÓN DE REGRESO -->
    <div class="mb-6">
      <button onclick="history.back()"
        class="inline-flex items-center gap-2 rounded-full bg-indigo-600 text-white px-4 py-2 text-sm font-semibold shadow hover:bg-indigo-500 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>

      </button>
    </div>

    <!-- CABECERA DEL PUESTO -->
    <header class="flex flex-col lg:flex-row items-center justify-between gap-6">
      <div class="min-w-0">
        <p class="text-sm text-gray-600">
          Puesto #{{ $vendedor->numero_puesto }} — <span class="font-medium">{{ $mercadoLocal->nombre }}</span>
        </p>
        <h2 class="mt-1 text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
          {{ $vendedor->nombre_del_local }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
          Propietario: {{ $vendedor->nombre }} {{ $vendedor->apellidos }} · Tel: {{ $vendedor->telefono }}
        </p>
      </div>

      <div class="relative h-36 w-36 md:h-44 md:w-44 overflow-hidden rounded-2xl ring-2 ring-indigo-100 shadow">
        <img src="{{ asset('images/' . $vendedor->imagen_de_referencia) }}" alt="Avatar del vendedor"
          class="h-full w-full object-cover">
      </div>
    </header>

    <!-- LISTA DE PRODUCTOS -->
    <section class="mt-10">
      @if ($products->isEmpty())
        <div class="rounded-3xl border border-dashed border-indigo-200 bg-indigo-50/40 p-10 text-center">
          <h3 class="text-xl font-semibold text-indigo-700">Este puesto aún no tiene productos</h3>
          <p class="mt-2 text-sm text-gray-600">Cuando el vendedor los publique, aparecerán aquí.</p>
        </div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($products as $product)
            <article
              class="group rounded-2xl bg-white shadow ring-1 ring-gray-200 overflow-hidden hover:shadow-lg transition">
              <div class="h-48 w-full overflow-hidden">
                <img src="{{ asset('images/' . $product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}"
                  class="h-full w-full object-cover group-hover:scale-[1.02] transition">
              </div>

              <div class="p-5">
                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $product->description }}</p>

                <div class="mt-4 flex items-center justify-between">
                  <span class="text-base font-extrabold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                  <div class="flex items-center gap-1 text-sm text-gray-600">
                    <span>4.5</span>
                    <img class="w-4 h-4" src="{{ asset('images/estrella.png') }}" alt="Rating">
                  </div>
                </div>

                <div class="mt-4">
                  <a href="{{ route('admin.verproducto', $product->id) }}"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Ver producto
                  </a>
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div class="mt-6">
          {{ $products->onEachSide(1)->links() }}
        </div>
      @endif
    </section>
  </main>

  @include('components.footer')
</body>

</html>