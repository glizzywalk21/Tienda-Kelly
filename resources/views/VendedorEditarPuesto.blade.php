<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>EDITAR VENDEDOR</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>

    <section class="max-w-md mx-auto mt-16 p-6 rounded-xl ">
        <!-- Encabezado -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-500">Editar Vendedor</h1>
            <h2 class="text-lg font-semibold text-gray-700">{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}</h2>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('vendedores.actualizar', ['id' => $vendedor->id]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $vendedor->id }}">

            <!-- Errores -->
            @if ($errors->any())
            <div class="bg-orange-500 text-white p-3 rounded text-sm mb-4">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Imagen -->
            <label for="imagen_de_referencia" class="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm cursor-pointer hover:bg-gray-50 transition">
                <span class="text-sm text-gray-600">Imagen de usted o de su Puesto</span>
                <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                <span class="w-5 h-5 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
            </label>
            {!! $errors->first('imagen_de_referencia', '<div class="text-xs text-red-500 mt-1">:message</div>') !!}

            <!-- Vista previa -->
            @if ($vendedor?->imagen_de_referencia)
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-500 mb-2">Imagen actual:</p>
                <img class="w-48 h-32 object-cover rounded-md border mx-auto shadow-md" src="{{ asset('imgs/' . $vendedor?->imagen_de_referencia) }}" alt="Imagen del Vendedor">
            </div>
            @else
            <p class="text-xs text-gray-500 text-center mt-4">No hay imagen actual.</p>
            @endif

            <!-- Campos -->
            <div class="space-y-4 mt-6">
                @php
                $fields = [
                ['name' => 'usuario', 'type' => 'email', 'placeholder' => 'Correo electrónico'],
                ['name' => 'password', 'type' => 'password', 'placeholder' => 'Contraseña'],
                ['name' => 'password_confirmation', 'type' => 'password', 'placeholder' => 'Confirmar Contraseña'],
                ['name' => 'nombre', 'type' => 'text', 'placeholder' => 'Nombre del Vendedor'],
                ['name' => 'apellidos', 'type' => 'text', 'placeholder' => 'Apellidos del Vendedor'],
                ['name' => 'nombre_del_local', 'type' => 'text', 'placeholder' => 'Nombre del Local'],
                ['name' => 'telefono', 'type' => 'text', 'placeholder' => 'Teléfono'],
                ['name' => 'numero_puesto', 'type' => 'text', 'placeholder' => 'Número del Puesto'],
                ];
                @endphp

                @foreach ($fields as $field)
                <input
                    required
                    type="{{ $field['type'] }}"
                    name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}"
                    value="{{ old($field['name'], $vendedor?->{$field['name']}) }}"
                    placeholder="{{ $field['placeholder'] }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                {!! $errors->first($field['name'], '<div class="text-xs text-red-500">:message</div>') !!}
                @endforeach

                <!-- Mostrar contraseña -->
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" id="show-passwords" class="mr-2"> Mostrar Contraseñas
                </label>

                <!-- Mercado -->
                <select name="fk_mercado" id="fk_mercado"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @foreach($mercados as $mercado)
                    <option value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>
                        {{ $mercado->nombre }}
                    </option>
                    @endforeach
                </select>
                {!! $errors->first('fk_mercado', '<div class="text-xs text-red-500">:message</div>') !!}
            </div>

            <!-- Botones -->
            <div class="mt-8 space-y-4 text-center">
                <button type="submit"
                    class="w-full py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-md transition duration-300">
                    Actualizar Vendedor
                </button>
                <a href="{{ route('vendedores.index') }}"
                    class="inline-block w-full py-2 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-md transition duration-300">
                    Cancelar Actualización
                </a>
            </div>
        </form>
    </section>


    <script>
        document.getElementById('imagen_de_referencia').addEventListener('change', function(e) {
            const preview = document.getElementById('img-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.src = reader.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });

        document.getElementById('show-passwords').addEventListener('change', function() {
            const passwords = document.querySelectorAll('#password, #password_confirmation');
            passwords.forEach(password => {
                password.type = this.checked ? 'text' : 'password';
            });
        });
    </script>

</body>

</html>