<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
    <title>Registrar Usuario</title>
</head>

<body>
    <section>
        <!-- INFO DE ARRIBA COMO MOVIL -->
        <div class="pl-5"> <!-- Contenedor de Login -->
            <div class="login flex items-center">
                <div class="title">
                    <h2 class="font-bold">Registrar Cuenta</h2>
                </div>
                <div class="icon">
                    <img class="w-4 ml-2" src="../imgs/non-img.png" alt="User Icon">
                </div>
            </div>
            <h3 class="text-xs font-bold">¡Bienvenido a Tienda kelly!</h3>
        </div>

        <div id="registroExitoso" class="bg-green-500 text-white p-2 rounded text-center mt-4" style="display: none;">
            ¡Registro exitoso!
        </div>

        <!-- TITULO DE Tienda Kelly -->
        <div class="w-72 h-96 mt-16 mx-auto"> <!-- Contenedor Principal -->
            <div class="text-center"> <!-- Contenedor Tienda Kelly -->
                <h1 class="text-5xl font-bold">Tienda<span class="text-purple-400 font-bold">Kelly</span></h1>
            </div>

            <!-- FORMULARIO -->
            <form method="POST" action="{{ route('validar-registro') }}" role="form" enctype="multipart/form-data">
                @csrf

                <!-- Mostrar mensajes de error -->
                <div class="flex flex-col mt-6">
                    <input required type="email" name="usuario" placeholder="Ingrese su Correo Electrónico" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2" value="{{ old('usuario') }}">
                    @if ($errors->has('usuario'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('usuario') }}</span>
                    @endif

                    <input required type="text" name="nombre" id="nombre" placeholder="Ingrese sus Nombres" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2" value="{{ old('nombre') }}">
                    @if ($errors->has('nombre'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('nombre') }}</span>
                    @endif

                    <input required type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2" value="{{ old('apellido') }}">
                    @if ($errors->has('apellido'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('apellido') }}</span>
                    @endif

                    <input required type="text" maxlength="8" name="telefono" id="telefono" placeholder="Ingrese su Número de Teléfono" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2" value="{{ old('telefono') }}">
                    @if ($errors->has('telefono'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('telefono') }}</span>
                    @endif

                    <select name="sexo" id="sexo" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2 text-gray-400" required>
                        <option value="">Escoga su Género</option>
                        <option value="Masc" {{ old('sexo') == 'Masc' ? 'selected' : '' }}>Género: Masculino</option>
                        <option value="Fem" {{ old('sexo') == 'Fem' ? 'selected' : '' }}>Género: Femenino</option>
                    </select>
                    @if ($errors->has('sexo'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('sexo') }}</span>
                    @endif

                    <input required type="password" name="password" id="password" placeholder="Escriba su Contraseña" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2">
                    @if ($errors->has('password'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</span>
                    @endif

                    <input required type="password" name="password_confirmation" id="password_confirmation" placeholder="Escriba de nuevo su Contraseña" class="border rounded border-gray-400 w-full md:h-12 h-9 pl-5 md:text-[1rem] text-xs mt-2">
                    <div class="flex items-center justify-center mt-2">
                        <input
                            class="checked:appearance-auto appearance-none h-5 w-5 border border-gray-500 rounded-sm checked:border-gray-700 focus:outline-none"
                            type="checkbox"
                            id="show-passwords">
                        <span class="ml-2 pt-1 md:text-[1rem] text-sm text-gray-500">Mostrar Contraseña</span>
                    </div>
                </div>

                <div class="flex justify-center mt-5">
                    <button type="submit" class="bg-purple-400 w-72 h-10 flex items-center justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Registrarse</button>
                </div>
            </form>

        </div>
    </section>
    <script>
        document.getElementById('show-passwords').addEventListener('change', function() {
            const passwords = document.querySelectorAll('#password, #password_confirmation');
            passwords.forEach(password => {
                password.type = this.checked ? 'text' : 'password';
            });
        });
    </script>
</body>

</html>
<script src="../js/ComprobarContrasena.js"></script>