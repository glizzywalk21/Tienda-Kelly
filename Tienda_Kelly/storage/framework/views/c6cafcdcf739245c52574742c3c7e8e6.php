<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title><?php echo e($vendedor->nombre_del_local); ?> - Tienda Kelly</title>
    <link rel="shortcut icon" href="<?php echo e(asset('imgs/logo.png')); ?>" type="image/x-icon">
    <style>
        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }

        .animate-fadeInUp {
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white overflow-x-hidden">

    <!-- Navbar -->
    <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Perfil del Vendedor -->
    <section class="max-w-7xl mx-auto mt-10 px-4 md:px-0 text-center animate-fadeInUp">
        <img class="w-40 h-40 md:w-60 md:h-60 rounded-full mx-auto object-cover shadow-lg"
             src="<?php echo e(asset('imgs/' . $vendedor->imagen_de_referencia)); ?>" alt="<?php echo e($vendedor->nombre_del_local); ?>">
        <h1 class="text-3xl md:text-5xl font-extrabold mt-4"><?php echo e($vendedor->nombre_del_local); ?></h1>
        <p class="text-gray-600 mt-1 md:text-lg">
            Puesto #<?php echo e($vendedor->numero_puesto); ?> - <span class="font-semibold"><?php echo e($mercadoLocal->nombre); ?></span>
        </p>
    </section>

    <!-- Productos -->
    <section class="max-w-7xl mx-auto mt-12 px-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('usuarios.producto', $product->id)); ?>"
           class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 btn-hover group transition">
            <div class="relative overflow-hidden">
                <img class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                     src="<?php echo e(asset('imgs/' . $product->imagen_referencia)); ?>"
                     alt="<?php echo e($product->name); ?>">
            </div>
            <div class="p-4 space-y-2">
                <h2 class="font-bold text-xl uppercase"><?php echo e($product->name); ?></h2>
                <p class="text-gray-600 text-sm"><?php echo e($product->description); ?></p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-indigo-600 font-bold text-lg">$<?php echo e($product->price); ?></span>
                    <div class="flex items-center gap-1">
                        <span class="font-semibold">4.2</span>
                        <img class="w-4" src="<?php echo e(asset('imgs/estrella.png')); ?>" alt="Estrella">
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>

    <!-- Paginación -->
    <div class="max-w-7xl mx-auto my-10 flex justify-center gap-3">
        <?php echo e($products->links()); ?>

    </div>

    <!-- Footer -->
    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/UserProductosDeUnPuesto.blade.php ENDPATH**/ ?>