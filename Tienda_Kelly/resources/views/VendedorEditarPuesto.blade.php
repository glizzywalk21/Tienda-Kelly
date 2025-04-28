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

    <section>
        <div class="w-72 h-auto mx-auto">
            <div class="text-center pt-[3rem]">
                <h1 class="text-[1.8rem] font-bold text-rose-400">EDITAR VENDEDOR</h1>
                <h1 class="text-[1.5rem] font-semibold">{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}</h1>
            </div>

            <form method="POST" action="{{ route('vendedores.actualizar', ['id' => $vendedor->id]) }}" role="form" enctype="multipart/form-data">
                <div class="pb-[7rem] mt-10 space-y-4">
                    <input type="hidden" name="id" value="{{ $vendedor->id }}">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-orange-500 text-white p-2 rounded mt-1 text-sm sm:text-sm text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!--INICIO DE INPUT DE LA FOTO-->
                <div class="flex justify-between">
                    <label for="imagen_de_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs  shadow-md border-gray-400 flex items-center relative cursor-pointer">
                        <span id="file-name" class="text-gray-400 text-xs">Imagen de usted o de su Puesto
                        </span>
                        <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                        {!! $errors->first('imagen_de_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <!--FIN DEL INPUT DE LA IMG-->
                 <!--INICIO DE LA PREVIEW-->
                 @if ($vendedor?->imagen_de_referencia)
    <div class="mt-4">
        <p class="text-gray-400 text-[1rem] text-center m-3">Imagen actual:</p>
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
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs  shadow-md text-gray-400 border-gray-400 form-control @error('usuario') is-invalid @enderror"
                            value="{{ old('usuario', $vendedor?->usuario) }}" id="usuario"
                            placeholder="Escriba el correo electrónico">
                        {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input type="password" maxlength="8" name="password"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs  shadow-md border-gray-400 form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" id="password"
                            placeholder="Escriba su Contraseña">
                        {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input type="password" maxlength="8" required name="password_confirmation"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs  shadow-md border-gray-400 form-control @error('password_confirmation') is-invalid @enderror"
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
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs text-gray-400  shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $vendedor?->nombre) }}" id="nombre"
                            placeholder="Escriba el Nombre del Vendedor">
                        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input required type="text" name="apellidos"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs text-gray-400 shadow-md border-gray-400 form-control @error('apellidos') is-invalid @enderror"
                            value="{{ old('apellidos', $vendedor?->apellidos) }}" id="apellidos"
                            placeholder="Escriba los Apellidos del Vendedor">
                        {!! $errors->first('apellidos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">

                        <input type="text" name="nombre_del_local"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs text-gray-400 shadow-md border-gray-400 form-control @error('nombre_del_local') is-invalid @enderror"
                            value="{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}" id="nombre_del_local"
                            placeholder="Digite el Nombre de su Local (Será Público)">
                        {!! $errors->first('nombre_del_local', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input type="text" name="telefono"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs  shadow-md border-gray-400 form-control @error('telefono') is-invalid @enderror text-gray-400"
                            value="{{ old('telefono', $vendedor?->telefono) }}" id="telefono"
                            placeholder="Digite el Teléfono del Vendedor">
                        {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input required type="text" name="numero_puesto"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs shadow-md border-gray-400 form-control @error('numero_puesto') is-invalid @enderror text-gray-400"
                            value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}" id="numero_puesto"
                            placeholder="Escriba el Número del Puesto">
                        {!! $errors->first('numero_puesto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <select name="fk_mercado"
                            class="border-1 rounded border border-gray-400 text-gray-400  w-80 h-9 pl-5 text-xs shadow-md form-control @error('fk_mercado') is-invalid @enderror"
                            id="fk_mercado">
                            @foreach($mercados as $mercado)
                            <option class=" text-xs text-gray-400 " value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>{{ $mercado->nombre }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('fk_mercado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <select name="clasificacion" id="clasificacion" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400" required>
                        <option class=" font-medium text-[1rem] text-black" value="null">Escoge su Clasificación</option>
                        <option class="font-medium text-[1rem] text-black" value="comedor" {{ old('clasificacion', $vendedor?->clasificacion) == 'comedor' ? 'selected' : '' }}>Comedor</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de abarrotes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de abarrotes' ? 'selected' : '' }}>Venta de Abarrotes</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de ropa" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de ropa' ? 'selected' : '' }}>Venta de Ropa</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de calzado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de calzado' ? 'selected' : '' }}>Venta de Calzado</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de herramientas" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de herramientas' ? 'selected' : '' }}>Venta de Herramientas</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de verduras" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de verduras' ? 'selected' : '' }}>Venta de Verduras</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de juguetes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de juguetes' ? 'selected' : '' }}>Venta de Juguetes</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de frutas" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de frutas' ? 'selected' : '' }}>Venta de Frutas</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de flores" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de flores' ? 'selected' : '' }}>Venta de Flores</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de carne" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de carne' ? 'selected' : '' }}>Venta de Carne</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de pescado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de pescado' ? 'selected' : '' }}>Venta de Pescado</option>
                        <option class="font-medium text-[1rem] text-black" value="venta de pollo" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de pollo' ? 'selected' : '' }}>Venta de Pollo</option>
                    </select>
                    {!! $errors->first('clasificacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                    <div class="flex justify-center">
                        <div class="flex justify-center mt-8">

                            <button class="btn btn-primary bg-rose-400 hover:bg-rose-500 w-72 h-12 text-white font-bold rounded-md">Actualizar Vendedor</button>
                        </div>
                    </form>

                    </div>
                    <div class="flex justify-center mt-4">

                        <a href="{{ route('vendedores.index')}}"  class=" bg-slate-400 hover:bg-slate-500  text-white font-bold rounded-md  py-[0.80rem] px-[3.7rem]">Cancelar Actualizacion</a>
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

</body>

</html>
