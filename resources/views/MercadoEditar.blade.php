<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar área</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-pink-50 to-red-50 min-h-screen">

    {{-- Navbar Mercado --}}
    @include('components.navbar-mercado')

    <main class="max-w-3xl mx-auto mt-16 p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h1 class="text-3xl font-bold text-center text-red-500 uppercase mb-2">Editor de Área</h1>
            <h2 class="text-lg text-center text-gray-700 mb-6">
                {{ old('nombre', $mercadoLocal?->nombre) }}
                <span class="font-bold">ID: #{{ old('ROL', $mercadoLocal?->id) }}</span>
            </h2>

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="bg-green-500 text-white text-sm p-3 mb-4 rounded text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errores --}}
            @if ($errors->any())
                <div class="bg-orange-500 text-white p-3 rounded text-sm mb-4">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('mercados.actualizar', $mercadoLocal->id) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- Imagen --}}
                <div class="flex flex-col items-center">
                    <label for="imagen_referencia"
                           class="w-full md:w-80 bg-red-100 border border-red-300 rounded-xl p-3 flex justify-between items-center cursor-pointer hover:bg-red-200 transition">
                        <span class="text-gray-500 text-sm">Imagen del área</span>
                        <img class="w-5 h-5" src="{{ asset('imgs/files2.svg') }}" alt="">
                        <input type="file" accept=".png,.jpg,.jpeg" name="imagen_referencia" class="hidden" id="imagen_referencia">
                    </label>

                    {{-- Imagen actual --}}
                    <div class="text-center mt-3">
                        @if ($mercadoLocal?->imagen_referencia)
                            <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                            <img id="img-preview" class="mx-auto max-h-40 rounded-xl shadow-lg border"
                                 src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}"
                                 alt="Imagen del Mercado">
                        @else
                            <img id="img-preview" class="hidden" alt="Preview">
                            <p class="text-xs text-gray-400 mt-2">No hay imagen actual</p>
                        @endif
                    </div>

                    {{-- Campo oculto para conservar la imagen --}}
                    <input type="hidden" name="imagen_referencia_actual"
                           value="{{ $mercadoLocal->imagen_referencia }}">
                </div>

                {{-- Campos de texto --}}
                <div class="space-y-4">
                    <input required type="text" name="nombre" placeholder="Nombre registrado del mercado"
                        value="{{ old('nombre', $mercadoLocal?->nombre) }}"
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <textarea maxlength="200" required name="descripcion" placeholder="Descripción del mercado"
                        class="w-full h-28 p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>

                </div>

                {{-- Botones --}}
                <div class="flex flex-col gap-4 mt-6">
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:shadow-lg transition">
                        Actualizar Mercado
                    </button>

                    <a href="{{ route('mercados.index') }}"
                        class="w-full py-3 bg-gray-500 text-white font-bold rounded-xl text-center hover:bg-gray-600 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </main>

    {{-- Script vista previa --}}
    <script>
        document.getElementById('imagen_referencia').addEventListener('change', function(event) {
            const preview = document.getElementById('img-preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    preview.src = reader.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
