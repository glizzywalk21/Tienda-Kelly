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

        <!--Inicio de el formulario para editar al vendedor-->
        <div class="max-w-xl mx-auto mt-12 px-4">
            <!-- Encabezado -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-indigo-600">
                    Editar Vendedor <span class="font-bold">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</span>
                </h1>
                <h2 class="text-sm text-gray-500 mt-2 tracking-wide">
                    Ubicado en <span class="font-bold text-gray-700">{{ $vendedor->mercadoLocal->nombre }}</span>
                </h2>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('admin.actualizarvendedor', ['id' => $vendedor->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $vendedor->id }}">

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
                    <input type="hidden" id="fallbackInput" value="{{ $vendedor->imagen_de_referencia }}" name="imagen_de_referencia">
                    <div>
                        <label for="imagen_de_referencia" class="block text-sm font-medium text-gray-700 mb-1">Imagen de Usted o de su Puesto</label>
                        <input type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" id="imagen_de_referencia"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        {!! $errors->first('imagen_de_referencia', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Vista previa -->
                    @if ($vendedor?->imagen_de_referencia)
                    <div>
                        <p class="text-gray-400 text-xs text-center">Imagen actual:</p>
                        <img id="img-preview" class="mt-4 w-full max-h-64 object-cover rounded-md border" src="{{ asset('imgs/' . $vendedor?->imagen_de_referencia) }}" alt="Imagen del Vendedor">
                    </div>
                    @else
                    <div>
                        <p class="text-gray-400 text-xs text-center">No hay imagen actual.</p>
                    </div>
                    @endif


                    <!---FIN DE LA PREVIEW-->

                    <div class="space-y-6">
                        <!-- Correo electrónico -->
                        <div>
                            <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                            <input required type="email" name="usuario" id="usuario"
                                value="{{ old('usuario', $vendedor?->usuario) }}"
                                placeholder="Ej. vendedor@email.com"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            {!! $errors->first('usuario', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Contraseñas -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                                <input type="password" maxlength="8" name="password" id="password"
                                    value="{{ old('password') }}"
                                    placeholder="Máx. 8 caracteres"
                                    class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                {!! $errors->first('password', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                                <input type="password" maxlength="8" required name="password_confirmation" id="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    placeholder="Repita la contraseña"
                                    class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                {!! $errors->first('password_confirmation', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
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
                            <input required type="text" name="nombre" id="nombre"
                                value="{{ old('nombre', $vendedor?->nombre) }}"
                                placeholder="Ej. Juan"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            {!! $errors->first('nombre', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Apellidos -->
                        <div>
                            <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos del Vendedor</label>
                            <input required type="text" name="apellidos" id="apellidos"
                                value="{{ old('apellidos', $vendedor?->apellidos) }}"
                                placeholder="Ej. Pérez Gómez"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            {!! $errors->first('apellidos', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Nombre del Local -->
                        <div>
                            <label for="nombre_del_local" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Local (Público)</label>
                            <input type="text" name="nombre_del_local" id="nombre_del_local"
                                value="{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}"
                                placeholder="Ej. Pupusería La Bendición"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            {!! $errors->first('nombre_del_local', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono del Vendedor</label>
                            <input type="text" name="telefono" id="telefono"
                                value="{{ old('telefono', $vendedor?->telefono) }}"
                                placeholder="Ej. 7777-8888"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            {!! $errors->first('telefono', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Número de Puesto -->
                        <div>
                            <label for="numero_puesto" class="block text-sm font-medium text-gray-700 mb-1">Número de Puesto</label>
                            <input required type="text" name="numero_puesto" id="numero_puesto"
                                value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}"
                                placeholder="Ej. 12-B"
                                class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            {!! $errors->first('numero_puesto', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Área del Mercado -->
                        <div>
                            <label for="fk_mercado" class="block text-sm font-medium text-gray-700 mb-1">Área del Mercado</label>
                            <select name="fk_mercado" id="fk_mercado"
                                class="w-full border rounded-md px-4 py-2 text-sm text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                @foreach($mercados as $mercado)
                                <option value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>
                                    {{ $mercado->nombre }}
                                </option>
                                @endforeach
                            </select>
                            {!! $errors->first('fk_mercado', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>


                        <!-- Clasificación -->
                        <div class="mt-6">
                            <label for="clasificacion" class="block text-sm font-medium text-gray-700 mb-1">Clasificación del Vendedor</label>
                            <select name="clasificacion" id="clasificacion" required
                                class="w-full border rounded-md px-4 py-2 text-sm text-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                <option value="null" disabled>Escoge su Clasificación</option>
                                <option value="comedor" {{ old('clasificacion', $vendedor?->clasificacion) == 'comedor' ? 'selected' : '' }}>Comedor</option>
                                <option value="venta de abarrotes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de abarrotes' ? 'selected' : '' }}>Venta de Abarrotes</option>
                                <option value="venta de ropa" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de ropa' ? 'selected' : '' }}>Venta de Ropa</option>
                                <option value="venta de calzado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de calzado' ? 'selected' : '' }}>Venta de Calzado</option>
                                <option value="venta de herramientas" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de herramientas' ? 'selected' : '' }}>Venta de Herramientas</option>
                                <option value="venta de verduras" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de verduras' ? 'selected' : '' }}>Venta de Verduras</option>
                                <option value="venta de juguetes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de juguetes' ? 'selected' : '' }}>Venta de Juguetes</option>
                                <option value="venta de frutas" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de frutas' ? 'selected' : '' }}>Venta de Frutas</option>
                                <option value="venta de flores" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de flores' ? 'selected' : '' }}>Venta de Flores</option>
                                <option value="venta de carne" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de carne' ? 'selected' : '' }}>Venta de Carne</option>
                                <option value="venta de pescado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de pescado' ? 'selected' : '' }}>Venta de Pescado</option>
                                <option value="venta de pollo" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de pollo' ? 'selected' : '' }}>Venta de Pollo</option>
                            </select>
                            {!! $errors->first('clasificacion', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                        </div>

                        <!-- Botón Actualizar -->
                        <div class="mt-10">
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 px-4 rounded-md shadow-md transition duration-200">
                                Actualizar Vendedor
                            </button>
                        </div>

            </form>

            <!-- Botón Cancelar -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.vendedores') }}"
                    class=" w-full inline-block bg-gray-600 hover:bg-gray-500 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200">
                    Cancelar Actualización
                </a>

            </div>
            <!--Fin del formulario para editar al vende-->
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
    <script>
        function handleFormSubmit(event) {
            const fileInput = document.getElementById('imagen_de_referencia');
            const fallbackInput = document.getElementById('fallbackInput');

            if (!fileInput.value) {
                // No file selected, replace the file input with the fallback value
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.name = 'imagen_de_referencia';
                newInput.value = fallbackInput.value;
                fileInput.parentNode.replaceChild(newInput, fileInput);
            }
        }
    </script>

</body>

</html>