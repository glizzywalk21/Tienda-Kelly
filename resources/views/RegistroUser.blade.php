<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
    <title>Registrar Usuario</title>
</head>

<body class="bg-gradient-to-br from-indigo-200 via-blue-100 to-white min-h-screen flex items-center justify-center">
    <div class="md:flex w-full h-screen shadow-lg bg-white rounded-xl overflow-hidden">

        <!-- Sección izquierda (Formulario) -->
        <div class="md:w-1/2 p-10 flex flex-col justify-center">
            <!-- Título móvil -->
            <div class="md:hidden text-center mb-6">
                <h1 class="font-extrabold text-2xl">Registrar Cuenta</h1>
                <p class="text-xs font-semibold text-gray-500">¡Bienvenido a Tienda Kelly!</p>
            </div>

            <!-- Logo -->
            <div class="hidden md:block text-center mb-10">
                <h1 class="text-5xl font-extrabold tracking-tight">
                    Tienda <span class="text-indigo-600">Kelly</span>
                </h1>
                <p class="mt-2 text-gray-600">Crea tu cuenta y empieza a disfrutar</p>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('validarRegistro') }}" enctype="multipart/form-data"
                class="space-y-4 max-w-sm mx-auto w-full">
                @csrf

                <!-- Email -->
                <input type="email" name="usuario" placeholder="Correo Electrónico"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                    value="{{ old('usuario') }}" required>
                @error('usuario')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror

                <!-- Nombre y Apellido -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="flex flex-col">
                        <input type="text" name="nombre" placeholder="Nombres"
                            class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                            value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <input type="text" name="apellido" placeholder="Apellidos"
                            class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                            value="{{ old('apellido') }}" required>
                        @error('apellido')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Teléfono -->
                <input type="text" name="telefono" maxlength="8" placeholder="Número de Teléfono"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                    value="{{ old('telefono') }}" required>
                @error('telefono')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror

                <!-- Género -->
                <select name="sexo"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                    required>
                    <option value="">Seleccione Género</option>
                    <option value="Masc" {{ old('sexo') == 'Masc' ? 'selected' : '' }}>Masculino</option>
                    <option value="Fem" {{ old('sexo') == 'Fem' ? 'selected' : '' }}>Femenino</option>
                </select>
                @error('sexo')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror

                <!-- Imagen de perfil (OBLIGATORIA) -->
                <div class="space-y-2 mt-2">
                    <label for="imagen_perfil" class="text-sm text-gray-700">Imagen de perfil (obligatoria)</label>
                    <div class="flex items-center gap-4">
                        <div class="h-20 w-20 rounded-full overflow-hidden ring-1 ring-gray-200 bg-gray-50">
                            <img id="img-preview" class="w-full h-full object-cover hidden" alt="Vista previa" />
                        </div>
                        <div class="flex-1">
                            <input type="file" name="imagen_perfil" id="imagen_perfil" accept="image/*" required
                                class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <span id="file-name" class="text-xs text-gray-500">Ningún archivo seleccionado</span>
                            <p class="text-[11px] text-gray-400 mt-1">Formatos: JPG/PNG · Máx 2MB.</p>
                        </div>
                    </div>
                    @error('imagen_perfil')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="flex flex-col">
                    <input type="password" name="password" id="password" placeholder="Contraseña"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                        required>
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="flex flex-col">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirmar Contraseña"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none bg-transparent"
                        required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mostrar contraseña -->
                <div class="flex items-center">
                    <input type="checkbox" id="show-passwords"
                        class="h-4 w-4 text-indigo-500 border-gray-300 rounded focus:ring-indigo-400">
                    <label for="show-passwords" class="ml-2 text-sm text-gray-600">Mostrar contraseña</label>
                </div>

                <!-- Botón -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:scale-105">
                    Registrarse
                </button>
            </form>

            <!-- Línea divisoria -->
            <div class="flex items-center my-6 max-w-sm mx-auto w-full">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-3 text-xs text-gray-500">O</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Ir al login -->
            <p class="text-center text-sm text-gray-600">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Inicia Sesión</a>
            </p>
        </div>

        <!-- Sección derecha (Imagen y bienvenida) -->
        <div
            class="hidden md:flex md:w-1/2 flex-col items-center justify-center bg-gradient-to-tr from-indigo-100 via-blue-50 to-white relative">
            <h3 class="font-bold text-3xl mb-4 text-gray-700">Crea tu Cuenta</h3>
            <img class="w-[70%] drop-shadow-2xl animate-fade-in" src="{{ asset('images/imagenindex.png') }}"
                alt="Register Image">
            <h3 class="mt-6 text-lg text-gray-600">Comienza tu experiencia en <span
                    class="font-bold text-indigo-600">Tienda Kelly</span></h3>
        </div>
    </div>

    <script>
        // Mostrar/Ocultar contraseñas
        document.getElementById('show-passwords')?.addEventListener('change', function () {
            const passwords = document.querySelectorAll('#password, #password_confirmation');
            passwords.forEach(p => p.type = this.checked ? 'text' : 'password');
        });

        // Vista previa de imagen + nombre de archivo
        (function () {
            const input = document.getElementById('imagen_perfil');
            const preview = document.getElementById('img-preview');
            const fileNameSpan = document.getElementById('file-name');

            if (!input) return;

            input.addEventListener('change', function (e) {
                const file = this.files && this.files[0] ? this.files[0] : null;
                if (!file) {
                    if (preview) { preview.src = '#'; preview.classList.add('hidden'); }
                    if (fileNameSpan) fileNameSpan.textContent = 'Ningún archivo seleccionado';
                    return;
                }
                if (fileNameSpan) fileNameSpan.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function (ev) {
                    if (preview) {
                        preview.src = ev.target.result;
                        preview.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(file);
            });
        })();
    </script>
</body>

</html>