<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Registrar Vendedor · Admin · TiendaKelly</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800 min-h-screen flex flex-col">

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

  <main class="flex-1 pb-28 md:pb-16">
    <div class="max-w-3xl mx-auto mt-10 px-4">
      <!-- Título -->
      <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">
          Registrar <span class="text-indigo-600">Vendedor</span>
        </h1>
        <p class="mt-2 text-sm text-gray-600">Completa la información del vendedor y su área.</p>
      </div>

      <!-- Errores globales -->
      @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 text-sm">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- FORM -->
      <form method="POST" action="{{ route('admin.guardarvendedores') }}" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow ring-1 ring-gray-200 p-6 space-y-6">
        @csrf

        <!-- Imagen -->
        <section>
          <label for="imagen_de_referencia" class="block text-sm font-medium text-gray-700 mb-2">
            Imagen del vendedor o su área <span class="text-gray-400 font-normal">(PNG/JPG/JPEG, máx 2MB)</span>
          </label>
          <div class="grid grid-cols-1 md:grid-cols-[1fr,280px] gap-4 items-start">
            <input
              type="file"
              required
              accept=".png,.jpg,.jpeg"
              name="imagen_de_referencia"
              id="imagen_de_referencia"
              class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
            />
            <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-2">
              <img id="img-preview" class="w-full h-40 object-cover rounded-lg hidden" src="#" alt="Vista previa" />
            </div>
          </div>
          <p id="file-name" class="mt-2 text-xs text-gray-500">Ningún archivo seleccionado</p>
          @error('imagen_de_referencia')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </section>

        <hr class="border-gray-200"/>

        <!-- Acceso -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input
              required
              type="email"
              name="usuario"
              id="usuario"
              value="{{ old('usuario') }}"
              autocomplete="email"
              placeholder="vendedor@email.com"
              class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            @error('usuario')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
              <input
                type="password"
                required
                minlength="8"
                maxlength="8"
                name="password"
                id="password"
                autocomplete="new-password"
                placeholder="8 caracteres"
                class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
              />
              @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar</label>
              <input
                type="password"
                required
                minlength="8"
                maxlength="8"
                name="password_confirmation"
                id="password_confirmation"
                autocomplete="new-password"
                placeholder="Repite la contraseña"
                class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
              />
            </div>
          </div>

          <div class="md:col-span-2 flex items-center gap-2">
            <input type="checkbox" id="show-passwords" class="h-4 w-4 rounded border-gray-300">
            <label for="show-passwords" class="text-sm text-gray-600">Mostrar contraseñas</label>
          </div>
        </section>

        <hr class="border-gray-200"/>

        <!-- Datos personales -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input
              required
              type="text"
              name="nombre"
              id="nombre"
              value="{{ old('nombre') }}"
              placeholder="Ej. Juan"
              class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            @error('nombre')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
            <input
              required
              type="text"
              name="apellidos"
              id="apellidos"
              value="{{ old('apellidos') }}"
              placeholder="Ej. Pérez Gómez"
              class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            @error('apellidos')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input
              type="text"
              name="telefono"
              id="telefono"
              value="{{ old('telefono') }}"
              placeholder="7777-8888"
              pattern="^[0-9]{4}-?[0-9]{4}$"
              title="Formato esperado: 7777-8888"
              class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            @error('telefono')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="numero_puesto" class="block text-sm font-medium text-gray-700 mb-1">Número de Puesto</label>
            <input
              required
              type="text"
              name="numero_puesto"
              id="numero_puesto"
              value="{{ old('numero_puesto') }}"
              placeholder="Ej. 12-B"
              class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            @error('numero_puesto')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="md:col-span-2">
            <label for="nombre_del_local" class="block text-sm font-medium text-gray-700 mb-1">Nombre del área (público)</label>
            <input
              type="text"
              name="nombre_del_local"
              id="nombre_del_local"
              value="{{ old('nombre_del_local') }}"
              placeholder="Ej. Pupusería La Bendición"
              class="w-full border rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            @error('nombre_del_local')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>
        </section>

        <hr class="border-gray-200"/>

        <!-- Mercado -->
        <section>
          <label for="fk_mercado" class="block text-sm font-medium text-gray-700 mb-1">Categoría del área</label>
          <select
            name="fk_mercado"
            id="fk_mercado"
            class="w-full border rounded-lg px-3 py-2 text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
            required
          >
            <option value="" disabled selected>Seleccione un área</option>
            @foreach($mercados as $mercado)
              <option value="{{ $mercado->id }}" {{ old('fk_mercado') == $mercado->id ? 'selected' : '' }}>
                {{ $mercado->nombre }}
              </option>
            @endforeach
          </select>
          @error('fk_mercado')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
          @enderror
          <p class="mt-2 text-xs text-gray-500">Esta categoría asocia el puesto del vendedor con un área del mercado.</p>
        </section>

        <!-- Botones -->
        <div class="flex flex-wrap items-center gap-3 pt-2">
          <a href="{{ route('admin.vendedores') }}"
             class="rounded-xl bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">
            ← Volver
          </a>
          <button type="submit"
                  class="rounded-xl bg-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Registrar Vendedor
          </button>
        </div>
      </form>
    </div>
  </main>

  @include('components.footer')

  <script>
    // Vista previa y nombre de archivo
    (function () {
      const input   = document.getElementById('imagen_de_referencia');
      const preview = document.getElementById('img-preview');
      const fileNameSpan = document.getElementById('file-name');

      if (!input) return;

      input.addEventListener('change', function (event) {
        const file = event.target.files && event.target.files[0] ? event.target.files[0] : null;
        if (!file) {
          if (preview) { preview.src = '#'; preview.classList.add('hidden'); }
          if (fileNameSpan) fileNameSpan.textContent = 'Ningún archivo seleccionado';
          return;
        }
        if (fileNameSpan) fileNameSpan.textContent = file.name;

        const reader = new FileReader();
        reader.onload = function (e) {
          if (preview) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
          }
        };
        reader.readAsDataURL(file);
      });
    })();

    // Mostrar/Ocultar contraseñas
    (function () {
      const toggle = document.getElementById('show-passwords');
      const pass   = document.getElementById('password');
      const pass2  = document.getElementById('password_confirmation');
      if (!toggle) return;
      toggle.addEventListener('change', function () {
        const type = this.checked ? 'text' : 'password';
        if (pass)  pass.type  = type;
        if (pass2) pass2.type = type;
      });
    })();
  </script>

</body>
</html>
