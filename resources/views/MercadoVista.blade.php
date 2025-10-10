<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/shop.png') }}" type="image/x-icon">
    <title>Document</title>
</head>

<body>
    <section>
        <div class="mt-4 ml-3">
            <div class="flex">
                <div>
                    <h3 class="text-3xl font-bold">Tienda</h3>
                </div>
                <div>
                    <img class="w-6 mt-2 ml-3" src="{{ asset('imgs/shop.png') }}" alt="User Icon">
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
                <img class="w-[80%] h-40 overflow-hidden object-cover" src="{{ asset('imgs/img.png') }}"
                    alt="User Icon">
            </div>

            <div class="mt-5">
                <div class="text-center font-bold">
                    Descripcion;
                </div>
                <div class="w-[80%] text-justify mx-auto text-sm mt-5">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo velit, natus accusantium, magnam
                    ad doloribus
                </div>
            </div>

            <div class="mt-36 flex justify-center">
                <button class="bg-red-400 w-[70%] rounded-xl h-10 text-white">Editar</button>
            </div>
        </div>


        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="{{ route('usuarios.index') }}"><img class="w-6"
                            src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('usuarios.carrito') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6"
                            src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('usuarios.reservas') }}"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}"
                            alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./UserEditarPerfil"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}"
                            alt="User Icon"></a>
                </div>
            </div>



        </div>
        </div>
    </section>
</body>

</html>