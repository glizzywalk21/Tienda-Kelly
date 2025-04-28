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
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="{{ route('admin.index') }}" ><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}" ><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">

                    <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>
            <!--FIN DE NAVBAR MOBIL-->
        </div>
        <div class="w-72 h-auto mx-auto">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-purple-500">Registrar vendedor</h1>
            </div>
            <form method="POST" action="{{ route('admin.guardarvendedores') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="pb-[7rem] mt-10 space-y-4">
                @if ($errors->any())
                    <div class="bg-purple-500 text-white p-2 rounded mt-1 text-sm sm:text-sm text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!--INICIO DE INPUT DE LA FOTO-->
                <div class="flex justify-between">
                    <label for="imagen_de_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative cursor-pointer">
                        <span id="file-name" class="text-gray-400 text-xs">Imagen de <b>Usted</b> o de <b>Su Puesto</b>
                        </span>
                        <input type="file" required accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                        {!! $errors->first('imagen_de_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <!--FIN DEL INPUT DE LA IMG-->
                 <!--INICIO DE LA PREVIEW-->
                 <section>


                 <div>
                    <p class="text-gray-400 text-xs text-center">Su foto se veria asi: </p>
                </div>
                <div class="mt-4">
                    <img id="img-preview" class="max-w max-h-xs hidden rounded-md border object-center" src="#" alt="Vista Previa de Imagen">
                </div>
            </section>

                <!---FIN DE LA PREVIEW-->

                    <div class="flex justify-center">
                        <input required type="email" name="usuario" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario') }}" id="usuario" placeholder="Escriba el correo electrónico">
                    </div>
                    <div class="flex justify-center">
                        <input type="password" required  maxlength="8" name="password" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('password') is-invalid @enderror"  id="password" placeholder="Escriba su Contraseña">

                    </div>
                    <div class="flex justify-center">
                        <input type="password" required  maxlength="8"  name="password_confirmation" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirme su Contraseña">

                    </div>
                    <div class="flex justify-center mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="show-passwords" class="mr-2">
                            <span class="text-xs text-gray-600">Mostrar Contraseñas</span>
                        </label>
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" id="nombre" placeholder="Escriba el Nombre del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="apellidos" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" id="apellidos" placeholder="Escriba los Apellidos del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input type="text" name="nombre_del_local" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre_del_local') is-invalid @enderror" value="{{ old('nombre_del_local') }}" id="nombre_del_local" placeholder="Digite el Nombre de su Local (Sera Publico)">
                    </div>
                    <div class="flex justify-center">
                        <input type="text" name="telefono" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" id="telefono" placeholder="Digite el Teléfono del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="numero_puesto" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('numero_puesto') is-invalid @enderror" value="{{ old('numero_puesto') }}" id="numero_puesto" placeholder="Escriba el Número Puesto">
                    </div>
                    <select name="clasificacion" id="clasificacion" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400" required>
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

                    <div class="flex justify-center">
                        <select name="fk_mercado" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400  mt-2 text-gray-400 form-control @error('fk_mercado') is-invalid @enderror" id="fk_mercado">
                            @foreach($mercados as $mercado)
                                <option class="font-bold text-xl text-gray-800" value="{{ $mercado->id }}" {{ old('fk_mercado') == $mercado->id ? 'selected' : '' }}>{{ $mercado->nombre }}</option>
                            @endforeach
                        </select>
                        @error('fk_mercado')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="flex justify-center mt-16">
                        <button class="btn btn-primary bg-purple-600 w-72 h-10 text-white font-bold rounded-md">Registrar Vendedor</button>
                    </div>
                </div>
            </form>
        </div>
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
