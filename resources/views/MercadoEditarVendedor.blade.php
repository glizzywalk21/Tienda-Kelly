<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-pink-50 to-red-50 min-h-screen">

    {{-- Navbar --}}
    @include('components.navbar-mercado')

    <main class="max-w-3xl mx-auto mt-16 p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h1 class="text-3xl font-bold text-center text-red-500 uppercase mb-2">Editar Vendedor</h1>
            <h2 class="text-lg text-center text-gray-700 mb-6">{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}</h2>

            <form method="POST" action="{{ route('mercados.actualizarvendedor', ['id' => $vendedor->id]) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="id" value="{{ $vendedor->id }}">

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-2 rounded text-center text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Imagen --}}
                <div class="flex justify-center">
                    <label for="imagen_de_referencia" class="w-full md:w-80 bg-red-100 border border-red-300 rounded-xl p-3 flex justify-between items-center cursor-pointer hover:bg-red-200 transition">
                        <span class="text-gray-500 text-sm">Imagen de <b>Usted</b> o <b>Su Puesto</b></span>
                        <img class="w-5 h-5" src="{{ asset('imgs/files2.svg') }}" alt="">
                        <input type="file" name="imagen_de_referencia" id="imagen_de_referencia" class="hidden" accept=".png,.jpg,.jpeg">
                    </label>
                </div>

                {{-- Preview --}}
                <div class="text-center mt-3">
                    @if ($vendedor?->imagen_de_referencia)
                        <img id="img-preview" class="mx-auto max-h-40 rounded-xl shadow-lg" src="{{ asset('imgs/' . $vendedor?->imagen_de_referencia) }}" alt="Imagen del Vendedor">
                    @else
                        <img id="img-preview" class="hidden" alt="Preview">
                    @endif
                </div>

                {{-- Inputs en Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="nombre" value="{{ old('nombre', $vendedor?->nombre) }}" placeholder="Nombre" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input type="text" name="apellidos" value="{{ old('apellidos', $vendedor?->apellidos) }}" placeholder="Apellidos" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input type="text" name="telefono" value="{{ old('telefono', $vendedor?->telefono) }}" placeholder="Teléfono" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input type="text" name="numero_puesto" value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}" placeholder="Número de Puesto" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input type="text" name="nombre_del_local" value="{{ old('nombre_del_local', $vendedor?->nombre_del_local) }}" placeholder="Nombre del Local" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <select name="fk_mercado" class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">
                        @foreach($mercados as $mercado)
                            <option value="{{ $mercado->id }}" {{ old('fk_mercado', $vendedor?->fk_mercado) == $mercado->id ? 'selected' : '' }}>{{ $mercado->nombre }}</option>
                        @endforeach
                    </select>

                    <select name="clasificacion" required class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">
                        <option value="" disabled>Escoge su Clasificación</option>
                        <option value="comedor" {{ old('clasificacion', $vendedor?->clasificacion) == 'comedor' ? 'selected' : '' }}>Comedor</option>
                        <option value="venta de abarrotes" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de abarrotes' ? 'selected' : '' }}>Venta de Abarrotes</option>
                        <option value="venta de ropa" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de ropa' ? 'selected' : '' }}>Venta de Ropa</option>
                        <option value="venta de calzado" {{ old('clasificacion', $vendedor?->clasificacion) == 'venta de calzado' ? 'selected' : '' }}>Venta de Calzado</option>
                    </select>

                    <input type="email" name="usuario" value="{{ old('usuario', $vendedor?->usuario) }}" placeholder="Correo electrónico" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input type="password" name="password" maxlength="8" placeholder="Contraseña"
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <input type="password" name="password_confirmation" maxlength="8" placeholder="Confirmar Contraseña" required
                        class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-400 focus:outline-none transition">

                    <label class="flex items-center text-gray-600 text-sm col-span-2">
                        <input type="checkbox" id="show-passwords" class="mr-2"> Mostrar Contraseñas
                    </label>
                </div>

                {{-- Botones --}}
                <div class="flex flex-col gap-4 mt-6">
                    <button class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-xl hover:shadow-lg transition">Actualizar Vendedor</button>
                    <a href="{{ route('mercados.listavendedores') }}" class="w-full py-3 bg-gray-500 text-white font-bold rounded-xl text-center hover:bg-gray-600 transition">Cancelar Actualización</a>
                </div>
            </form>
        </div>
    </main>

    {{-- Footer --}}
    @include('components.footer')

    <script>
        // Preview de imagen
        document.getElementById('imagen_de_referencia').addEventListener('change', function (e) {
            const preview = document.getElementById('img-preview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => { preview.src = reader.result; preview.classList.remove('hidden'); };
                reader.readAsDataURL(file);
            } else {
                preview.src = ''; preview.classList.add('hidden');
            }
        });

        // Mostrar contraseñas
        document.getElementById('show-passwords').addEventListener('change', function () {
            document.querySelectorAll('#password, #password_confirmation').forEach(p => p.type = this.checked ? 'text' : 'password');
        });
    </script>

</body>
</html>
