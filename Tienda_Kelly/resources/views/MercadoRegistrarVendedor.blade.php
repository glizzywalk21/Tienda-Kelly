<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registrar Vendedor</title>
        <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>
<body>
    <section>
        <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center">
                    <a href="{{ route('mercados.index') }}">
                        <img class="w-6" src="{{ asset('imgs/mercado.home.nav.png') }}" alt="Home Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('mercados.listavendedores') }}">
                        <img class="w-6" src="{{ asset('imgs/mercado.vendedores.nav.png') }}" alt="Cart Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('mercados.reservas') }}">
                        <img class="w-6" src="{{ asset('imgs/mercado.reservas.nav.png') }}" alt="Favorites Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('mercados.historial') }}">
                        <img class="w-6" src="{{ asset('imgs/mercado.historial.nav.png') }}"
                            alt="Favorites Icon" />
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('mercados.perfil') }}">
                        <img class="w-6" src="{{ asset('imgs/mercado.perfil.nav.png') }}" alt="Profile Icon" />
                    </a>
                </div>
            </div>
        </div>
        <div class="w-72 h-auto mx-auto">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Registrar vendedor</h1>
            </div>


            <form method="POST" action="{{ route('mercados.guardarvendedor') }}" role="form" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{ $mercado->id }}" name="fk_mercado">
                <div class="pb-[7rem] mt-10 space-y-4">
                    <!-- Mensajes de Error Generales -->
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-2 rounded mt-1 text-sm sm:text-sm text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- INICIO DE INPUT DE LA FOTO -->
                    <div class="flex flex-col items-center">
                        <label for="imagen_de_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative cursor-pointer">
                            <span id="file-name" class="text-gray-400 text-xs">Imagen des <b>Usted</b> o de <b>Su Puesto</b></span>
                            <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                            {!! $errors->first('imagen_de_referencia', '<div class="text-red-500 text-xs mt-1">:message</div>') !!}
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>
                    <!-- FIN DEL INPUT DE LA IMG -->

                    <!-- INICIO DE LA PREVIEW -->
                    <section class="flex flex-col items-center">
                        <div>
                            <p class="text-gray-400 text-xs text-center">Su foto se vería así:</p>
                        </div>
                        <div class="mt-4">
                            <img id="img-preview" class="max-w max-h-xs hidden rounded-md border object-center" src="#" alt="Vista Previa de Imagen">
                        </div>
                    </section>
                    <!-- FIN DE LA PREVIEW -->

                    <!-- Campo de Correo Electrónico -->
                    <div class="flex flex-col items-center">
                        <input required type="email" name="usuario" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('usuario') border-red-500 @enderror" value="{{ old('usuario') }}" id="usuario" placeholder="Escriba el correo electrónico">
                        @error('usuario')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>



                    <!-- Campo de Nombre -->
                    <div class="flex flex-col items-center">
                        <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('nombre') border-red-500 @enderror" value="{{ old('nombre') }}" id="nombre" placeholder="Escriba el Nombre del Vendedor">
                        @error('nombre')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Apellidos -->
                    <div class="flex flex-col items-center">
                        <input required type="text" name="apellidos" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('apellidos') border-red-500 @enderror" value="{{ old('apellidos') }}" id="apellidos" placeholder="Escriba los Apellidos del Vendedor">
                        @error('apellidos')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Nombre del Local -->
                    <div class="flex flex-col items-center">
                        <input type="text" name="nombre_del_local" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('nombre_del_local') border-red-500 @enderror" value="{{ old('nombre_del_local') }}" id="nombre_del_local" placeholder="Digite el Nombre de su Local (Será Público)">
                        @error('nombre_del_local')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Teléfono -->
                    <div class="flex flex-col items-center">
                        <input type="text" name="telefono" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('telefono') border-red-500 @enderror" value="{{ old('telefono') }}" id="telefono" placeholder="Digite el Teléfono del Vendedor">
                        @error('telefono')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Número de Puesto -->
                    <div class="flex flex-col items-center">
                        <input required type="text" name="numero_puesto" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('numero_puesto') border-red-500 @enderror" value="{{ old('numero_puesto') }}" id="numero_puesto" placeholder="Escriba el Número Puesto">
                        @error('numero_puesto')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Clasificación -->
                    <div class="flex flex-col items-center">
                        <select name="clasificacion" id="clasificacion" class="border bg-gray-100 rounded border-gray-400 w-80 h-9 pl-5 text-xs mt-2 text-gray-400" required>
                        <option class="font-bold text-xs text-white" value="null">Escoga su Clasificacion</option>
                        <option class="font-bold text-xl text-gray-800" value="comedor" {{ old('clasificacion') == 'comedor' ? 'selected' : '' }}>Comedor</option>
                        <option class="font-bold text-xl text-gray-800" value="ropa" {{ old('clasificacion') == 'ropa' ? 'selected' : '' }}>Ropa</option>
                        <option class="font-bold text-xl text-gray-800" value="granosbasicos" {{ old('clasificacion') == 'granosbasicos' ? 'selected' : '' }}>Granos Basicos</option>
                        <option class="font-bold text-xl text-gray-800" value="artesanias" {{ old('clasificacion') == 'artesanias' ? 'selected' : '' }}>Artesanias</option>
                        <option class="font-bold text-xl text-gray-800" value="mariscos" {{ old('clasificacion') == 'mariscos' ? 'selected' : '' }}>Mariscos</option>
                        <option class="font-bold text-xl text-gray-800" value="carnes" {{ old('clasificacion') == 'carnes' ? 'selected' : '' }}>Carnes</option>
                        <option class="font-bold text-xl text-gray-800" value="lacteos" {{ old('clasificacion') == 'lacteos' ? 'selected' : '' }}>Lacteos</option>
                        <option class="font-bold text-xl text-gray-800" value="aves" {{ old('clasificacion') == 'aves' ? 'selected' : '' }}>Aves</option>
                        <option class="font-bold text-xl text-gray-800" value="plasticos" {{ old('clasificacion') == 'plasticos' ? 'selected' : '' }}>Plasticos</option>
                        <option class="font-bold text-xl text-gray-800" value="frutasyverduras" {{ old('clasificacion') == 'frutasyverduras' ? 'selected' : '' }}>Frutas Y Verduras</option>
                        <option class="font-bold text-xl text-gray-800" value="emprendimiento" {{ old('clasificacion') == 'emprendimiento' ? 'selected' : '' }}>Emprendimiento</option>
                        <option class="font-bold text-xl text-gray-800" value="otros" {{ old('clasificacion') == 'otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                        @error('clasificacion')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Campo de Contraseña -->
                    <div class="flex flex-col items-center">
                        <input type="password" maxlength="8" name="password" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" placeholder="Escriba su Contraseña">
                        @error('password')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Confirmación de Contraseña -->
                    <div class="flex flex-col items-center">
                        <input required type="password" name="password_confirmation" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('password_confirmation') border-red-500 @enderror" id="password_confirmation" placeholder="Confirme su Contraseña">
                        @error('password_confirmation')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mostrar Contraseñas -->
                    <div class="flex items-center justify-center mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="show-passwords" class="mr-2">
                            <span class="text-xs text-gray-600">Mostrar Contraseñas</span>
                        </label>
                    </div>

                    <!-- Botón para Registrarse -->
                    <div class="flex flex-col items-center">
                        <button type="submit" class="w-80 bg-red-600 text-white text-center text-sm py-2 px-4 rounded-md shadow-md hover:bg-red-700 mt-5">Registrarse</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        const inputImage = document.getElementById('imagen_de_referencia');
        const imgPreview = document.getElementById('img-preview');
        const fileNameSpan = document.getElementById('file-name');

        inputImage.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                fileNameSpan.textContent = file.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    imgPreview.classList.remove('hidden');
                    imgPreview.classList.add('block');
                };
                reader.readAsDataURL(file);
            }
        });

        const showPasswordsCheckbox = document.getElementById('show-passwords');
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        showPasswordsCheckbox.addEventListener('change', function() {
            const type = this.checked ? 'text' : 'password';
            passwordInput.type = type;
            passwordConfirmationInput.type = type;
        });
    </script>
</body>
</html>
