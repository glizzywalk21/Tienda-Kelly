<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @vite('resources/css/app.css')
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
  <title>Agregar Mercado Local</title>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">
  <!-- NAVBAR MÓVIL -->
  <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
    <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
      <div class="flex items-center">
  <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Inicio"></a>
      </div>
      <div class="flex items-center">
        <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Vendedores"></a>
      </div>
      <div class="flex items-center">
        <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Clientes"></a>
      </div>
      <div class="flex items-center">
        <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil"></a>
      </div>
    </div>
  </div>
  <!-- FIN NAVBAR -->

  <main class="max-w-3xl mx-auto px-4 py-10 md:py-16">
    <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-gray-200 bg-white">
      <!-- Header -->
      <div class="px-6 py-8 bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Agregar Área</h1>
        <p class="text-white/90 text-sm mt-1">LOCAL</p>
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
      <form method="POST" action="{{ route('admin.guardarmercados') }}" enctype="multipart/form-data" class="px-6 pb-8 pt-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <!-- Vista previa -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Vista previa</label>
            <div class="relative overflow-hidden rounded-2xl border bg-gray-50">
              <img id="img-preview" src="{{ asset('images/default.png') }}" alt="Vista previa"
                   class="w-full h-64 object-cover">
            </div>
            <p class="mt-2 text-xs text-gray-500">Formatos permitidos: JPG, JPEG, PNG, GIF, SVG · Máx. 2MB</p>
          </div>

          <!-- Dropzone -->
          <div class="md:col-span-2">
            <label for="imagen_referencia" class="block text-sm font-medium text-gray-700 mb-2">Imagen del área</label>

            <label for="imagen_referencia"
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

            <input
              class="sr-only"
              type="file"
              name="imagen_referencia"
              id="imagen_referencia"
              accept=".png,.jpg,.jpeg,.gif,.svg">

            {!! $errors->first('imagen_referencia', '<div class="text-red-600 text-xs mt-2"><strong>:message</strong></div>') !!}
            <div id="file-error" class="hidden mt-2 text-xs text-red-600 font-medium"></div>
          </div>

          <!-- Nombre -->
          <div class="md:col-span-1">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del área</label>
            <input
              required
              type="text"
              name="nombre"
              id="nombre"
              value="{{ old('nombre', $mercadoLocal?->nombre) }}"
              placeholder="Ej. Área Central"
              class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            {!! $errors->first('nombre', '<div class="text-red-600 text-xs mt-1"><strong>:message</strong></div>') !!}
          </div>

          <!-- Descripción -->
          <div class="md:col-span-1">
            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción (máx. 500)</label>
            <textarea
              maxlength="500"
              required
              name="descripcion"
              id="descripcion"
              rows="4"
              class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm resize-none"
              placeholder="Describe brevemente el área">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
            {!! $errors->first('descripcion', '<div class="text-red-600 text-xs mt-1"><strong>:message</strong></div>') !!}
          </div>

          <!-- Email -->
          <div class="md:col-span-1">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
            <input
              required
              type="email"
              name="email"
              id="email"
              value="{{ old('email') }}"
              placeholder="correo@ejemplo.com"
              class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
            {!! $errors->first('email', '<div class="text-red-600 text-xs mt-1"><strong>:message</strong></div>') !!}
          </div>

          <!-- Password + toggle -->
          <div class="md:col-span-1">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña (mín. 6)</label>
            <div class="relative">
              <input
                required
                type="password"
                name="password"
                id="password"
                placeholder="••••••"
                class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 pr-10 shadow-sm">
              <button type="button" id="toggle-pass" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700" aria-label="Mostrar u ocultar contraseña">
                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.07.205.07.437 0 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678Z"/>
                  <circle cx="12" cy="12" r="3.5" />
                </svg>
              </button>
            </div>
            {!! $errors->first('password', '<div class="text-red-600 text-xs mt-1"><strong>:message</strong></div>') !!}
          </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
          <a href="{{ route('admin.areas') }}"
             class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Cancelar
          </a>
          <button type="submit"
                  class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Guardar
          </button>
        </div>
      </form>
    </div>
  </main>

  <script>
    const inputFile   = document.getElementById('imagen_referencia');
    const preview     = document.getElementById('img-preview');
    const fileNameEl  = document.getElementById('file-name');
    const fileErrorEl = document.getElementById('file-error');
    const toggleBtn   = document.getElementById('toggle-pass');
    const passwordEl  = document.getElementById('password');

    // Vista previa + validación 2MB
    inputFile?.addEventListener('change', (e) => {
      const file = e.target.files?.[0];
      fileErrorEl.classList.add('hidden');
      fileErrorEl.textContent = '';

      if (!file) { fileNameEl.textContent = 'Selecciona una imagen…'; return; }

      // Límite 2MB (coincide con validación del backend)
      const maxBytes = 2 * 1024 * 1024;
      if (file.size > maxBytes) {
        fileErrorEl.textContent = 'La imagen supera los 2MB. Elige una más ligera.';
        fileErrorEl.classList.remove('hidden');
        e.target.value = '';
        return;
      }

      fileNameEl.textContent = file.name;

      const reader = new FileReader();
      reader.onload = (evt) => { preview.src = evt.target.result; };
      reader.readAsDataURL(file);
    });

    // Toggle contraseña
    toggleBtn?.addEventListener('click', () => {
      const isPwd = passwordEl.type === 'password';
      passwordEl.type = isPwd ? 'text' : 'password';
    });
  </script>
</body>
</html>
