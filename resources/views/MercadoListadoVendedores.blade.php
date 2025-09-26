<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>EditarPuesto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
    <div class="hidden md:flex p-4 items-center justify-between shadow-md">
        <a href="{{ route('mercados.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text- font-bold">
                Tienda Kelly: <span class="text-red-500 font-bold">Mercado</span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('mercados.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Hogar</a>
            <a href="{{ route('mercados.listavendedores') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Vendedores</a>
            <a href="{{ route('mercados.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Reservas</a>
            <a href="{{ route('mercados.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300  px-2 py-1">Historial</a>
            <a href="{{ route('mercados.perfil') }}"
                class="font-semibold uppercase text-sm lg:text-base  hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('mercados.index') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.home.nav.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.listavendedores') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.vendedores.nav.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.reservas') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.reservas.nav.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.historial') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.historial.nav.png') }}"
                        alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('mercados.perfil') }}">
                    <img class="w-6" src="{{ asset('imgs/mercado.perfil.nav.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>





    <main class="p-4">
        <!-- Desktop Navbar -->



        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-[3rem] font-bold mb-6 text-gray-800 text-center">Lista de Vendedores</h1>
            <a href="{{ route('mercados.agregarvendedor') }}"
                class="object-center items-center relative ml-[40%] mr-[40%] mb-[6rem] md:px-[2rem] md:py-[1rem] md:text-[1.5rem] px-4 py-3 text-sm font-medium text-white bg-red-500 rounded-md  hover:bg-red-600">Agregar
                Vendedor</a>


            <div class="space-y-4 mt-[2.5rem]">
                <!--INICIO DE TARJETA-->
                @foreach ($vendedores as $vendedor)
                <div
                    class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/' . $vendedor->imagen_de_referencia) }}" alt="t"
                            class="w-40 h-40 rounded-md mr-4 object-cover">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                <p>#{{ $vendedor->numero_puesto }} {{ $vendedor->nombre }}
                                    {{ $vendedor->apellidos }}
                            </h2>
                            en el <b>{{ $vendedor->mercadoLocal->nombre }}</b></p>
                            <h2 class="text-sm text-gray-600"><b>Numero de Telefono:</b> {{ $vendedor->telefono }}
                            </h2>
                            <p class="text-sm text-gray-600"><b>Correo Electronico : </b>{{ $vendedor->usuario }}
                            </p>
                        </div>
                    </div>
                    <div class="flex">
                        <form action="{{ route('mercados.eliminarvendedor', $vendedor->id) }}" method="POST">

                            <a class="btn btn-sm btn-primary px-3 py-2 text-sm font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600 "
                                href="{{ route('mercados.vervendedor', $vendedor->id) }}"><i
                                    class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>

                            <a class="btn btn-sm btn-success px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600"
                                href="{{ route('mercados.editarvendedor', $vendedor->id) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-md ml-2 hover:bg-red-600"><i
                                    class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                        </form>
                    </div>
                </div>
                @endforeach
                <!--FIN DE TARJETA-->
            </div>
        </div>

    </main>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white p-12">
            <div class="hidden md:block">
                <h2 class="font-bold">Contact Us</h2>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>
            </div>
            <div class="hidden md:block">
                <h2 class="font-bold">Sobre nosotros</h2>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-red-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
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

</body>

</html>