<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Area</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
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

        <div class="max-w-xl mx-auto mt-16 px-4 pb-16">
            <!-- Encabezado -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-indigo-500">Editor de Área</h1>
                <h2 class="text-sm text-gray-600 mt-2">
                    {{ old('nombre', $mercadoLocal?->nombre) }}
                    <span class="font-bold text-gray-800">ID: #{{ old('ROL', $mercadoLocal?->id) }}</span>
                </h2>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('admin.actualizarmercados', $mercadoLocal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" id="fallbackInput" value="{{ $mercadoLocal->imagen_referencia }}" name="imagen_referencia">

                <div class="space-y-6">
                    <!-- Imagen -->
                    <div>
                        <label for="imagen_referencia" class="block text-sm font-medium text-gray-700 mb-1">Imagen del área</label>
                        <input type="file" accept=".png, .jpg, .jpeg" name="imagen_referencia" id="imagen_referencia"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        {!! $errors->first('imagen_referencia', '<div class="text-indigo-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Vista previa -->
                    @if ($mercadoLocal?->imagen_referencia)
                    <div>
                        <p class="text-gray-400 text-xs text-center">Imagen actual:</p>
                        <img id="img-preview" class="mt-4 w-full max-h-64 object-cover rounded-md border" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="Imagen del Mercado">
                    </div>
                    @else
                    <div>
                        <p class="text-gray-400 text-xs text-center">No hay imagen actual.</p>
                    </div>
                    @endif

                    <!-- Nombre del área -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre Registrado del area</label>
                        <input required type="text" name="nombre" id="nombre"
                            value="{{ old('nombre', $mercadoLocal?->nombre) }}"
                            placeholder="Ej. Área de Frutas"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        {!! $errors->first('nombre', '<div class="text-indigo-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción del Área</label>
                        <textarea maxlength="200" required name="descripcion" id="descripcion" rows="4"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            placeholder="Describe brevemente el área">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
                        {!! $errors->first('descripcion', '<div class="text-indigo-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Botón Actualizar -->
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 px-4 rounded-md shadow-md transition duration-200">
                            Actualizar
                        </button>
                    </div>

                    <!-- Botón Cancelar -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('admin.index') }}"
                            class=" w-full inline-block bg-gray-600 hover:bg-gray-500 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200">
                            Cancelar Actualización
                        </a>
                    </div>
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