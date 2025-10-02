<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Editar Vendedor</title>
  <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

  <section>
    <!-- Bottom bar móvil -->
    <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
      <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
        <div class="flex items-center"><a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="Home"></a></div>
        <div class="flex items-center"><a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="Sellers"></a></div>
        <div class="flex items-center"><a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="Users"></a></div>
        <div class="flex items-center"><a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Perfil"></a></div>
      </div>
    </div>

    <div class="max-w-xl mx-auto mt-12 px-4 pb-24">
      <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-indigo-600">
          Editar Vendedor <span class="font-bold">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</span>
        </h1>
      </div>

      <form method="POST" action="{{ route('admin.actualizarvendedor', ['id' => $vendedor->id]) }}" enctype="multipart/form-data">
        @csrf

        <!-- Errores -->
        @if ($errors->any())
        <div class="bg-indigo-600 text-white p-3 rounded text-sm text-center mb-6">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Imagen -->
        <div class="mb-6">
          <label for="imagen_de_referencia" class="block text-sm font-medium text-gray-700 mb-1">
            Imagen de usted o de su puesto
          </label>
          <input type="file" accept=".png,.jpg,.jpeg" name="imagen_de_referencia" id="imagen_de_referencia"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
          @error('imagen_de_referencia')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Vista previa -->
        @if ($vendedor?->imagen_de_referencia)
        <div class="mb-6">
          <p class="text-gray-400 text-xs text-center">Imagen actual:</p>
          <img id="img-preview" class="mt-4 w-full max-h-64 object-cover rounded-md border"
            src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="Imagen del Vendedor">
        </div>
        @else
        <div class="mb-6">
          <p class="text-gray-400 text-xs text-center">No hay imagen actual.</p>
          <img id="img-preview" class="hidden mt-4 w-full max-h-64 object-cover rounded-md border" alt="Preview">
        </div>
        @endif

        <!-- Correo -->
        <div class="mb-6">
          <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
          <input required type="email" name="usuario" id="usuario"
            value="{{ old('usuario', $vendedor?->usuario) }}"
            placeholder="Ej. vendedor@email.com"
            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
          @error('usuario')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Contraseña (opcional) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva contraseña (opcional)</label>
            <input type="password" maxlength="8" name="password" id="password"
              placeholder="Mín. 8 caracteres"
              class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('password')
            <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
            <input type="password" maxlength="8" name="password_confirmation" id="password_confirmation"
              placeholder="Repita la contraseña"
              class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('password_confirmation')
            <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
        </div>

        <!-- Mostrar contraseña -->
        <div class="flex items-center mb-6">
          <input type="checkbox" id="show-passwords" class="mr-2">
          <label for="show-passwords" class="text-sm text-gray-600">Mostrar contraseñas</label>
        </div>

        <!-- Nombre -->
        <div class="mb-6">
          <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del vendedor</label>
          <input required type="text" name="nombre" id="nombre"
            value="{{ old('nombre', $vendedor?->nombre) }}"
            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
          @error('nombre')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Apellidos -->
        <div class="mb-6">
          <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos del vendedor</label>
          <input required type="text" name="apellidos" id="apellidos"
            value="{{ old('apellidos', $vendedor?->apellidos) }}"
            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
          @error('apellidos')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Nombre del local -->
        <div class="mb-6">
          <label for="nombre_del_local" class="block text-sm font-medium text-gray-700 mb-1">Nombre del local (público)</label>
          <input required type="text" name="nombre_del_local" id="nombre_del_local"
            value="{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}"
            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
          @error('nombre_del_local')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Teléfono -->
        <div class="mb-6">
          <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono del vendedor</label>
          <input required type="text" name="telefono" id="telefono"
            value="{{ old('telefono', $vendedor?->telefono) }}"
            placeholder="Ej. 7777-8888"
            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
          @error('telefono')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Número de puesto -->
        <div class="mb-6">
          <label for="numero_puesto" class="block text-sm font-medium text-gray-700 mb-1">Número de puesto</label>
          <input required type="number" min="1" name="numero_puesto" id="numero_puesto"
            value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}"
            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
          @error('numero_puesto')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Área del mercado -->
        <div class="mb-10">
          <label for="fk_mercado" class="block text-sm font-medium text-gray-700 mb-1">Área del mercado</label>
          <select name="fk_mercado" id="fk_mercado"
            class="w-full border rounded-md px-4 py-2 text-sm text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @foreach($mercados as $mercado)
            <option value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>
              {{ $mercado->nombre }}
            </option>
            @endforeach
          </select>
          @error('fk_mercado')
          <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
          @enderror
        </div>

        <!-- Botón Actualizar -->
        <div>
          <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 px-4 rounded-md shadow-md transition duration-200">
            Actualizar vendedor
          </button>
        </div>
      </form>

      <!-- Cancelar -->
      <div class="mt-6 text-center">
        <a href="{{ route('admin.vendedores') }}"
          class="w-full inline-block bg-gray-600 hover:bg-gray-500 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200">
          Cancelar actualización
        </a>
      </div>
    </div>
  </section>

  <script>
    document.getElementById('imagen_de_referencia')?.addEventListener('change', function(e) {
      const preview = document.getElementById('img-preview');
      const file = e.target.files[0];
      if (!preview) return;
      if (file) {
        const reader = new FileReader();
        reader.onload = function() {
          preview.src = reader.result;
          preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('show-passwords')?.addEventListener('change', function() {
      const passwords = document.querySelectorAll('#password, #password_confirmation');
      passwords.forEach(p => p.type = this.checked ? 'text' : 'password');
    });
  </script>

</body>

</html>