<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Editar Usuario</title>
    <link rel="shortcut icon" href="<?php echo e(asset('imgs/MiCarritoUser.png')); ?>" type="image/x-icon">
    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp { animation: fadeInUp 1s ease forwards; }
        .gradient-text { background: linear-gradient(90deg, #6366f1, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-hover:hover { transform: translateY(-2px) scale(1.02); transition: all 0.3s ease; }
    </style>
</head>

<body class="bg-gray-50">

    <section class="flex justify-center mt-10 mb-16">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl p-8 animate-fadeInUp">

            <!-- Encabezado -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold gradient-text">EDITAR USUARIO</h1>
                <p class="text-gray-600 mt-2 text-sm font-medium"><?php echo e(old('nombre', $cliente?->nombre)); ?></p>
            </div>

            <!-- Formulario -->
            <form method="POST" action="<?php echo e(route('usuarios.actualizar', ['id' => $cliente->id])); ?>" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($cliente->id); ?>">

                <?php if($errors->any()): ?>
                    <div class="bg-orange-500 text-white p-2 rounded text-sm text-center">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Imagen de perfil -->
                <div class="flex justify-center mb-6">
                    <label class="relative w-32 h-32 rounded-full overflow-hidden shadow-lg border-2 border-gray-300 flex items-center justify-center bg-gray-100 cursor-pointer">
                        <img id="img-preview" src="<?php echo e(asset('storage/imgs/' . ($cliente?->imagen_perfil ?? 'non-img.png'))); ?>" alt="Imagen Usuario" class="object-cover w-full h-full rounded-full">
                        <span class="absolute bottom-0 right-0 w-8 h-8 bg-indigo-600 rounded-full flex justify-center items-center">
                            <img class="w-4" src="<?php echo e(asset('imgs/files2.svg')); ?>" alt="Icono Subir">
                        </span>
                        <!-- input invisible pero clickeable -->
                        <input type="file" name="imagen_perfil" id="imagen_perfil" accept=".png,.jpg,.jpeg" class="absolute w-full h-full top-0 left-0 opacity-0 cursor-pointer">
                    </label>
                </div>

                <!-- Primera fila: Nombre y Apellido -->
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="nombre" placeholder="Nombre" value="<?php echo e(old('nombre', $cliente?->nombre)); ?>"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <input type="text" name="apellido" placeholder="Apellido" value="<?php echo e(old('apellido', $cliente?->apellido)); ?>"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Segunda fila: Correo y Teléfono -->
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="email" name="usuario" placeholder="Correo electrónico" value="<?php echo e(old('usuario', $cliente?->usuario)); ?>"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo e(old('telefono', $cliente?->telefono)); ?>"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Tercera fila: Contraseña y Confirmación -->
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="password" name="password" placeholder="Contraseña" value="<?php echo e(old('password')); ?>" maxlength="8"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" value="<?php echo e(old('password_confirmation')); ?>" maxlength="8"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <!-- Mostrar contraseñas -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="show-passwords" class="mr-2">
                    <label for="show-passwords" class="text-sm text-gray-600">Mostrar contraseñas</label>
                </div>

                <!-- Selección de sexo -->
                <div class="flex justify-center">
                    <select name="sexo" class="w-full md:w-1/2 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="" disabled <?php echo e(old('sexo', $cliente?->sexo) ? '' : 'selected'); ?>>Seleccione el sexo</option>
                        <option value="Masculino" <?php echo e(old('sexo', $cliente?->sexo) == 'Masculino' ? 'selected' : ''); ?>>Masculino</option>
                        <option value="Femenino" <?php echo e(old('sexo', $cliente?->sexo) == 'Femenino' ? 'selected' : ''); ?>>Femenino</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex flex-col gap-4 mt-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow btn-hover">Actualizar Usuario</button>
                    <a href="<?php echo e(route('usuarios.index')); ?>" class="text-center bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-lg shadow btn-hover">Cancelar</a>
                </div>
            </form>
        </div>
    </section>

    <!-- Scripts -->
    <script>
        // Preview de imagen
        document.getElementById('imagen_perfil').addEventListener('change', function (e) {
            const preview = document.getElementById('img-preview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Mostrar/ocultar contraseñas
        document.getElementById('show-passwords').addEventListener('change', function () {
            const passwords = document.querySelectorAll('input[type="password"]');
            passwords.forEach(p => p.type = this.checked ? 'text' : 'password');
        });
    </script>

</body>
</html>
<?php /**PATH C:\Users\Amilcar\OneDrive\Documentos\GitHub\Tienda-Kelly\Tienda_Kelly\resources\views/UserEditarPerfil.blade.php ENDPATH**/ ?>