<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Área</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">
    <section>
        <!-- NAVBAR MÓVIL -->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center">
                    <a href="{{ route('admin.index') }}"><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="Inicio"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="Vendedores"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="Clientes"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Perfil"></a>
                </div>
            </div>
        </div>
        <!-- FIN NAVBAR -->

        <div class="max-w-xl mx-auto mt-16 px-4 pb-16">
            <!-- Encabezado -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-indigo-500">Editor de Área</h1>
                <h2 class="text-sm text-gray-600 mt-2">
                    {{ old('nombre', $mercadoLocal?->nombre) }}
                    <span class="font-bold text-gray-800">ID: #{{ $mercadoLocal?->id }}</span>
                </h2>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('admin.actualizarmercados', $mercadoLocal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Imagen actual: siempre enviar como fallback -->
                <input type="hidden" name="imagen_referencia" value="{{ $mercadoLocal->imagen_referencia }}">

                <div class="space-y-6">
                    <!-- Imagen -->
                    <div>
                        <label for="nueva_imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen del área</label>
                        <input type="file" accept=".png, .jpg, .jpeg" name="nueva_imagen" id="nueva_imagen"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                   file:rounded-full file:border-0 file:text-sm file:font-semibold 
                                   file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        {!! $errors->first('nueva_imagen', '<div class="text-indigo-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Vista previa -->
                    <div>
                        <p class="text-gray-400 text-xs text-center">Imagen actual:</p>
                        <img id="img-preview" class="mt-4 w-full max-h-64 object-cover rounded-md border" 
                             src="{{ $mercadoLocal && $mercadoLocal->imagen_referencia ? asset('imgs/' . $mercadoLocal->imagen_referencia) : asset('imgs/default.png') }}" 
                             alt="Imagen del Mercado">
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre registrado del área</label>
                        <input required type="text" name="nombre" id="nombre"
                            value="{{ old('nombre', $mercadoLocal?->nombre) }}"
                            placeholder="Ej. Área de Frutas"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm 
                                   focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        {!! $errors->first('nombre', '<div class="text-indigo-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción del área</label>
                        <textarea maxlength="255" required name="descripcion" id="descripcion" rows="4"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm resize-none 
                                   focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            placeholder="Describe brevemente el área">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
                        {!! $errors->first('descripcion', '<div class="text-indigo-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Botón Actualizar -->
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold 
                                   py-3 px-4 rounded-md shadow-md transition duration-200">
                            Actualizar
                        </button>
                    </div>

                    <!-- Botón Cancelar -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('admin.index') }}"
                            class="w-full inline-block bg-gray-600 hover:bg-gray-500 text-white 
                                   font-semibold py-3 px-6 rounded-md shadow-md transition duration-200">
                            Cancelar Actualización
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Vista previa de la nueva imagen (si el usuario selecciona una)
        const inputFile = document.getElementById('nueva_imagen');
        const preview = document.getElementById('img-preview');

        inputFile?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    preview.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
