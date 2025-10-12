<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <title>Agregar Mercado Local</title>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

    <section>
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center">
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

        <div class="max-w-xl mx-auto px-4 mt-32 ">
            <!-- Título -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-indigo-600">Agregar Area</h1>
                <h2 class="text-sm text-gray-500 mt-2 tracking-wide">LOCAL</h2>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('admin.guardarmercados') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <!-- Imagen del mercado -->
                    <div>
                        <label for="imagen_referencia" class="block text-sm font-medium text-gray-700 mb-1">Imagen del area</label>
                        <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_referencia" id="imagen_referencia"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        {!! $errors->first('imagen_referencia', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Vista previa -->
                    <div>
                        <p class="text-gray-400 text-xs text-center">Su foto se vería así:</p>
                        <img id="img-preview" class="mt-4 hidden w-full max-h-64 object-cover rounded-md border" src="#" alt="Vista Previa de Imagen">
                    </div>

                    <!-- Nombre del mercado -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre Registrado del area</label>
                        <input required type="text" name="nombre" id="nombre" value="{{ old('nombre', $mercadoLocal?->nombre) }}"
                            placeholder="Ej. area central"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        {!! $errors->first('nombre', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción del area</label>
                        <textarea maxlength="200" required name="descripcion" id="descripcion" rows="4"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-300"
                            placeholder="Describe brevemente de el area">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
                        {!! $errors->first('descripcion', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Correo -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input required type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="Ej. correo@ejemplo.com"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        {!! $errors->first('email', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                        <input required type="password" name="password" id="password" placeholder="Ingrese contraseña"
                            class="w-full border rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        {!! $errors->first('password', '<div class="text-red-500 text-xs mt-1"><strong>:message</strong></div>') !!}
                    </div>

                    <!-- Botón -->
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200">
                            Guardar
                        </button>
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
                if(fileNameSpan) fileNameSpan.textContent = input.files[0].name;
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                if(fileNameSpan) fileNameSpan.textContent = 'Imagen del mercado';
            }
        });
    </script>

</body>

</html>
