<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Inicio</title>
    <link rel="shortcut icon" href="<?php echo e(asset('imgs/logo.png')); ?>" type="image/x-icon">
</head>

<body>

    <!-- Desktop Navbar -->

    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="<?php echo e(route('admin.index')); ?>">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                Tienda <span class="text-purple-600"><b>Admin</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="<?php echo e(route('admin.index')); ?>"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mercados</a>
            <a href="<?php echo e(route('admin.vendedores')); ?>"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Vendedores</a>
            <a href="<?php echo e(route('admin.clientes')); ?>"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Clientes</a>
            <a href="<?php echo e(route('AdminProfileVista')); ?>"
                class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                Perfil
            </a>
        </div>
    </div>


    <div class="mx-auto  mt-10 mb-32 "> <!-- Añadido un margen inferior -->




        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="<?php echo e(route('admin.index')); ?>"><img class="w-6" src="<?php echo e(asset('imgs/admin.home.nav.png')); ?>" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="<?php echo e(route('admin.vendedores')); ?>"><img class="w-6" src="<?php echo e(asset('imgs/admin.sellers.nav.png')); ?>" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="<?php echo e(route('admin.clientes')); ?>"><img class="w-6" src="<?php echo e(asset('imgs/admin.users.nav.png')); ?>" alt="User Icon"></a>
                </div>
                <div class="flex items-center">

                    <a href="<?php echo e(route('AdminProfileVista')); ?>"><img class="w-6" src="<?php echo e(asset('imgs/UserIcon.png')); ?>" alt="User Icon"></a>
                </div>
            </div>
            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="flex justify-between mt-5">
                <div class="ml-[2%]">
                    <h1>Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-blue-800 font-bold">Administrador General</h3>
                </div>
                <div class="mr-[5%] mt-4">
                    <img class= "rounded-full w-12" src="<?php echo e(asset('imgs/MiCarritoUser.png')); ?>" alt="User Icon">
                </div>
            </div>
            <?php if(session('usuario') && session('password')): ?>
            <div class="bg-green-500 text-white text-center py-4 px-6 rounded-md mb-6 mx-4">
                <strong>¡Nueva area creada llamado "<?php echo e(session('nombre')); ?>"!</strong><br>
                Las credenciales del mercado son las siguientes:<br>
                <span><strong>Usuario:</strong> <?php echo e(session('usuario')); ?></span><br>
                <span><strong>Contraseña:</strong> <?php echo e(session('password')); ?></span>
                <p>Son Unicas asi que no se le olvide!</p>
            </div>
            <?php endif; ?>


            <!--<div class="mt-5">
                <img class="w-[100%]" src="<?php echo e(asset('imgs/Portada.png')); ?>" alt="User Icon">
            </div>-->
            <div class="w-screen hidden md:block">
                <img class="w-full h-[35rem] object-cover" src="<?php echo e(asset('imgs/index.jpg')); ?>" alt="Banner Image">
            </div>

            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <a href="<?php echo e(route('admin.crearmercados')); ?>" class="btn btn-primary btn-sm float-right" data-placement="left">

                    <span class="flex items-center px-3 py-2  rounded-md">
                        <img class="w-7 mr-2" src="<?php echo e(asset('imgs/AddIcon.png')); ?>" alt="User Icon">
                        Agregar Mercado
                    </span>
                </a>



            </div>



            <div class="flex justify-center mt-5 flex-col items-center">

                <?php $__currentLoopData = $mercadoLocals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mercadoLocal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--INICIO DE PLANTILLA-->
                <a href="<?php echo e(route('admin.vermercados',$mercadoLocal->id)); ?>" class="md:w-[30%] w-[80%] rounded-md  border-gray-200 mb-4 ">
                    <div>
                        <img class="w-[100%] rounded-t-lg" src="<?php echo e(asset('imgs/'.$mercadoLocal->imagen_referencia)); ?>" alt="<?php echo e($mercadoLocal->imagen_referencia); ?>">
                        <div class="text-center mt-2">
                            <h1 class="text-sm font-bold"><?php echo e($mercadoLocal->nombre); ?></h1>
                            <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">El <?php echo e($mercadoLocal->nombre); ?> se encuentra en <?php echo e($mercadoLocal->ubicacion); ?>, en el municipio de <?php echo e($mercadoLocal->municipio); ?>. En el horario siguiente: <?php echo e($mercadoLocal->horaentrada); ?> - <?php echo e($mercadoLocal->horasalida); ?>. <?php echo e($mercadoLocal->descripcion); ?></h3>
                        </div>
                    </div>
                    <div class=" flex justify-between space-x-4 p-4 ">
                        <!--EDITAR-->
                        <a class=" text-white text-xs px-3 py-2 rounded z-[2] btn btn-sm btn-success bg-purple-400 " href="<?php echo e(route('admin.editarmercados',$mercadoLocal->id)); ?>">Editar</a>

                        <!--ELIMINAR-->
                        <form action="<?php echo e(route('admin.eliminarmercados',$mercadoLocal->id)); ?>" method="POST" class="relative">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class=" bg-red-500 text-white text-xs px-3 py-2 rounded btn btn-danger btn-sm z-[3] "><i class="fa fa-fw fa-trash"></i> <?php echo e(__('Eliminar')); ?></button>
                        </form>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!--FIN DE PLANTILLA -->
            </div>
        </div>
    </div>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b><b>
                        <h2>Contact Us</h2>
                    </b></b>

                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@TiendaKelly.sv</p>
                <p>Dirección: San Rafael cedros, cuscatlan</p>

            </div>
            <div>
                <b>
                    <h2>Sobre nosotros</h2>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="<?php echo e(asset('imgs/facebook.png')); ?>"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="<?php echo e(asset('imgs/google.png')); ?>" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="<?php echo e(asset('imgs/linkedin.png')); ?>"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="<?php echo e(asset('imgs/twitter.png')); ?>"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" src="<?php echo e(asset('imgs/youtube.png')); ?>" alt="">
                    </div>

                </div>
            </div>
        </div>

    </footer>
</body>

</html><?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/AdminHome.blade.php ENDPATH**/ ?>