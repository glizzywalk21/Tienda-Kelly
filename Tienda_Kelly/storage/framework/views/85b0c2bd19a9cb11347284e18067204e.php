<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Mi Carrito - Tienda Kelly</title>
    <link rel="shortcut icon" href="<?php echo e(asset('imgs/logo.png')); ?>" type="image/x-icon">
    <style>
        .fadeInUp {
            animation: fadeInUp 0.8s ease forwards;
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

        .btn-hover:hover {
            transform: translateY(-3px) scale(1.05);
            transition: all 0.3s ease;
        }

        .gradient-text {
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 via-blue-50 to-white flex flex-col min-h-screen">

    <!-- Navbar -->
    <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Contenido principal -->
    <main class="flex-1 max-w-7xl mx-auto p-4 mt-10 fadeInUp">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12 gradient-text">Mi Carrito</h1>

        <?php if(session('success')): ?>
        <div class="bg-emerald-600 w-full md:w-1/2 mx-auto text-white font-semibold p-4 rounded mb-6 text-center">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if($cartItems->isEmpty()): ?>
        <div class="text-center text-gray-500 text-xl md:text-3xl mt-32">
            Tu carrito está vacío 😔
        </div>
        <?php else: ?>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Columna izquierda: productos -->
            <div class="md:col-span-2 space-y-6">
                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    class="bg-gradient-to-br from-white to-blue-50 shadow-lg rounded-3xl p-6 flex flex-col md:flex-row items-center gap-6 card-hover fadeInUp">
                    <img src="<?php echo e(asset('imgs/' . $cartItem->product->imagen_referencia)); ?>"
                        alt="<?php echo e($cartItem->product->name); ?>"
                        class="w-full md:w-44 h-44 object-cover rounded-2xl shadow-md">

                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2"><?php echo e($cartItem->product->name); ?></h2>
                        <p class="text-gray-600 text-lg mb-1">Precio: $<?php echo e($cartItem->product->price); ?> c/u</p>
                        <p class="text-gray-700 text-lg font-semibold">Cantidad: <?php echo e($cartItem->quantity); ?></p>
                        <p class="text-gray-800 font-bold mt-2">Subtotal: $<?php echo e($cartItem->product->price * $cartItem->quantity); ?></p>
                    </div>

                    <div>
                        <form action="<?php echo e(route('usuarios.eliminarcarrito', $cartItem->fk_product)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-3 rounded-2xl transition transform btn-hover">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Columna derecha: total y reserva con mini-resumen -->
            <div class="space-y-6">
                <div
                    class="bg-gradient-to-br from-white to-blue-50 shadow-2xl rounded-3xl p-6 flex flex-col items-center card-hover">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Total: $<?php echo e($total); ?></h2>

                    <!-- Mini resumen de productos -->
                    <div class="flex flex-col gap-3 w-full mb-6">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between bg-white rounded-xl p-2 shadow">
                            <img src="<?php echo e(asset('imgs/' . $cartItem->product->imagen_referencia)); ?>"
                                alt="<?php echo e($cartItem->product->name); ?>"
                                class="w-12 h-12 object-cover rounded-md">
                            <div class="flex-1 mx-2">
                                <p class="text-gray-800 font-semibold text-sm"><?php echo e($cartItem->product->name); ?></p>
                                <p class="text-gray-600 text-xs">x<?php echo e($cartItem->quantity); ?></p>
                            </div>
                            <p class="text-gray-800 font-bold text-sm">$<?php echo e($cartItem->product->price * $cartItem->quantity); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Botón de reserva -->
                    <form action="<?php echo e(route('usuarios.reservar')); ?>" method="POST" class="w-full text-center">
                        <?php echo csrf_field(); ?>
                        <?php if($cartItems->isEmpty() || $total < 5): ?>
                        <button type="button"
                            class="bg-gray-400 text-white font-semibold px-8 py-3 rounded-2xl cursor-not-allowed">
                            Guardar Reserva
                        </button>
                        <?php if($total < 5): ?>
                        <p class="mt-4 text-gray-600 text-center">
                            Pedido mínimo $5. Faltan $<?php echo e(5 - $total); ?> para reservar.
                        </p>
                        <?php endif; ?>
                        <?php else: ?>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-semibold px-8 py-3 rounded-2xl transition transform btn-hover">
                            Guardar Reserva
                        </button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="mt-auto">
        <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </footer>

</body>


</html>
<?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/UserCarritoGeneral.blade.php ENDPATH**/ ?>