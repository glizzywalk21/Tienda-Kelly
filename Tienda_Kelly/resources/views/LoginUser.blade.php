<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    @vite('resources/css/app.css')
    <title>Inicia Sesion con Nosotros</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
</head>

<body>
    <div class="md:flex h-screen">
        <div class="pt-7 md:bg-[#BDD7FF] md:w-[50%] md:flex md:flex-col md:justify-center">
            <div class="login pl-5">
                <div class="flex items-center">
                    <div class="md:hidden">
                        <h1 class="font-bold">Iniciar Sesión ADIOS</h1>
                    </div>
                    <div class="hidden">
                        <img class="md:w-[75%] mx-auto" src="{{ asset('imgs/imagenindex.png') }}" alt="Login Image">
                    </div>
                </div>
                <div class="md:hidden">
                    <h3 class="text-xs font-bold">¡Bienvenidos a Tienda Kelly!</h3>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="w-72 h-96 mt-10 mx-auto">
                    <div class="text-center">
                        <h1 class="text-6xl font-bold">Tienda<span class="text-[#3679F5] ml-3 font-bold">Kelly</span></h1>
                    </div>
                    <div class="flex flex-col mt-5">
                        <div class="flex justify-center pt-5">
                            <input class="border rounded w-80 md:h-12 h-9 pl-5 md:text-[1rem] text-sm border-gray-400 bg-transparent" type="email" name="usuario" id="usuario" placeholder="Ingrese su correo electrónico">
                        </div>
                        @if($errors->has('usuario'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('usuario') }}</div>
                        @endif
                        <div class="flex justify-center mt-2">
                            <input class="border rounded w-80 md:h-12 h-9 pl-5 md:text-[1rem] text-sm border-gray-400 bg-transparent" type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                        </div>


                        @if($errors->has('password'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="flex items-center justify-center mt-2">
                            <input
                                class="checked:appearance-auto appearance-none h-5 w-5 border border-gray-500 rounded-sm checked:border-gray-700 focus:outline-none"
                                type="checkbox"
                                id="show-passwords"
                                maxlength="8">
                            <span class="ml-2 pt-1 md:text-[1rem] text-sm text-gray-500">Mostrar Contraseña</span>
                        </div>
                    </div>
                    <div class="flex justify-center mt-5">
                        <button type="submit" class="w-72 h-12 font-bold btn overflow-hidden relative bg-[#96A6E8] text-black py-2 px-4 rounded-xl">Iniciar Sesión</button>
                    </div>
                </div>
            </form>

            <div class="hidden md:flex items-center mt-1">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="px-4 text-xs">O</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>
            <div class="mt-10">
                <h3 class="text-center text-sm">¿Aún no se ha registrado? <a href="{{ route('RegistroUser') }}" class="text-blue-950 font-bold">Crear Cuenta</a></h3>
            </div>
        </div>

        <div class="hidden md:flex md:flex-col md:items-center md:justify-center md:w-[50%]">
            <div class="text-center mb-4">
                <h3 class="font-bold text-3xl">Inicia Sesion</h3>
            </div>
            <div class="flex justify-center">
                <img class="md:w-[75%] mx-auto" src="{{ asset('imgs/imagenindex.png') }}" alt="Login Image">
            </div>
            <div>
                <h3 class="font-bold text-xl">Bienvenido de Regreso</h3>
                <h3 class="font-bold text-center text-xl">Tienda Kelly!</h3>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('show-passwords').addEventListener('change', function() {
        const passwords = document.querySelectorAll('#password, #password_confirmation');
        passwords.forEach(password => {
            password.type = this.checked ? 'text' : 'password';
        });
    });
</script>

</html>