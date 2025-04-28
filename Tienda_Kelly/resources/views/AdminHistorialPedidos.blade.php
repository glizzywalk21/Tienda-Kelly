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

    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="{{ route('admin.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./AdminEstadoPedidos"><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <?php $id = 1; ?>
                    <a href="{{ route('AdminProfileVista')}}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>

                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <div class="ml-2">
            <div class="flex">
                <div class="font-bold text-4xl">
                    Tienda
                </div>
                <div>
                    <img class="w-6 ml-3 mt-3" src="{{ asset('imgs/shop.png') }}" alt="User Icon">
                </div>
            </div>
            <div class="font-bold text-xl  text-end w-[34%]">
                Kelly
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-center text-xl"><b>Listado de vendedores</b></h2>
        </div>

        <div>
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">

            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">
            <div class="mt-[10%] mx-auto ml-12 flex ">
                <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                <div class="ml-2 ">
                    <h3 class="text-sm font-bold">Puesto de Fran</h3>
                    <h3 class="text-xs ">Descripcion del vendedor</h3>
                    <h3 class="text-sm font-bold">Date:24/04/2024</h3>
                </div>

            </div>

            <hr class="w-[90%] mx-auto mt-5">





        </div>
    </div>

</body>

</html>