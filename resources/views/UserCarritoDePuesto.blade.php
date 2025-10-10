<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>TiendaKelly Carrito</title>
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
</head>

<body>


    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">Tienda Kelly</h1>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Hogar</a>
            <a href="{{ route('usuarios.carrito') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Carrito</a>
            <a href="{{ route('usuarios.reservas') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Reservas</a>
            <a href="{{ route('UserProfileVista') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('usuarios.index') }}" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('usuarios.carrito') }}">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('usuarios.reservas') }}">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('UserProfileVista') }}">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Lista de productos -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Lista de Productos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Producto 1 -->
                <div class="p-4 rounded-lg border">
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Producto 1"
                            class="w-16 h-16 object-cover rounded">
                        <div class="h-8 font-bold bg-slate-900 rounded-md w-20 flex items-center justify-between px-2">
                            <button class="text-white">-</button>
                            <span class="text-white">1</span>
                            <button class="text-white">+</button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Nombre del Producto</p>
                        <p class="text-xs text-gray-500">Vendedor</p>
                        <p class="text-lg font-semibold mt-2">$100</p>
                    </div>
                </div>
                <!-- Producto 1 -->
                <div class="p-4 rounded-lg border">
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Producto 1"
                            class="w-16 h-16 object-cover rounded">
                        <div class="h-8 font-bold bg-slate-900 rounded-md w-20 flex items-center justify-between px-2">
                            <button class="text-white">-</button>
                            <span class="text-white">1</span>
                            <button class="text-white">+</button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Nombre del Producto</p>
                        <p class="text-xs text-gray-500">Vendedor</p>
                        <p class="text-lg font-semibold mt-2">$100</p>
                    </div>
                </div>
                <div class="p-4 rounded-lg border">
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Producto 1"
                            class="w-16 h-16 object-cover rounded">
                        <div class="h-8 font-bold bg-slate-900 rounded-md w-20 flex items-center justify-between px-2">
                            <button class="text-white">-</button>
                            <span class="text-white">1</span>
                            <button class="text-white">+</button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Nombre del Producto</p>
                        <p class="text-xs text-gray-500">Vendedor</p>
                        <p class="text-lg font-semibold mt-2">$100</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Resumen de la compra -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Resumen de la Compra</h2>
            <div class="bg-white p-4 border rounded-lg shadow-md">
                <div class="flex justify-between mb-4">
                    <p class="text-sm text-gray-600">Subtotal (3 productos)</p>
                    <p class="text-sm font-semibold">$300</p>
                </div>
                <div class="flex justify-between mb-4">
                    <p class="text-sm text-gray-600">Costo de Reserva</p>
                    <p class="text-sm font-semibold">$10</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p class="text-lg font-semibold">Total a Pagar</p>
                    <p class="text-lg font-semibold">$310</p>
                </div>
                <button
                    class="mt-4 bg-slate-800 hover:bg-slate-600 text-white py-2 w-full rounded-md focus:outline-none">Comprar</button>
            </div>
        </div>
    </div>


</body>

</html>