<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .header h1 {
            margin: 10px 0;
        }

        .details,
        .items {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .market-table,
        .vendor-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .market-table th,
        .vendor-table th,
        .market-table td,
        .vendor-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .market-table th,
        .vendor-table th {
            background-color: #f4f4f4;
        }

        .market-table tfoot tr,
        .vendor-table tfoot tr {
            font-weight: bold;
        }

        .market-section {
            margin-bottom: 20px;
        }

        .market-section h2 {
            margin: 10px 0;
        }

        .vendor-section {
            margin-bottom: 20px;
        }

        .vendor-section h3 {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado con el logo del proyecto -->
        <div class="header">
            <h1 class="text-3xl md:text-4xl lg:text- font-bold">
                Tienda <span class="text-violet-600 font-bold">Kelly</span>
            </h1>
            <h1>Recibo de Compra</h1>
        </div>

        <!-- Detalles de la transacción -->
        <div class="details">
            <p><strong>Nombre del Comprador:</strong> <?php echo e($reservation->user->nombre); ?></p>
            <p><strong>Apellido del Comprador:</strong> <?php echo e($reservation->user->apellidos); ?></p>
            <p><strong>Usuario del Comprador:</strong> <?php echo e($reservation->user->usuario); ?></p>
        </div>

        <!-- Sección de mercados y productos -->
        <?php if($mercados->isEmpty()): ?>
        <p>No hay mercados disponibles.</p>
        <?php else: ?>
        <?php $__currentLoopData = $mercados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mercado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="market-section">
            <h2>Mercado Local: <?php echo e($mercado->nombre); ?></h2>
            <p><strong>Ubicación del Mercado Local:</strong> <?php echo e($mercado->ubicacion); ?></p>

            <?php
            // Obtener vendedores únicos para el mercado
            $vendedores = $reservation->items->filter(function($item) use ($mercado) {
            return $item->product->vendedor->mercadoLocal->id === $mercado->id;
            })->map(function($item) {
            return $item->product->vendedor;
            })->unique('id');
            ?>

            <?php $__currentLoopData = $vendedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="vendor-section">
                <h3>Vendedor: <?php echo e($vendedor->nombre); ?> <?php echo e($vendedor->apellidos); ?></h3>
                <h2>Ubicadon en: #<?php echo e($vendedor->numero_puesto); ?> en el <?php echo e($vendedor->mercadoLocal->nombre); ?> en <?php echo e($vendedor->mercadoLocal->ubicacion); ?></h2>
                <table class="vendor-table">
                    <thead>
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalVendedor = 0;
                        ?>
                        <?php $__currentLoopData = $reservation->items->where('product.vendedor.id', $vendedor->id)->where('product.vendedor.mercadoLocal.id', $mercado->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->product->name); ?></td>
                            <td>$<?php echo e(number_format($item->precio, 2)); ?></td>
                            <td><?php echo e($item->quantity); ?></td>
                            <td>$<?php echo e(number_format($item->subtotal, 2)); ?></td>
                        </tr>
                        <?php
                        $totalVendedor += $item->subtotal;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Total Vendedor:</td>
                            <td>$<?php echo e(number_format($totalVendedor, 2)); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!-- Total general de la compra -->
        <div class="items">
            <table class="market-table">
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;">Total General:</td>
                        <td>$<?php echo e(number_format($reservation->total, 2)); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/receipt.blade.php ENDPATH**/ ?>