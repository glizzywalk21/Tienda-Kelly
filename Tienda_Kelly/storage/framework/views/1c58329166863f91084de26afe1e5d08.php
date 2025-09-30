<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title><?php echo e($mercadoLocal->nombre); ?> - Tienda Kelly</title>
    <link rel="shortcut icon" href="<?php echo e(asset('imgs/MiCarritoUser.png')); ?>" type="image/x-icon">
    <style>
        /* Gradiente de texto y animaciones */
        .gradient-text {
            background: linear-gradient(90deg, #6366f1, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .btn-hover:hover {
            transform: translateY(-5px) scale(1.05);
            transition: all 0.3s ease;
        }

        .badge-popular {
            background: linear-gradient(90deg, #facc15, #f97316);
            color: white;
            font-weight: bold;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            position: absolute;
            top: 0.5rem;
            left: 0.5rem;
            z-index: 10;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white overflow-x-hidden">

    <!-- Navbar reutilizable -->
    <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Hero Banner Mercado -->
    <section class="relative w-full h-[350px] md:h-[500px] lg:h-[600px] overflow-hidden rounded-b-3xl shadow-xl mt-6">
        <img class="w-full h-full object-cover object-center transform hover:scale-105 transition duration-700"
             src="<?php echo e(asset('imgs/' . $mercadoLocal->imagen_referencia)); ?>"
             alt="<?php echo e($mercadoLocal->nombre); ?>">
        
        <!-- Overlay gradiente para contraste con texto -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/25 via-black/10 to-black/40"></div>

        <!-- Texto sobre el banner -->
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 md:px-0">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white drop-shadow-lg">
                <?php echo e($mercadoLocal->nombre); ?>

            </h1>
            <p class="mt-4 text-white/90 text-sm sm:text-base md:text-lg max-w-2xl drop-shadow-md">
                <?php echo e($mercadoLocal->descripcion); ?>

            </p>
        </div>
    </section>

    <!-- Cartas de Vendedores -->
    <section class="max-w-7xl mx-auto mt-14 px-4 grid sm:grid-cols-2 md:grid-cols-3 gap-8 animate-fadeInUp">
        <?php $__currentLoopData = $vendedors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('usuarios.vendedor', $vendedor->id)); ?>"
           class="relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2 btn-hover group">
           
            <!-- Badge Popular (ejemplo) -->
            <?php if($vendedor->popular ?? false): ?>
            <span class="badge-popular">Popular</span>
            <?php endif; ?>

            <div class="relative overflow-hidden">
                <img class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500"
                     src="<?php echo e(asset('imgs/' . $vendedor->imagen_de_referencia)); ?>"
                     alt="<?php echo e($vendedor->nombre_del_local); ?>">
            </div>

            <div class="p-5 space-y-2">
                <h3 class="font-bold text-xl"><?php echo e($vendedor->nombre_del_local); ?></h3>
                <p class="text-gray-600">Tienda de <?php echo e($vendedor->nombre); ?> <?php echo e($vendedor->apellidos); ?></p>
                <div class="flex justify-between items-center mt-2">
                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full font-semibold text-sm">
                        <?php echo e($vendedor->clasificacion); ?>

                    </span>
                    <div class="flex items-center gap-1">
                        <span class="font-semibold">4.2</span>
                        <img class="w-4" src="<?php echo e(asset('imgs/estrella.png')); ?>" alt="Estrella">
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>

    <!-- Paginación opcional -->
    <div class="max-w-7xl mx-auto my-10 flex justify-center gap-3">
        <?php echo e($vendedors->links()); ?>

    </div>

    <!-- Footer reutilizable -->
    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/UserPuestosVendedores.blade.php ENDPATH**/ ?>