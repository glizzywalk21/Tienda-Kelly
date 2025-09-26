<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos</title>
        <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>
<body>
    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Reservas</h1>

            <div class="space-y-4">
              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">Reserva #1</h2>
                    <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                  </div>
                </div>
                <span class="px-3 w-fit py-1 text-sm font-semibold bg-green-200 text-green-800 rounded-full">Listo para entregar</span>
              </div>

              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">Reserva #2</h2>
                    <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                  </div>
                </div>
                <span class="px-3 w-fit py-1 text-sm font-semibold bg-gray-200 text-gray-800 rounded-full">Entregado</span>
              </div>

              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">Reserva #</h2>
                    <p class="text-sm text-gray-600">Fecha: 23 de Mayo, 2024</p>
                  </div>
                </div>
                <span class="px-3 w-fit py-1 text-sm font-semibold bg-yellow-200 text-yellow-800 rounded-full">En Proceso</span>
              </div>
            </div>
          </div>

    </main>
    <div class="mx-auto max-w-lg mt-16 mb-[15%] "> <!-- Añadido un margen inferior -->
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
                    <a href="{{ route('admin.clientes') }}" ><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./AdminEstadoPedidos" ><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
<?php $id = 1; ?>
                    <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>

                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        </div>





    </div>

</body>
</html>
