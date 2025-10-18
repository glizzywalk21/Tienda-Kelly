<!DOCTYPE html>
<html lang="en" class="scroll-smooth antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Producto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>
<body class="bg-gradient-to-b from-slate-50 to-white text-slate-900">
    <!-- Navbar -->
    <div class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-sm sticky top-0 z-50 border-b border-slate-100">
        <a href="{{ route('vendedores.index') }}" class="group inline-flex items-center gap-2">
            <img src="{{ asset('images/shop.png') }}" alt="Logo" class="w-7 h-7">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                Tienda Kelly <span class="text-indigo-600 group-hover:text-indigo-700 transition-colors">Vendedores</span>
            </h1>
        </a>
        <nav class="flex gap-6">
            <a href="{{ route('vendedores.index') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mis Productos</a>
            <a href="{{ route('vendedores.reservas') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mis Reservas</a>
            <a href="{{ route('vendedores.historial') }}" class="font-medium uppercase text-xs md:text-sm hover:text-indigo-700 transition">Mi Historial</a>
            <a href="{{ route('vendedor.perfil') }}" class="font-semibold uppercase text-xs md:text-sm border border-indigo-600 text-indigo-600 px-3 py-1.5 rounded-md hover:bg-indigo-600 hover:text-white transition">Perfil</a>
        </nav>
    </div>

    <!-- Mobile bottom bar -->
    <div class="fixed bottom-4 left-0 right-0 md:hidden flex justify-center z-50">
        <div class="bg-slate-900/95 backdrop-blur rounded-2xl w-64 h-14 flex justify-around px-2 shadow-2xl">
            <a href="{{ route('vendedores.index') }}" class="grid place-items-center w-12" aria-label="Inicio">
                <img class="w-6" src="{{ asset('images/vendedor.home.png') }}" alt="Home Icon" />
            </a>
            <a href="{{ route('vendedores.productos') }}" class="grid place-items-center w-12" aria-label="Productos">
                <img class="w-6" src="{{ asset('images/vendedor.productos.png') }}" alt="Cart Icon" />
            </a>
            <a href="{{ route('vendedores.reservas') }}" class="grid place-items-center w-12" aria-label="Reservas">
                <img class="w-6" src="{{ asset('images/vendedor.reservas.png') }}" alt="Favorites Icon" />
            </a>
            <a href="{{ route('vendedores.historial') }}" class="grid place-items-center w-12" aria-label="Historial">
                <img class="w-6" src="{{ asset('images/mercado.historial.blancopng.png') }}" alt="Favorites Icon" />
            </a>
            <a href="{{ route('vendedor.perfil') }}" class="grid place-items-center w-12" aria-label="Perfil">
                <img class="w-6" src="{{ asset('images/vendedor.perfil.png') }}" alt="Profile Icon" />
            </a>
        </div>
    </div>

    <!-- ===== Formulario centrado ===== -->
    <div class="px-6">
        <form method="POST"
              action="{{ route('vendedores.actualizarproducto', $producto->id) }}"
              enctype="multipart/form-data"
              onsubmit="calculatePrice()"
              class="max-w-2xl mx-auto mt-12">
            @csrf
            @method('PUT')
            <input type="hidden" name="fk_vendedors" value="{{ $vendedor->id }}">

            <div class="text-center">
                <h1 class="text-[2rem] font-extrabold text-indigo-600 uppercase">Editar Producto</h1>
                <h3 class="mt-3 text-lg text-slate-700">
                    Puesto de: <span class="font-semibold text-slate-900">{{ $vendedor->nombre_del_local }}</span>
                </h3>
            </div>

            @if (session('error'))
                <div class="mt-6 rounded-md border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-6 rounded-md border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                    <ul class="list-disc ml-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-8 bg-white rounded-2xl shadow-sm ring-1 ring-slate-200/60 p-6 space-y-6">
                <!-- Imagen -->
                <div class="mx-auto w-full max-w-md">
                    <label for="file-input" class="block text-sm font-medium text-slate-700 mb-2 text-center">
                        Imagen del producto
                    </label>
                    <div class="flex flex-col items-center gap-4">
                        <img id="image-preview"
                             src="{{ asset('images/' . $producto->imagen_referencia) }}"
                             alt="{{ $producto->imagen_referencia }}"
                             class="w-28 h-28 rounded-xl object-cover ring-1 ring-slate-200/70">
                        <label class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50 cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <img src="{{ asset('images/files2.svg') }}" class="w-4 h-4" alt="">
                            Cambiar imagen
                            <input id="file-input" type="file" name="imagen_referencia" accept="image/*" class="hidden" onchange="previewImage(event)">
                        </label>
                    </div>
                </div>

                <!-- Nombre -->
                <div class="mx-auto w-full max-w-md">
                    <label class="block text-sm font-medium text-slate-700 mb-1 text-center">Nombre del producto</label>
                    <input
                        class="w-full h-10 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        type="text" name="name" value="{{ old('name', $producto->name) }}" placeholder="Ej. Café molido premium" required>
                </div>

                <!-- Descripción -->
                <div class="mx-auto w-full max-w-md">
                    <label class="block text-sm font-medium text-slate-700 mb-1 text-center">Descripción</label>
                    <textarea maxlength="200"
                        class="w-full min-h-24 rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        name="description" placeholder="Máximo 200 caracteres">{{ old('description', $producto->description) }}</textarea>
                    <p class="mt-1 text-xs text-slate-500 text-center">
                        Te quedan {{ max(0, 200 - strlen(old('description', $producto->description ?? ''))) }} caracteres aprox.
                    </p>
                </div>

                <!-- Tipo de precio -->
                <div class="mx-auto w-full max-w-md">
                    <label for="price-type" class="block text-sm font-medium text-slate-700 mb-1 text-center">Tipo de precio</label>
                    <select id="price-type" name="price_type"
                        class="w-full h-10 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        onchange="togglePriceFields()">
                        <option value="fixed" {{ old('price_type', $producto->price_type) === 'fixed' ? 'selected' : '' }}>Precio definido</option>
                        <option value="per_dollar" {{ old('price_type', $producto->price_type) === 'per_dollar' ? 'selected' : '' }}>Cantidad por dólar</option>
                    </select>
                </div>

                <!-- Precio definido -->
                <div id="fixed-price-field" class="mx-auto w-full max-w-md {{ (old('price_type', $producto->price_type) !== 'fixed') ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-slate-700 mb-1 text-center">Precio (USD)</label>
                    <input
                        class="w-full h-10 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        type="number" name="price" step="0.01" min="0" value="{{ old('price', $producto->price) }}" placeholder="0.00"
                        {{ (old('price_type', $producto->price_type) === 'fixed') ? 'required' : '' }}>
                </div>

                <!-- Cantidad por dólar -->
                <div id="per-dollar-field" class="mx-auto w-full max-w-md {{ (old('price_type', $producto->price_type) !== 'per_dollar') ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-slate-700 mb-1 text-center">Cantidad por 1 USD</label>
                    <input
                        class="w-full h-10 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        type="number" id="quantity" name="quantity_per_dollar" step="1" min="1"
                        value="{{ old('quantity_per_dollar', $producto->quantity_per_dollar) }}" placeholder="Ej. 4 (unidades por dólar)">
                    <p class="mt-1 text-xs text-slate-500 text-center">
                        Al guardar se calculará el precio como <strong>1 / cantidad</strong>.
                    </p>
                </div>

                <!-- Estado -->
                <input type="hidden" name="estado" value="{{ old('estado', $producto->estado) }}">

                <!-- Acciones (no centradas) -->
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ url()->previous() ?: route('vendedores.index') }}"
                       class="inline-flex items-center gap-2 px-4 h-10 rounded-md border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        ← Cancelar
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center px-5 h-10 rounded-md bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        Guardar cambios
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function togglePriceFields() {
            var priceType = document.getElementById('price-type').value;
            var fixedPriceField = document.getElementById('fixed-price-field');
            var perDollarField = document.getElementById('per-dollar-field');
            var priceInput = document.querySelector('input[name="price"]');

            if (priceType === 'fixed') {
                fixedPriceField.classList.remove('hidden');
                perDollarField.classList.add('hidden');
                priceInput.required = true;
            } else {
                fixedPriceField.classList.add('hidden');
                perDollarField.classList.remove('hidden');
                priceInput.required = false;
            }
        }

        function calculatePrice() {
            var priceType = document.getElementById('price-type').value;
            var priceInput = document.querySelector('input[name="price"]');
            if (priceType === 'per_dollar') {
                var quantity = parseFloat(document.getElementById('quantity').value);
                if (quantity && quantity > 0) {
                    var calculatedPrice = 1 / quantity;
                    priceInput.value = calculatedPrice.toFixed(2);
                }
            }
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            if (event.target.files && event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', togglePriceFields);
    </script>

    @include('components.footer')
</body>
</html>
