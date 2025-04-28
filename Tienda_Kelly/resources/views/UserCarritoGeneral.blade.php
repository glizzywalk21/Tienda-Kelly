<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Mi Carrito</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-100">
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('usuarios.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                Tienda <span class="text-blue-600"><b>Kelly</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Hogar</a>
            <a href="{{ route('usuarios.carrito') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Carrito</a>
            <a href="{{ route('usuarios.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Reservas</a>
            <a href="{{ route('usuarios.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Historial</a>
            <a
                href="{{ route('UserProfileVista') }}" class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
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
    <!-- Fin del Mobile Navbar -->
    <main class="p-4 ">
        <div class="w-full bg-white p-8  ">
            <div class="text-center md:font-bold text-[2rem] md:text-[4rem] ">
                Mi Carrito
            </div>
            @if (session('success'))
            <div
                class="bg-emerald-600  w-[40%] md:px-[1rem] md:py-[0.5rem] md:text-[1.25rem]  md:uppercase font-semibold rounded text-white mb-[1.5rem]">
                <span class="md:ml-[1rem]">{{ session('success') }}</span>
            </div>
            @endif


            <div class="space-y-4">

                @if ($cartItems->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay
                    Productos</span>
                @else
                @foreach ($cartItems as $cartItem)
                <!--INICIO DE LA CARTA-->
                <div
                    class="p-4  border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50 ">
                    <div class="flex items-center">
                        <!--INFO DEL PRODCUT-->
                        <img src="{{ asset('imgs/' . $cartItem->product->imagen_referencia) }}"
                            alt="Imagen del producto"
                            class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                        <div>
                            <h2 class=" text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">
                                {{ $cartItem->product->name }}
                            </h2>
                            <p class="text-sm md:text-[1.5rem] text-gray-600 font-semibold mb-[8px]">Precio:
                                ${{ $cartItem->product->price }} c/u</p>

                            <p class="text-sm md:text-[1.5rem] text-gray-600 font-bold">Cantidad:
                                {{ $cartItem->quantity }} - Subtotal:
                                ${{ $cartItem->product->price * $cartItem->quantity }}
                            </p>
                        </div>
                    </div>
                    <!--BOTNOES-->
                    <div class="flex">
                        <form action="{{ route('usuarios.eliminarcarrito', $cartItem->fk_product) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                class="md:px-[2rem] md:py-[1rem] md:text-[1rem] px-4 py-3 text-sm font-medium text-white bg-red-500 rounded-md ml-2 hover:bg-red-600"
                                type="submit">Cancelar</button>
                    </div>
                </div>
                </form>
                @endforeach
                @endif
                <!--FIN DE LA CARTA-->
                <h2 class=" text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Total: ${{ $total }}</h2>
                <form action="{{ route('usuarios.reservar') }}" method="POST">
                    @csrf
                    @if ($cartItems->isEmpty())
                    <button
                        class="md:px-[2rem] md:py-[1rem] md:text-[1.5rem] px-4 py-3 text-sm font-medium text-white bg-gray-500 rounded-md ml-2 hover:bg-gray-600"
                        type="button">Guardar Reserva</button>
                    @elseif ($total < 5)
                        <p class="text-xl text-justify w-60">El Pedido minimo para una reserva es de <b>$5.00</b>. Usted
                        le faltan <b>${{ $restante = '5' - $total }}</b></p>

                        <button
                            class="md:px-[2rem] md:py-[1rem] md:text-[1.5rem] px-4 py-3 text-sm font-medium text-white bg-gray-500 rounded-md ml-2 hover:bg-gray-600"
                            type="button">Guardar Reserva</button>
                        @else
                        <button
                            class="md:px-[2rem] md:py-[1rem] md:text-[1.5rem] px-4 py-3 text-sm font-medium text-white bg-emerald-300 rounded-md ml-2 hover:bg-emerald-500"
                            type="submit">Guardar Reserva</button>
                        @endif
                </form>
            </div>

        </div>


    </main>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b>
                    <h2>Contact Us</h2>
                </b>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>
            </div>
            <div>
                <b>
                    <b>
                        <h2>Sobre nosotros</h2>
                    </b>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" src="{{ asset('imgs/youtube.png') }}" alt="">
                    </div>

                </div>
            </div>
        </div>
        <div class="w-full h-[2px] bg-white"></div>
    </footer>
</body>

</html>