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
            <div class="text-center pt-[3rem]">
                <h1 class="text-3xl font-semibold text-purple-500">Editar Vendedor <span class="font-bold">{{ $vendedor->nombre}} {{$vendedor->apellidos}}</span></h1>
                <h3 class="text-xl font-semibold ">Ubicado en <span class="font-bold">{{ $vendedor->mercadoLocal->nombre}} </span></h1>
            </div>

            <form method="POST" action="{{ route('admin.actualizarvendedor', ['id' => $vendedor->id]) }}" role="form" enctype="multipart/form-data">
                <div class="pb-[7rem] mt-10 space-y-4">

                    @csrf
                    <input type="hidden" name="id" value="{{ $vendedor->id }}">
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
                    <input type="hidden" id="fallbackInput" value="{{ $vendedor->imagen_de_referencia }}" name="imagen_de_referencia">
                <div class="flex justify-between">
                    <label for="imagen_de_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative cursor-pointer">
                        <span id="file-name" class="text-gray-400 text-xs">Imagen de <b>Usted</b> o de <b>Su Puesto</b>
                        </span>
                        <input  type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                        {!! $errors->first('imagen_de_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <!--FIN DEL INPUT DE LA IMG-->
                 <!--INICIO DE LA PREVIEW-->
                 @if ($vendedor?->imagen_de_referencia)
    <div class="mt-4">
        <p class="text-gray-400 text-xs text-center">Imagen actual:</p>
        <img id="img-preview" class="max-w max-h-xs rounded-md border" src="{{ asset('imgs/' . $vendedor?->imagen_de_referencia) }}" alt="Imagen del Vendedor">
    </div>
@else
    <div class="mt-4">
        <p class="text-gray-400 text-xs text-center">No hay imagen actual.</p>
    </div>
@endif

                <!---FIN DE LA PREVIEW-->

                    <div class="flex justify-center">
                        <input required type="email" name="usuario"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('usuario') is-invalid @enderror"
                            value="{{ old('usuario', $vendedor?->usuario) }}" id="usuario"
                            placeholder="Escriba el correo electrónico">
                        {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input type="password" maxlength="8" name="password"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" id="password"
                            placeholder="Escriba su Contraseña">
                        {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input type="password" maxlength="8" required name="password_confirmation"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('password_confirmation') is-invalid @enderror"
                            value="{{ old('password_confirmation') }}" id="password_confirmation"
                            placeholder="Confirme su Contraseña">
                        {!! $errors->first('password_confirmation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="show-passwords" class="mr-2">
                            <span class="text-xs text-gray-600">Mostrar Contraseñas</span>
                        </label>
                    </div>

                    <div class="flex justify-center">
                        <input required type="text" name="nombre"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $vendedor?->nombre) }}" id="nombre"
                            placeholder="Escriba el Nombre del Vendedor">
                        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input required type="text" name="apellidos"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('apellidos') is-invalid @enderror"
                            value="{{ old('apellidos', $vendedor?->apellidos) }}" id="apellidos"
                            placeholder="Escriba los Apellidos del Vendedor">
                        {!! $errors->first('apellidos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">

                        <input type="text" name="nombre_del_local"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre_del_local') is-invalid @enderror"
                            value="{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}" id="nombre_del_local"
                            placeholder="Digite el Nombre de su Local (Será Público)">
                        {!! $errors->first('nombre_del_local', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input type="text" name="telefono"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('telefono') is-invalid @enderror"
                            value="{{ old('telefono', $vendedor?->telefono) }}" id="telefono"
                            placeholder="Digite el Teléfono del Vendedor">
                        {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input required type="text" name="numero_puesto"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('numero_puesto') is-invalid @enderror"
                            value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}" id="numero_puesto"
                            placeholder="Escriba el Número del Puesto">
                        {!! $errors->first('numero_puesto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <select name="fk_mercado"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('fk_mercado') is-invalid @enderror"
                            id="fk_mercado">
                            @foreach($mercados as $mercado)
                                <option class="font-bold text-xl text-gray-800" value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>{{ $mercado->nombre }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('fk_mercado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <select name="clasificacion" id="clasificacion" class="border bg-gray-100 rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400" required>
                        <option class="font-bold text-xs text-white" value="null">Escoge su Clasificación</option>
                        <option class="font-bold text-xl text-gray-800" value="comedor" {{ old('clasificacion', $vendedor?->clasificacion) == 'comedor' ? 'selected' : '' }}>Comedor</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de abarrotes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de abarrotes' ? 'selected' : '' }}>Venta de Abarrotes</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de ropa" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de ropa' ? 'selected' : '' }}>Venta de Ropa</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de calzado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de calzado' ? 'selected' : '' }}>Venta de Calzado</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de herramientas" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de herramientas' ? 'selected' : '' }}>Venta de Herramientas</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de verduras" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de verduras' ? 'selected' : '' }}>Venta de Verduras</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de juguetes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de juguetes' ? 'selected' : '' }}>Venta de Juguetes</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de frutas" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de frutas' ? 'selected' : '' }}>Venta de Frutas</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de flores" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de flores' ? 'selected' : '' }}>Venta de Flores</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de carne" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de carne' ? 'selected' : '' }}>Venta de Carne</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de pescado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de pescado' ? 'selected' : '' }}>Venta de Pescado</option>
                        <option class="font-bold text-xl text-gray-800" value="venta de pollo" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de pollo' ? 'selected' : '' }}>Venta de Pollo</option>
                    </select>
                    {!! $errors->first('clasificacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                    <div class="flex justify-center">
                        <div class="flex justify-center mt-8">

                            <button type="submit" class="btn btn-primary bg-purple-600 w-72 h-12 text-white font-bold rounded-md">Actualizar Vendedor</button>
                        </div>
                    </form>

                    </div>
                    <div class="flex justify-center mt-4">

                        <a href="{{ route('mercados.index')}}"  class=" bg-gray-600  text-white font-bold rounded-md  py-[0.75rem] px-[3.5rem]">Cancelar Actualizacion</a>
                    </a>
                    </div>
                </div>

        </div>
    </section>

    <script>
        document.getElementById('imagen_de_referencia').addEventListener('change', function (e) {
            const preview = document.getElementById('img-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    preview.src = reader.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });

        document.getElementById('show-passwords').addEventListener('change', function () {
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
