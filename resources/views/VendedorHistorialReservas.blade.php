<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Estado de Pedidos · Historial</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon" />
    <style>
        .fadeInUp {
            animation: fadeInUp .5s ease forwards;
            opacity: 0
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(10px)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Desktop Navbar -->
    <header class="hidden md:flex px-6 lg:px-10 py-4 bg-white items-center justify-between shadow-sm sticky top-0 z-40">
        <a href="{{ route('vendedores.index') }}" class="group">
            <h1 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                Tienda Kelly <span class="text-indigo-600 group-hover:text-indigo-700 transition">Vendedores</span>
            </h1>
        </a>
        <nav class="flex gap-6">
            <a href="{{ route('vendedores.index') }}" class="text-sm font-medium hover:text-indigo-600">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}" class="text-sm font-medium hover:text-indigo-600">Mis
                Productos</a>
            <a href="{{ route('vendedores.reservas') }}" class="text-sm font-medium hover:text-indigo-600">Mis
                Reservas</a>
            <a href="{{ route('vendedores.historial') }}" class="text-sm font-semibold text-indigo-600">Mi Historial</a>
            <a href="{{ route('vendedor.perfil') }}"
                class="text-sm font-semibold border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">Perfil</a>
        </nav>
    </header>

    <!-- Mobile Bottom Bar -->
    <div class="fixed bottom-3 left-0 right-0 md:hidden flex justify-center z-40">
        <div class="bg-gray-900 rounded-2xl w-72 h-14 flex justify-around items-center px-4 shadow-lg">
            <a href="{{ route('vendedores.index') }}"><img class="w-6" src="{{ asset('images/vendedor.home.png') }}"
                    alt=""></a>
            <a href="{{ route('vendedores.productos') }}"><img class="w-6"
                    src="{{ asset('images/vendedor.productos.png') }}" alt=""></a>
            <a href="{{ route('vendedores.reservas') }}"><img class="w-6"
                    src="{{ asset('images/vendedor.reservas.png') }}" alt=""></a>
            <a href="{{ route('vendedores.historial') }}"><img class="w-6"
                    src="{{ asset('images/mercado.historial.blancopng.png') }}" alt=""></a>
            <a href="{{ route('vendedor.perfil') }}"><img class="w-6" src="{{ asset('images/vendedor.perfil.png') }}"
                    alt=""></a>
        </div>
    </div>

    <!-- Hero / Encabezado del vendedor -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-500 opacity-90"></div>
        <svg class="absolute -bottom-10 -right-10 w-72 h-72 opacity-20 text-white" viewBox="0 0 200 200"
            fill="currentColor">
            <path
                d="M62.9,-38.3C72.7,-21.6,66.5,4.2,53.3,24.2C40.1,44.2,20.1,58.5,-1.4,59.5C-23,60.4,-45.9,48.1,-56.8,28C-67.7,8,-66.5,-19.9,-53.2,-37.8C-39.9,-55.7,-14.6,-63.7,8.2,-60.9C31.1,-58.1,51.6,-44.9,62.9,-38.3Z" />
        </svg>

        <div class="relative max-w-6xl mx-auto px-6 lg:px-8 py-10 lg:py-14 text-white">
            <div class="flex items-start gap-5">
                <img class="hidden md:block w-20 h-20 lg:w-24 lg:h-24 rounded-full ring-4 ring-white/20 object-cover"
                    src="{{ asset('images/' . $vendedor->imagen_de_referencia) }}" alt="Vendedor">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-extrabold leading-tight">
                        {{ $vendedor->nombre_del_local }}
                    </h2>
                    <p class="mt-1 text-white/90">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</p>
                </div>
            </div>

            <h3 class="mt-6 lg:mt-8 text-3xl lg:text-5xl font-black tracking-tight">Historial de Pedidos</h3>
            <p class="mt-2 text-white/80">Pedidos entregados y archivados para tu control.</p>
        </div>
    </section>

    <!-- Contenido -->
    <main class="max-w-6xl mx-auto px-6 lg:px-8 -mt-6">
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200 p-6 lg:p-8 fadeInUp">
            @if ($reservations->isEmpty() || $reservations->where('estado', 'archivado')->isEmpty())
                <div class="py-16 text-center">
                    <img src="{{ asset('images/empty-box.png') }}" alt="" class="mx-auto w-24 h-24 opacity-70 mb-4">
                    <p class="text-lg text-slate-600">Aún no hay pedidos archivados.</p>
                    <p class="text-sm text-slate-500">Cuando completes entregas aparecerán aquí.</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($reservations as $reservation)
                        @if ($reservation->estado === 'archivado')
                            <section
                                class="rounded-xl border border-slate-200 bg-slate-50 p-5 lg:p-6 hover:bg-slate-100/70 transition card-hover">
                                <!-- Encabezado de la reserva -->
                                <div class="flex flex-wrap items-start justify-between gap-4">
                                    <div class="space-y-1">
                                        <h4 class="text-xl font-bold">Reserva #{{ $reservation->id }}</h4>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                                Entregado · Archivado
                                            </span>
                                            <span class="text-sm text-slate-500">Cliente:</span>
                                            <span class="text-sm font-semibold text-indigo-700">
                                                {{ $reservation->user->nombre }} {{ $reservation->user->apellido }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-slate-500">Fecha de entrega</p>
                                        <p class="text-sm font-semibold">
                                            {{ optional($reservation->updated_at)->format('d/m/Y H:i') }}</p>
                                        <p class="mt-1 text-sm text-slate-500">Total</p>
                                        <p class="text-lg font-bold text-slate-800">${{ number_format($reservation->total, 2) }}</p>
                                    </div>
                                </div>

                                <!-- Items -->
                                <div class="mt-4 grid gap-4 md:grid-cols-2">
                                    @foreach ($reservation->items as $item)
                                        <article class="bg-white border border-slate-200 rounded-xl p-4 flex gap-4">
                                            <img src="{{ asset('images/' . $item->product->imagen_referencia) }}"
                                                alt="{{ $item->product->name }}"
                                                class="w-24 h-24 md:w-28 md:h-28 rounded-lg object-cover ring-1 ring-slate-200" />
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-slate-800">{{ $item->product->name }}</h5>
                                                <dl class="mt-2 grid grid-cols-3 gap-2 text-sm">
                                                    <div>
                                                        <dt class="text-slate-500">Cantidad</dt>
                                                        <dd class="font-semibold">{{ $item->quantity }}</dd>
                                                    </div>
                                                    <div>
                                                        <dt class="text-slate-500">Precio c/u</dt>
                                                        <dd class="font-semibold">${{ number_format($item->precio, 2) }}</dd>
                                                    </div>
                                                    <div>
                                                        <dt class="text-slate-500">Subtotal</dt>
                                                        <dd class="font-semibold">${{ number_format($item->subtotal, 2) }}</dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="h-10"></div>
    </main>

    @include('components.footer')
</body>

</html>
