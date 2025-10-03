<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registrar Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">
    <section>
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">

                    <a href="{{ route('AdminProfileVista')}}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>
            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <!--Inicio del formulario para registrar a un vendedor-->
        <div class="max-w-xl mx-auto mt-12 px-4">
            <!-- Título -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-indigo-600">Registrar Vendedor</h1>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('admin.guardarvendedores') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6 pb-20">

                    <!-- Errores -->
                    @if ($errors->any())
                    <div class="bg-purple-500 text-white p-3 rounded text-sm text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Imagen -->
                    <div>
                        <label for="imagen_de_referencia" class="block text-sm font-medium text-gray-700 mb-1">Imagen de el vendedor o de su area</label>
                        <input type="file" required accept=".png, .jpg, .jpeg" name="imagen_de_referencia" id="imagen_de_referencia"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        {!! $errors->first('imagen_de_referencia', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Vista previa -->
                    <div>
                        <p class="text-gray-400 text-xs text-center">Su foto se vería así:</p>
                        <img id="img-preview" class="mt-4 hidden w-full max-h-64 object-cover rounded-md border" src="#" alt="Vista Previa de Imagen">
                    </div>

                    <!-- Correo -->
                    <div>
                        <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                        <input required type="email" name="usuario" id="usuario" value="{{ old('usuario') }}"
                            placeholder="Ej. vendedor@email.com"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>

                    <!-- Contraseña -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                            <input type="password" required maxlength="8" name="password" id="password"
                                placeholder="Máx. 8 caracteres"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                            <input type="password" required maxlength="8" name="password_confirmation" id="password_confirmation"
                                placeholder="Repita la contraseña"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        </div>
                    </div>

                    <!-- Mostrar contraseña -->
                    <div class="flex items-center">
                        <input type="checkbox" id="show-passwords" class="mr-2">
                        <label for="show-passwords" class="text-sm text-gray-600">Mostrar Contraseñas</label>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Vendedor</label>
                        <input required type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                            placeholder="Ej. Juan"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>

                    <!-- Apellidos -->
                    <div>
                        <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos del Vendedor</label>
                        <input required type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}"
                            placeholder="Ej. Pérez Gómez"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>

                    <!-- Nombre del Local -->
                    <div>
                        <label for="nombre_del_local" class="block text-sm font-medium text-gray-700 mb-1">Nombre del area (Público)</label>
                        <input type="text" name="nombre_del_local" id="nombre_del_local" value="{{ old('nombre_del_local') }}"
                            placeholder="Ej. Pupusería La Bendición"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono del Vendedor</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"
                            placeholder="Ej. 7777-8888"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>

                    <!-- Número de Puesto -->
                    <div>
                        <label for="numero_puesto" class="block text-sm font-medium text-gray-700 mb-1">Número de Puesto</label>
                        <input required type="text" name="numero_puesto" id="numero_puesto" value="{{ old('numero_puesto') }}"
                            placeholder="Ej. 12-B"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    </div>

                    <!-- Mercado -->
                    <div>
                        <label for="fk_mercado" class="block text-sm font-medium text-gray-700 mb-1">Categoria del area</label>
                        <select name="fk_mercado" id="fk_mercado"
                            class="w-full border rounded-md px-4 py-2 text-sm text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            <option value="" disabled selected>Seleccione un área</option>
                            @foreach($mercados as $mercado)
                            <option value="{{ $mercado->id }}" {{ old('fk_mercado') == $mercado->id ? 'selected' : '' }}>
                                {{ $mercado->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @error('fk_mercado')
                        <div class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <!-- Botón -->
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200">
                            Registrar Vendedor
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!--Final del formulario para registrar al vendedor-->

    </section>
    <script>
        document.getElementById('imagen_de_referencia').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');
            const fileNameSpan = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);

                // Mostrar el nombre del archivo seleccionado
                fileNameSpan.textContent = input.files[0].name;
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                fileNameSpan.textContent = 'Imagen del Vendedor';
            }
        });
    </script>
    <script>
        document.getElementById('show-passwords').addEventListener('change', function() {
            const passwordFields = document.querySelectorAll('input[name="password"], input[name="password_confirmation"]');
            const isPasswordVisible = this.checked;

            passwordFields.forEach(field => {
                field.type = isPasswordVisible ? 'text' : 'password';
            });
        });
    </script>

</body>

</html>