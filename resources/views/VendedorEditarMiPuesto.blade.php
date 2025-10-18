<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
    <title>Document</title>
</head>

<body class="flex flex-col h-screen">
    <section class="flex-1 overflow-y-auto mb-20">
        <div class="mt-10 ml-3">
            <div class="flex">
                <div>
                    <h3 class="text-3xl font-bold">Tienda</h3>
                </div>
                <div>
                    <img class="w-6 mt-2 ml-3" src="{{ asset('images/shop.png') }}" alt="User Icon">
                </div>
            </div>
            <div class="w-[30%]">
                <h3 class="font-bold text-xl text-end">Kelly</h3>
            </div>
        </div>

        <div class="mt-5">
            <div>
                <h3 class="text-center font-bold text-lg">Nombre del mercado</h3>
            </div>
            <div class="flex justify-center mt-14">
                <img class="w-[60%] h-40 overflow-hidden object-cover rounded-2xl" src="{{ asset('images/img.png') }}" alt="User Icon">
            </div>

            <div class="mt-5">
                <div class="text-center font-bold">
                    Descripcion
                    <h3 class="w-[80%] text-xs text-justify mx-auto">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate hic illum mollitia quos a assumenda dolor perspiciatis consequuntur voluptatibus nostrum, quaerat non sit? Labore nulla itaque</h3>
                </div>

                <div class="bg-neutral-700 w-[75%] max-w-sm mx-auto mt-5 p-4 text-center rounded-md">
                    <div class="text-white">
                        Cambiar clasificacion
                    </div>
                    <ul class="text-white list-none">
                        <li class="my-2">Comida</li>
                        <li class="my-2">Comida</li>
                        <li class="my-2">Comida</li>
                    </ul>
                    <div>
                        <button class="text-black bg-white rounded-md w-[90%] px-4 py-2">Confirmar</button>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-center">
                <button class="bg-gray-900 w-[70%] rounded-xl h-10 text-white">Editar</button>
            </div>
        </div>
    </section>

    <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center  ">
                <a href="./VendedorHome" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('images/HomeSelectedIcon.png') }}" alt="User Icon"></a>
            </div>

            <div class="flex items-center">
                <a href="./VendedorMiBuzon"><img class="w-6" src="{{ asset('images/BuzonIcon.png') }}" alt="User Icon"></a>
            </div>

            <div class="flex items-center">
                <a href="./VendedorMisReservas"><img class="w-6" src="{{ asset('images/ReservasIcon.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">
                <a href="./VendedorProfileVista"><img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="User Icon"></a>
            </div>
        </div>

        <!--FIN DE NAVBAR MOBIL-->
    </div>
    </div>
</body>

</html>
