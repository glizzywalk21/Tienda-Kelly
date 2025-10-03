<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Mercado</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-pink-50 to-red-50 min-h-screen">

    {{-- Navbar Mercado --}}
    @include('components.navbar-mercado')

    <main class="max-w-3xl mx-auto mt-16 p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h1 class="text-3xl font-bold text-center text-red-500 uppercase mb-2">Editor de Mercado Local</h1>
            <h2 class="text-lg text-center text-gray-700 mb-6">
                {{ old('nombre', $mercadoLocal?->nombre) }} <span class="font-bold">ID: #{{ old('ROL', $mercadoLocal?->id) }}</span>
            </h2>

            <form method="POST" action="{{ route('mercados.actualizar', $mercadoLocal->id) }}" enctype="multipart/form-data" class="space-y-6" onsubmit="handleFormSubmit(event)">
                @csrf
                @method('PATCH')

                {{-- Imagen --}}
                <div class="flex flex-col items-center">
                    <label for="imagen_referencia" class="w-full md:w-80 bg-red-100 border border-red-300 rounded-xl p-3 flex justify-between items-center cursor-pointer hover:bg-red-200 transition">
                        <span class="text-gray-500 text-sm">Imagen del Mercado</span>
                        <img class="w-5 h-5" src="{{ asset('imgs/files2.svg') }}" alt="">
                        <input type="file" accept=".png,.jpg,.jpeg" name="imagen_referencia" class="hidden" id="imagen_referencia">
                    </label>

                    {{-- Preview --}}
                    <div class="text-center mt-3">
                        @if ($mercadoLocal?->imagen_referencia)
                            <img id="img-preview" class="mx-auto max-h-40 rounded-xl shadow-lg" src="{{ asset('imgs/' . $mercadoLocal->imagen_referencia) }}" alt="Imagen del Mercado">
                        @else
                            <img id="img-preview" class="hidden" alt="Preview">
                        @endif
                    </div>
                </div>

                {{-- Inputs --}}
                <input required type="text" name="nombre" placeholder="Nombre Registrado del Mercado"
                    value="{{ old('nombre', $mercadoLocal?->nombre) }}"
                    class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                <input required type="text" name="municipio" placeholder="Municipio Ubicado"
                    value="{{ old('municipio', $mercadoLocal?->municipio) }}"
                    class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                <input required type="text" name="ubicacion" placeholder="Ubicación Específica del Mercado"
                    value="{{ old('ubicacion', $mercadoLocal?->ubicacion) }}"
                    class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input required type="time" name="horaentrada"
                        value="{{ old('horaentrada', $mercadoLocal?->horaentrada) }}"
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input required type="time" name="horasalida"
                        value="{{ old('horasalida', $mercadoLocal?->horasalida) }}"
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">
                </div>

                <textarea maxlength="200" required name="descripcion" placeholder="Descripción del Mercado"
                    class="w-full h-28 p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>

                {{-- Botones --}}
                <div class="flex flex-col gap-4 mt-6">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:shadow-lg transition">
                        Actualizar Mercado
                    </button>
                    <a href="{{ route('mercados.index') }}" class="w-full py-3 bg-gray-500 text-white font-bold rounded-xl text-center hover:bg-gray-600 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('imagen_referencia').addEventListener('change', function(event) {
            const preview = document.getElementById('img-preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => { preview.src = reader.result; preview.classList.remove('hidden'); };
                reader.readAsDataURL(file);
            } else {
                preview.src = ''; preview.classList.add('hidden');
            }
        });

        function handleFormSubmit(event) {
            const fileInput = document.getElementById('imagen_referencia');
            const fallbackInput = document.getElementById('fallbackInput');
            if (!fileInput.value && fallbackInput) {
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.name = 'imagen_referencia';
                newInput.value = fallbackInput.value;
                fileInput.parentNode.replaceChild(newInput, fileInput);
            }
        }
    </script>

</body>
</html>
