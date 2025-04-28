<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>EDITAR USUARIO</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>

<body>

    <section>
        <div class="w-72 h-auto mx-auto">
            <div class="text-center pt-[3rem]">
                <h1 class="text-[1.8rem] font-bold text-rose-400">EDITAR USUARIO</h1>
                <h1 class="text-[1.5rem] font-semibold">{{ old('nombre', $cliente?->nombre) }}</h1>
            </div>

            <form method="POST" action="{{ route('usuarios.actualizar', ['id' => $cliente->id]) }}" role="form" enctype="multipart/form-data">
                <div class="pb-[7rem] mt-10 space-y-4">
                    <input type="hidden" name="id" value="{{ $cliente->id }}">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-orange-500 text-white p-2 rounded mt-1 text-sm text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Imagen de perfil -->
                    <div class="flex justify-between">
                        <label for="imagen_perfil" class="border-1 rounded border w-80 h-9 pl-5 text-xs shadow-md border-gray-400 flex items-center relative cursor-pointer">
                            <span id="file-name" class="text-gray-400 text-xs">Imagen de Perfil</span>
                            <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_perfil" class="hidden" id="imagen_perfil">
                            {!! $errors->first('imagen_perfil', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>

                    <!-- Vista previa de la imagen -->
                    @if ($cliente?->imagen_perfil )
                        <div class="mt-4">
                           <div class="relative justify-center">
                            <p class="text-gray-400 text-[1rem] text-center m-3">Imagen actual:</p><br>
                            <center>
                                <img id="img-preview" class=" max-w max-h-xs rounded-md border" src="{{ asset('imgs/' . $cliente?->imagen_perfil) }}" alt="Imagen del Usuario">
                            </center>
                           </div>
                        </div>
                    @else
                        <div class="mt-4">
                            <p class="text-gray-400 text-xs text-center">No hay imagen actual.</p>
                        </div>
                    @endif

                    <!-- Usuario (correo electrónico) -->
                    <div class="flex justify-center">
                        <input required type="email" name="usuario"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs shadow-md text-gray-400 border-gray-400 form-control @error('usuario') is-invalid @enderror"
                            value="{{ old('usuario', $cliente?->usuario) }}" id="usuario"
                            placeholder="Escriba el correo electrónico">
                        {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Contraseña -->
                    <div class="flex justify-center">
                        <input type="password" maxlength="8" name="password"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs shadow-md border-gray-400 form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" id="password"
                            placeholder="Escriba su Contraseña">
                        {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Confirmación de contraseña -->
                    <div class="flex justify-center">
                        <input type="password" maxlength="8" required name="password_confirmation"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs shadow-md border-gray-400 form-control @error('password_confirmation') is-invalid @enderror"
                            value="{{ old('password_confirmation') }}" id="password_confirmation"
                            placeholder="Confirme su Contraseña">
                        {!! $errors->first('password_confirmation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Mostrar contraseñas -->
                    <div class="flex justify-center mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="show-passwords" class="mr-2">
                            <span class="text-xs text-gray-600">Mostrar Contraseñas</span>
                        </label>
                    </div>

                    <!-- Nombre del usuario -->
                    <div class="flex justify-center">
                        <input required type="text" name="nombre"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs text-gray-400 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $cliente?->nombre) }}" id="nombre"
                            placeholder="Escriba el Nombre del Usuario">
                        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Apellido del usuario -->
                    <div class="flex justify-center">
                        <input required type="text" name="apellido"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs text-gray-400 shadow-md border-gray-400 form-control @error('apellido') is-invalid @enderror"
                            value="{{ old('apellido', $cliente?->apellido) }}" id="apellido"
                            placeholder="Escriba el Apellido del Usuario">
                        {!! $errors->first('apellido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Teléfono del usuario -->
                    <div class="flex justify-center">
                        <input type="text" name="telefono"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs shadow-md border-gray-400 form-control @error('telefono') is-invalid @enderror text-gray-400"
                            value="{{ old('telefono', $cliente?->telefono) }}" id="telefono"
                            placeholder="Digite el Teléfono del Usuario">
                        {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Sexo del usuario -->
                    <div class="flex justify-center">
                        <select name="sexo"
                            class="border-1 rounded border border-gray-400 text-gray-400 w-80 h-9 pl-5 text-xs shadow-md form-control @error('sexo') is-invalid @enderror"
                            id="sexo">
                            <option value="" disabled selected>Seleccione el sexo</option>
                            <option value="Masculino" {{ old('sexo', $cliente?->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo', $cliente?->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        {!! $errors->first('sexo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Rol del usuario -->
                    <div class="flex justify-center">
                        <input type="hidden" name="ROL" value="4">
                    </div>

                    <!-- Botón de Actualizar -->
                    <div class="flex justify-center mt-8">
                        <button class="btn btn-primary bg-rose-400 hover:bg-rose-500 w-72 h-12 text-white font-bold rounded-md">Actualizar Usuario</button>
                    </div>
                </form>

                <!-- Botón de Cancelar -->
                <div class="flex justify-center mt-4">
                    <a href="{{ route('usuarios.index')}}" class="bg-slate-400 hover:bg-slate-500 text-white font-bold rounded-md py-[0.80rem] px-[3.7rem]">Cancelar Actualización</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script>
        document.getElementById('imagen_perfil').addEventListener('change', function (e) {
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
