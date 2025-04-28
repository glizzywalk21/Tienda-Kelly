
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">
    <title>Agregar Mercado Local</title>
</head>
<body>


    <section>

        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="{{ route('admin.index') }}" ><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}" ><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">

                    <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>
            <!--FIN DE NAVBAR MOBIL-->
        </div>
        <div class="w-72 mx-auto mt-16 ">




            <div class="text-center">
                <h1 class="text-3xl font-bold text-purple-600">Agregar Mercado</h1>
                <h3 class="mt- "><b>LOCAL</b></h3>
            </div>
            <form method="POST" action="{{ route('admin.guardarmercados') }}"  role="form" enctype="multipart/form-data">
                @csrf


            <div class="mt-20 space-y-4">

                <!--INICIO DE INPUT DE LA FOTO-->
                <div class="flex justify-between">
                    <label for="imagen_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative cursor-pointer">
                        <span id="file-name" class="text-gray-400 text-xs">Imagen del mercado</span>
                        <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_referencia" class="hidden" id="imagen_referencia">
                        {!! $errors->first('imagen_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <!--FIN DEL INPUT DE LA IMG-->

                <!--INICIO DE LA PREVIEW-->
                <div>
                    <p class="text-gray-400 text-xs text-center">Su foto se veria asi: </p>
                </div>
                <div class="mt-4">
                    <img id="img-preview" class="max-w max-h-xs hidden rounded-md border" src="#" alt="Vista Previa de Imagen">
                </div>

                <!---FIN DE LA PREVIEW-->



                <div class="flex justify-center">

                    <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $mercadoLocal?->nombre) }}" id="nombre" placeholder="Nombre Registrado del Mercado">
                    {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>


                <div class="flex justify-center">

                    <input required type="text" name="municipio" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('municipio') is-invalid @enderror" value="{{ old('municipio', $mercadoLocal?->municipio) }}" id="municipio" placeholder="Municipio Ubicado">
                    {!! $errors->first('municipio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">

                    <input required type="text" name="ubicacion" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion', $mercadoLocal?->ubicacion) }}" id="ubicacion" placeholder="Ubicacion Especifica del Mercado">
                    {!! $errors->first('ubicacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 px-6">Hora de Entrada</span>
                    <span class="px-6 text-xs text-gray-400">Hora de Salida</span>
                </div>
                <div class="flex justify-center">

                    <input required type="time" name="horaentrada" class=" border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('horaentrada') is-invalid @enderror" value="{{ old('horaentrada', $mercadoLocal?->horaentrada) }}" id="horaentrada" placeholder="Horaentrada">
                    {!! $errors->first('horaentrada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                    <input required type="time" name="horasalida" class=" border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('horasalida') is-invalid @enderror" value="{{ old('horasalida', $mercadoLocal?->horasalida) }}" id="horasalida" placeholder="Horasalida">
                    {!! $errors->first('horasalida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 px-6">Descripcion del Mercado</span>

                </div>
                <div class="flex justify-center">
                    <textarea maxlength="200" required name="descripcion" class="border-1 rounded border w-80 h-24 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('descripcion') is-invalid @enderror"  id="descripcion" >{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
                    {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>






            <div class="flex justify-center ">
                <button class="btn btn-primary bg-purple-500 w-72 h-10 flex items-center mt-10 mb-20 justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-opacity-50">Guardar</button>
            </div>




        </div>
    </form>

    </section>
    <script>
        document.getElementById('imagen_referencia').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');
            const fileNameSpan = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);

                // Mostrar el nombre del archivo seleccionado
                fileNameSpan.textContent = input.files[0].name;
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                fileNameSpan.textContent = 'Imagen del mercado';
            }
        });
    </script>

</body>
</html>


