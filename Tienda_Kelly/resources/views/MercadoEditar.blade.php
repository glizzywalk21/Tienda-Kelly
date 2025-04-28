<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Mercado</title>
        <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
    <section><div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
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
        <div class="w-72 h-auto mx-auto mt-16 pb-[3rem]">

            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-700">Editor de Mercado Local</h1>
                <h3 class="text-sm mt-2">{{ old('nombre', $mercadoLocal?->nombre) }} <span class="font-bold">ID:
                        #{{ old('ROL', $mercadoLocal?->id) }}</span></h3>
            </div>

            <form method="POST" action="{{ route('mercados.actualizar', $mercadoLocal->id) }}" role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf
                @method('PATCH'

                )

                <div class="mt-20 space-y-4">
                    <input type="hidden" id="fallbackInput" value="{{ $mercadoLocal->imagen_referencia }}" name="imagen_referencia">

                    <!-- INICIO DE INPUT DE LA FOTO -->
                    <div class="flex justify-between">
                        <label for="imagen_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative cursor-pointer">
                            <span id="file-name" class="text-gray-400 text-xs">Imagen del mercado</span>
                            <input type="file" accept=".png, .jpg, .jpeg" name="imagen_referencia" class="hidden" id="imagen_referencia">
                            {!! $errors->first('imagen_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>
                    <!-- FIN DEL INPUT DE LA IMG -->

                    <!-- INICIO DE LA PREVIEW -->
                    @if ($mercadoLocal?->imagen_referencia)
                    <div class="mt-4">
                        <p class="text-gray-400 text-xs text-center">Imagen actual:</p>
                        <img id="img-preview" class="max-w max-h-xs rounded-md border" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="Imagen del Mercado">
                    </div>
                @else
                    <div class="mt-4">
                        <p class="text-gray-400 text-xs text-center">No hay imagen actual.</p>
                    </div>
                @endif
                    <!-- FIN DE LA PREVIEW -->

                    <div class="flex justify-center">
                        <input required type="text" name="nombre" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $mercadoLocal?->nombre) }}" id="nombre" placeholder="Nombre Registrado del Mercado">
                        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>

                    <div class="flex justify-center">
                        <input required type="text" name="municipio" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('municipio') is-invalid @enderror" value="{{ old('municipio', $mercadoLocal?->municipio) }}" id="municipio" placeholder="Municipio Ubicado">
                        {!! $errors->first('municipio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="ubicacion" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion', $mercadoLocal?->ubicacion) }}" id="ubicacion" placeholder="Ubicación Específica del Mercado">
                        {!! $errors->first('ubicacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center">
                        <span class="text-xs text-gray-400 px-6">Hora de Entrada</span>
                        <span class="px-6 text-xs text-gray-400">Hora de Salida</span>
                    </div>
                    <div class="flex justify-center">
                        <input required type="time" name="horaentrada" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('horaentrada') is-invalid @enderror" value="{{ old('horaentrada', $mercadoLocal?->horaentrada) }}" id="horaentrada" placeholder="Hora de Entrada">
                        {!! $errors->first('horaentrada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                        <input required type="time" name="horasalida" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('horasalida') is-invalid @enderror" value="{{ old('horasalida', $mercadoLocal?->horasalida) }}" id="horasalida"  placeholder="Hora de Salida">
                        {!! $errors->first('horasalida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center">
                        <span class="text-xs text-gray-400 px-6">Descripción del Mercado</span>
                    </div>
                    <div class="flex justify-center">
                        <textarea maxlength="200" required name="descripcion" class="border-1 rounded-lg border w-80 h-24 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('descripcion') is-invalid @enderror" id="descripcion">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
                        {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                </div>

                <div class="pt-[2rem] flex justify-center mt-2 mb-4">
                    <button class="btn btn-primary bg-red-600 w-72 h-12 text-white font-bold rounded-md" type="submit">{{ __('Actualizar') }}</button>
                </div>
                <div class="flex justify-center m">

                    <a href="{{ route('mercados.index')}}"  class=" bg-gray-600  text-white font-bold rounded-md  py-[0.75rem] px-[3.5rem]">Cancelar Actualizacion</a>
                </a>
                </div>
            </form>


        </div>
    </section>

    <script>
        document.getElementById('imagen_referencia').addEventListener('change', function(event) {
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
                fileNameSpan.textContent = 'Imagen del mercado';
            }
        });
    </script>
    <script>
        function handleFormSubmit(event) {
            const fileInput = document.getElementById('imagen_referencia');
            const fallbackInput = document.getElementById('fallbackInput');

            if (!fileInput.value) {
                // No file selected, replace the file input with the fallback value
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.name = 'imagen_referencia';
                newInput.value = fallbackInput.value;
                fileInput.parentNode.replaceChild(newInput, fileInput);
            }
        }
    </script>


</html>
