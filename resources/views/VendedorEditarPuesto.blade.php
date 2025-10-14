<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-50">

    <section class="max-w-md mx-auto mt-16 p-6 bg-white shadow-xl rounded-xl">
        <!-- Encabezado -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-600">Editar Vendedor</h1>
            <h2 class="text-lg font-semibold text-gray-700 mt-1">{{ old('nombre_del_local', $vendedor->nombre_del_local) }}</h2>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-500 text-white text-sm p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errores -->
        @if ($errors->any())
            <div class="bg-orange-500 text-white p-3 rounded text-sm mb-4">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('vendedores.actualizar', ['id' => $vendedor->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Imagen -->
            <label for="imagen_de_referencia"
                class="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm cursor-pointer hover:bg-gray-100 transition">
                <span class="text-sm text-gray-600">Imagen del vendedor o del puesto</span>
                <input type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                <img src="{{ asset('imgs/files2.svg') }}" class="w-5 h-5" alt="Subir imagen">
            </label>
            {!! $errors->first('imagen_de_referencia', '<div class="text-xs text-red-500 mt-1">:message</div>') !!}

            <!-- Vista previa -->
            @if ($vendedor->imagen_de_referencia)
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-500 mb-2">Imagen actual:</p>
                    <img id="img-preview" class="w-48 h-32 object-cover rounded-md border mx-auto shadow-md"
                        src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}"
                        alt="Imagen del vendedor">
                </div>
            @else
                <img id="img-preview" class="w-48 h-32 object-cover rounded-md border mx-auto shadow-md hidden" alt="Vista previa">
                <p class="text-xs text-gray-500 text-center mt-4">No hay imagen actual.</p>
            @endif

            <!-- Campos -->
            <div class="space-y-4 mt-6">
                <!-- Correo -->
                <input type="email" name="usuario" id="usuario"
                    value="{{ old('usuario', $vendedor->usuario) }}"
                    placeholder="Correo electrónico"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 focus:ring-2 focus:ring-indigo-400">

                <!-- Contraseña -->
                <input type="password" name="password" id="password"
                    placeholder="Nueva contraseña (opcional)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 focus:ring-2 focus:ring-indigo-400">

                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirmar contraseña"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 focus:ring-2 focus:ring-indigo-400">

                <!-- Mostrar contraseña -->
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" id="show-passwords" class="mr-2"> Mostrar contraseñas
                </label>

                <!-- Nombre -->
                <input type="text" name="nombre" id="nombre"
                    value="{{ old('nombre', $vendedor->nombre) }}"
                    placeholder="Nombre del vendedor"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400">

                <!-- Apellidos -->
                <input type="text" name="apellidos" id="apellidos"
                    value="{{ old('apellidos', $vendedor->apellidos) }}"
                    placeholder="Apellidos del vendedor"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400">

                <!-- Nombre del local -->
                <input type="text" name="nombre_del_local" id="nombre_del_local"
                    value="{{ old('nombre_del_local', $vendedor->nombre_del_local) }}"
                    placeholder="Nombre del local"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400">

                <!-- Teléfono -->
                <input type="text" name="telefono" id="telefono"
                    value="{{ old('telefono', $vendedor->telefono) }}"
                    placeholder="Teléfono"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400">

                <!-- Número del puesto -->
                <input type="text" name="numero_puesto" id="numero_puesto"
                    value="{{ old('numero_puesto', $vendedor->numero_puesto) }}"
                    placeholder="Número del puesto"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400">
                    
                <!-- Mercado -->
                <select name="fk_mercado" id="fk_mercado"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400">
                    @foreach($mercados as $mercado)
                        <option value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor->fk_mercado) == $mercado->id ? 'selected' : '' }}>
                            {{ $mercado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="mt-8 space-y-4 text-center">
                <button type="submit"
                    class="w-full py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-md transition duration-300">
                    Guardar cambios
                </button>

                <a href="{{ route('vendedores.index') }}"
                    class="inline-block w-full py-2 bg-gray-600 hover:bg-gray-500 text-white font-bold rounded-md transition duration-300">
                    Cancelar
                </a>
            </div>
        </form>
    </section>

    <script>
        // Mostrar/ocultar contraseñas
        document.getElementById('show-passwords').addEventListener('change', function() {
            const passwords = document.querySelectorAll('#password, #password_confirmation');
            passwords.forEach(input => input.type = this.checked ? 'text' : 'password');
        });

        // Vista previa de imagen
        document.getElementById('imagen_de_referencia').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('img-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
