<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <title>Registrar Producto Vendedor</title>
</head>

<body>
    <!-- Desktop Navbar -->
    <div class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
        <a href="{{ route('vendedores.index') }}">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                Tienda Kelly <span class="text-indigo-400 font-bold">Vendedores</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('vendedores.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mis Productos</a>
            <a href="{{ route('vendedores.reservas') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Reservas</a>
            <a href="{{ route('vendedores.historial') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Mi Historial</a>
            <a href="{{ route('vendedor.perfil') }}"
                class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('vendedores.index') }}">
                    <img class="w-6" src="{{ asset('imgs/vendedor.home.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('vendedores.productos') }}">
                    <img class="w-6" src="{{ asset('imgs/vendedor.productos.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('vendedores.reservas') }}">
                    <img class="w-6" src="{{ asset('imgs/vendedor.reservas.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('vendedores.historial') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.historial.blancopng.png') }}"
                        alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('vendedor.perfil') }}">
                    <img class="w-6" src="{{ asset('imgs/vendedor.perfil.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>
    <!-- fin del Mobile Navbar -->

    <form method="POST" action="{{ route('vendedores.guardarproducto') }}" enctype="multipart/form-data" onsubmit="calculatePrice()">
        @csrf
        <input type="hidden" name="fk_vendedors" value="{{ $vendedor->id }}">

        <section class="max-w-md mx-auto mt-16 bg-white p-6 rounded-xl shadow-lg">
            <!-- Título -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-indigo-500">Registrar Producto</h1>
                <h3 class="text-lg text-gray-700">Puesto de: <span class="font-semibold">{{ $vendedor->nombre_del_local }}</span></h3>
            </div>

            <div class="space-y-5">
                <!-- Imagen del Producto -->
                <label for="file-input" class="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm cursor-pointer hover:bg-gray-50 transition">
                    <span class="text-sm text-gray-600">Imagen del Producto</span>
                    <input id="file-input" type="file" name="imagen_referencia" class="hidden" onchange="previewImage(event)">
                    <span class="w-5 h-5 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                </label>
                @error('imagen_referencia')
                <p class="text-rose-500 text-xs">{{ $message }}</p>
                @enderror

                <!-- Vista previa -->
                <div id="preview-container" class="text-center">
                    <img id="image-preview" src="#" alt="Vista previa de la imagen" class="hidden w-48 h-48 object-cover rounded-lg mx-auto mt-4 shadow-md">
                </div>

                <!-- Nombre del Producto -->
                <input type="text" name="name" placeholder="Nombre del Producto"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror

                <!-- Descripción del Producto -->
                <textarea maxlength="200" name="description" placeholder="Descripción del Producto"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-rose-500 text-xs">{{ $message }}</p>
                @enderror

                <!-- Tipo de Precio -->
                <select id="price-type" name="price_type"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    onchange="togglePriceFields()">
                    <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Precio Definido</option>
                    <option value="per_dollar" {{ old('price_type') == 'per_dollar' ? 'selected' : '' }}>Cantidad por Dólar</option>
                </select>
                @error('price_type')
                <p class="text-rose-500 text-xs">{{ $message }}</p>
                @enderror

                <!-- Precio del Producto -->
                <div id="fixed-price-field">
                    <input type="number" name="price" step="0.01" placeholder="Precio del Producto"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        value="{{ old('price') }}">
                    @error('price')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cantidad por Dólar -->
                <div id="per-dollar-field" class="hidden">
                    <input type="number" id="quantity" name="quantity" step="1" placeholder="Cantidad por Dólar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        value="{{ old('quantity') }}">
                    @error('quantity')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado del Producto -->
                <input type="hidden" name="estado" value="Disponible">

                <!-- Botón Guardar -->
                <div class="text-center mt-8">
                    <button type="submit"
                        class="w-full py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-md transition duration-300">
                        Guardar
                    </button>
                </div>
            </div>
        </section>
    </form>


    <script>
        function togglePriceFields() {
            var priceType = document.getElementById('price-type').value;
            var fixedPriceField = document.getElementById('fixed-price-field');
            var perDollarField = document.getElementById('per-dollar-field');

            if (priceType === 'fixed') {
                fixedPriceField.classList.remove('hidden');
                perDollarField.classList.add('hidden');
                document.querySelector('input[name="price"]').required = true;
            } else {
                fixedPriceField.classList.add('hidden');
                perDollarField.classList.remove('hidden');
                document.querySelector('input[name="price"]').required = false;
            }
        }

        function calculatePrice() {
            var priceType = document.getElementById('price-type').value;
            if (priceType === 'per_dollar') {
                var quantity = document.getElementById('quantity').value;
                if (quantity) {
                    var calculatedPrice = 1 / quantity;
                    document.querySelector('input[name="price"]').value = calculatedPrice.toFixed(2);
                }
            }
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>





</body>

</html>