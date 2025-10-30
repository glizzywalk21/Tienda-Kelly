<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @vite('resources/css/app.css')
  <title>Editar Vendedor</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

  <!-- Bottom bar móvil -->
  <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
    <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around items-center">
  <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Inicio"></a>
      <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Vendedores"></a>
      <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Clientes"></a>
      <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil"></a>
    </div>
  </div>

  <main class="max-w-3xl mx-auto mt-10 px-4 pb-28">
    <!-- Card / Header -->
    <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-gray-200 bg-white">
      <div class="px-6 py-8 bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
          Editar Vendedor
        </h1>
        <p class="mt-1 text-white/90">
          <span class="font-semibold">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</span>
          <span class="ml-2 inline-flex items-center rounded-full bg-white/20 px-2.5 py-0.5 text-xs font-semibold">
            ID #{{ $vendedor->id }}
          </span>
        </p>
      </div>

      <!-- Errores -->
      @if ($errors->any())
        <div class="px-6 pt-6">
          <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <!-- Form -->
      <form method="POST"
            action="{{ route('admin.actualizarvendedor', ['id' => $vendedor->id]) }}"
            enctype="multipart/form-data"
            class="px-6 pb-8 pt-6">
        @csrf
        @method('PUT') {{-- tu ruta acepta put/patch/post; usamos PUT por convención REST --}}

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

          <!-- Imagen actual -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Imagen actual</label>
            <div class="relative overflow-hidden rounded-2xl border bg-gray-50">
              <img id="img-preview"
                   class="w-full h-64 object-cover"
                   src="{{ $vendedor?->imagen_de_referencia
                          ? asset('images/' . $vendedor->imagen_de_referencia)
                          : asset('images/default.png') }}"
                   alt="Imagen del vendedor">
            </div>
            <p class="mt-2 text-xs text-gray-500">Formatos: JPG, JPEG, PNG, GIF, SVG · Máx. 2MB</p>
          </div>

          <!-- Dropzone -->
          <div class="md:col-span-2">
            <label for="imagen_de_referencia" class="block text-sm font-medium text-gray-700 mb-2">
              Subir nueva imagen (opcional)
            </label>
            <label for="imagen_de_referencia"
                   class="flex cursor-pointer items-center justify-between gap-3 rounded-2xl border-2 border-dashed border-indigo-200 bg-indigo-50/40 p-4 hover:bg-indigo-50 focus-within:ring-2 focus-within:ring-indigo-400">
              <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M12 16V8m0 0-3 3m3-3 3 3M6 20h12a2 2 0 0 0 2-2V9.5a2 2 0 0 0-.586-1.414l-3.5-3.5A2 2 0 0 0 14.5 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/>
                  </svg>
                </div>
                <div>
                  <p id="file-name" class="text-sm font-semibold text-indigo-700">Selecciona una imagen…</p>
                  <p class="text-xs text-gray-600">O arrastra y suelta aquí</p>
                </div>
              </div>
              <span class="text-xs px-2.5 py-1 rounded-full bg-white text-gray-700 border">PNG · JPG · JPEG · GIF · SVG</span>
            </label>
            <input class="sr-only"
                   type="file"
                   accept=".png,.jpg,.jpeg,.gif,.svg"
                   name="imagen_de_referencia"
                   id="imagen_de_referencia">
            @error('imagen_de_referencia')
              <div class="text-red-600 text-xs mt-2"><strong>{{ $message }}</strong></div>
            @enderror
            <div id="file-error" class="hidden mt-2 text-xs text-red-600 font-medium"></div>
          </div>

          <!-- Correo -->
          <div>
            <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input required type="email" name="usuario" id="usuario" autocomplete="email"
                   value="{{ old('usuario', $vendedor?->usuario) }}"
                   placeholder="vendedor@email.com"
                   maxlength="255"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('usuario')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>

          <!-- Password / Confirmación -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva contraseña (opcional)</label>
            <input type="password" name="password" id="password" autocomplete="new-password"
                   minlength="8"
                   placeholder="Mín. 8 caracteres"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('password')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                   minlength="8"
                   placeholder="Repite la contraseña"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('password_confirmation')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>

          <!-- Toggle mostrar contraseña -->
          <div class="md:col-span-2 flex items-center">
            <input type="checkbox" id="show-passwords" class="mr-2">
            <label for="show-passwords" class="text-sm text-gray-600">Mostrar contraseñas</label>
          </div>

          <!-- Nombre y Apellidos -->
          <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input required type="text" name="nombre" id="nombre" maxlength="255"
                   value="{{ old('nombre', $vendedor?->nombre) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('nombre')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
          <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
            <input required type="text" name="apellidos" id="apellidos" maxlength="255"
                   value="{{ old('apellidos', $vendedor?->apellidos) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('apellidos')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>

          <!-- Nombre del local -->
          <div>
            <label for="nombre_del_local" class="block text-sm font-medium text-gray-700 mb-1">Nombre del local (público)</label>
            <input required type="text" name="nombre_del_local" id="nombre_del_local" maxlength="255"
                   value="{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('nombre_del_local')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>

          <!-- Teléfono -->
          <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input required type="text" name="telefono" id="telefono"
                   value="{{ old('telefono', $vendedor?->telefono) }}"
                   placeholder="7777-8888"
                   maxlength="20"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('telefono')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>

          <!-- Número de puesto -->
          <div>
            <label for="numero_puesto" class="block text-sm font-medium text-gray-700 mb-1">Número de puesto</label>
            <input required type="number" min="1" name="numero_puesto" id="numero_puesto"
                   value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            @error('numero_puesto')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>

          <!-- Área (mercado) -->
          <div class="md:col-span-2">
            <label for="fk_mercado" class="block text-sm font-medium text-gray-700 mb-1">Área del mercado</label>
            <select name="fk_mercado" id="fk_mercado"
                    class="w-full rounded-xl border-gray-300 text-gray-700 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
              @foreach($mercados as $mercado)
                <option value="{{ $mercado->id }}"
                        {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>
                  {{ $mercado->nombre }}
                </option>
              @endforeach
            </select>
            @error('fk_mercado')
              <div class="text-red-600 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
          <a href="{{ route('admin.vendedores') }}"
             class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Cancelar
          </a>
          <button type="submit"
                  class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Actualizar vendedor
          </button>
        </div>
      </form>
    </div>
  </main>

  <script>
    // Vista previa + validación tamaño 2MB
    const inputFile   = document.getElementById('imagen_de_referencia');
    const preview     = document.getElementById('img-preview');
    const fileNameEl  = document.getElementById('file-name');
    const fileErrorEl = document.getElementById('file-error');

    inputFile?.addEventListener('change', (e) => {
      const file = e.target.files?.[0];
      if (!file) { if (fileNameEl) fileNameEl.textContent = 'Selecciona una imagen…'; return; }

      const maxBytes = 2 * 1024 * 1024;
      if (file.size > maxBytes) {
        if (fileErrorEl) {
          fileErrorEl.textContent = 'La imagen supera los 2MB. Elige una más ligera.';
          fileErrorEl.classList.remove('hidden');
        }
        e.target.value = '';
        return;
      } else {
        fileErrorEl?.classList.add('hidden');
        if (fileNameEl) fileNameEl.textContent = file.name;
      }

      const reader = new FileReader();
      reader.onload = (evt) => { if (preview) preview.src = evt.target.result; };
      reader.readAsDataURL(file);
    });

    // Mostrar / ocultar contraseñas
    document.getElementById('show-passwords')?.addEventListener('change', function () {
      const fields = [document.getElementById('password'), document.getElementById('password_confirmation')];
      fields.forEach(el => { if (el) el.type = this.checked ? 'text' : 'password'; });
    });
  </script>

</body>
</html>
