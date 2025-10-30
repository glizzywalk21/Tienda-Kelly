<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @vite('resources/css/app.css')
  <title>Editar Área</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">
  <main class="max-w-3xl mx-auto px-4 py-8 md:py-14">
    <!-- Header card -->
    <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-gray-200 bg-white">
      <div class="px-6 py-8 bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Editor de Área</h1>
        <p class="mt-1 text-white/90">
          Editando: <span class="font-semibold">{{ old('nombre', $mercadoLocal?->nombre) }}</span>
          <span class="ml-2 inline-flex items-center rounded-full bg-white/20 px-2.5 py-0.5 text-xs font-semibold">ID #{{ $mercadoLocal?->id }}</span>
        </p>
      </div>

      <!-- Mensajes de validación -->
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

      <!-- Formulario -->
      <form method="POST" action="{{ route('admin.actualizarmercados', $mercadoLocal->id) }}" enctype="multipart/form-data" class="px-6 pb-8 pt-6">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <!-- Vista previa -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Imagen actual</label>
            <div class="relative overflow-hidden rounded-2xl border bg-gray-50">
              <img
                id="img-preview"
                class="w-full h-64 object-cover"
                src="{{ $mercadoLocal && $mercadoLocal->imagen_referencia
                        ? asset('images/' . $mercadoLocal->imagen_referencia)
                        : asset('images/default.png') }}"
                alt="Imagen del Mercado">
            </div>
            <p class="mt-2 text-xs text-gray-500">Formatos permitidos: JPG, JPEG, PNG, SVG (máx. 2MB)</p>
          </div>

          <!-- Dropzone simple -->
          <div class="md:col-span-2">
            <label for="nueva_imagen" class="block text-sm font-medium text-gray-700 mb-2">Subir nueva imagen (opcional)</label>
            <label
              for="nueva_imagen"
              class="flex cursor-pointer items-center justify-between gap-3 rounded-2xl border-2 border-dashed border-indigo-200 bg-indigo-50/40 p-4 hover:bg-indigo-50 focus-within:ring-2 focus-within:ring-indigo-400">
              <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 16V8m0 0-3 3m3-3 3 3M6 20h12a2 2 0 0 0 2-2V9.5a2 2 0 0 0-.586-1.414l-3.5-3.5A2 2 0 0 0 14.5 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-semibold text-indigo-700">Haz clic para seleccionar</p>
                  <p class="text-xs text-gray-600">O arrastra y suelta aquí</p>
                </div>
              </div>
              <span class="text-xs px-2.5 py-1 rounded-full bg-white text-gray-700 border">PNG · JPG · JPEG · SVG</span>
            </label>
            <input type="file" accept=".png,.jpg,.jpeg,.svg" name="nueva_imagen" id="nueva_imagen" class="sr-only">
            {!! $errors->first('nueva_imagen', '<div class="text-indigo-600 text-xs mt-2"><strong>:message</strong></div>') !!}
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
              placeholder="Ej. Área de Frutas"
              class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm">
          </div>

          <!-- Descripción -->
          <div class="md:col-span-1">
            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea
              maxlength="500"
              required
              name="descripcion"
              id="descripcion"
              rows="4"
              class="w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 px-4 py-2.5 shadow-sm resize-none"
              placeholder="Describe brevemente el área">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
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
            Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </main>

  <script>
    // Vista previa inmediata de imagen
    const inputFile = document.getElementById('nueva_imagen');
    const preview   = document.getElementById('img-preview');
    inputFile?.addEventListener('change', (e) => {
      const file = e.target.files?.[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (evt) => { preview.src = evt.target.result; };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>
