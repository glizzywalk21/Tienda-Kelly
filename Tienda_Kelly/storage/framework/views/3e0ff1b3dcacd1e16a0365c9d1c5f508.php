<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title><?php echo e($product->name); ?> - Tienda Kelly</title>
    <link rel="shortcut icon" href="<?php echo e(asset('imgs/logo.png')); ?>" type="image/x-icon">
    <style>
        /* Animaciones */
        .fadeInUp {
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Botones hover */
        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }

        /* Gradiente en títulos */
        .gradient-text {
            background: linear-gradient(90deg, #6366f1, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Sombra y overlay para tarjetas recomendadas */
        .card-hover:hover img {
            transform: scale(1.05);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .shadow-inner {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white overflow-x-hidden">

    <!-- Navbar reutilizable -->
    <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Sección del Producto -->
    <section class="max-w-7xl mx-auto mt-12 px-4 md:px-0 grid grid-cols-1 md:grid-cols-2 gap-12 items-start fadeInUp">
        <!-- Imagen del producto -->
        <div class="relative">
            <img class="rounded-2xl w-full shadow-xl transform transition duration-700 hover:scale-105"
                src="<?php echo e(asset('imgs/' . $product->imagen_referencia)); ?>" alt="<?php echo e($product->name); ?>">
        </div>

        <!-- Información y carrito -->
        <div class="bg-white p-8 rounded-2xl shadow-xl fadeInUp shadow-inner">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 gradient-text"><?php echo e($product->name); ?></h1>
            <p class="text-gray-600 mb-6"><?php echo e($product->description); ?></p>

            <!-- Cantidad -->
            <div class="flex items-center gap-4 mb-6">
                <span class="font-semibold text-gray-800">Cantidad:</span>
                <div class="flex items-center gap-2">
                    <button type="button"
                        class="bg-gray-200 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700"
                        onclick="decrement()">-</button>
                    <input readonly id="quantity" type="number" name="quantity" value="1"
                        class="w-12 h-8 text-center border border-gray-400 rounded">
                    <button type="button"
                        class="bg-gray-200 rounded-full w-8 h-8 flex justify-center items-center text-lg text-gray-700"
                        onclick="increment()">+</button>
                </div>
            </div>

            <!-- Precio -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Precio</h2>
                <p class="text-2xl font-bold text-gray-900">$<?php echo e($product->price); ?></p>
            </div>

            <!-- Botón Agregar al carrito -->
            <form action="<?php echo e(route('usuarios.addcarrito', $product)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="quantity" id="quantity-form" value="1">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-bold py-3 rounded-xl shadow-lg hover:scale-105 transition transform">
                    Agregar al carrito
                </button>
            </form>
        </div>
    </section>

    <!-- Productos Recomendados -->
    <section class="max-w-7xl mx-auto mt-20 px-4 fadeInUp">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 gradient-text">Productos Recomendados</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('usuarios.producto', $product->id)); ?>"
                class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover transform transition duration-300">
                <img class="w-full h-64 object-cover rounded-t-2xl" src="<?php echo e(asset('imgs/' . $product->imagen_referencia)); ?>"
                    alt="<?php echo e($product->name); ?>">
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800"><?php echo e($product->name); ?></h3>
                    <p class="text-gray-600 mb-2"><?php echo e($product->vendedor->nombre_del_local); ?></p>
                    <p class="text-indigo-600 font-semibold">$<?php echo e($product->price); ?></p>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- Scripts para cantidad -->
    <script>
        const inputQty = document.getElementById('quantity');
        const formQty = document.getElementById('quantity-form');

        function decrement() {
            let value = parseInt(inputQty.value);
            if (value > 1) value--;
            inputQty.value = value;
            formQty.value = value;
        }

        function increment() {
            let value = parseInt(inputQty.value);
            value++;
            inputQty.value = value;
            formQty.value = value;
        }
    </script>

</body>

</html>
<?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/UserProductoEnEspecifico.blade.php ENDPATH**/ ?>