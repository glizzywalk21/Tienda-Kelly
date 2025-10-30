<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white text-gray-800">

    <!-- NAVBAR DESKTOP -->
    <nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
        <a href="{{ route('admin.index') }}">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                TiendaKelly <span class="text-indigo-600"><b>Admin</b></span>
            </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.areas') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Áreas</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Clientes</a>
            <a href="{{ route('reservations.index') }}"
                class="font-medium uppercase text-sm hover:text-indigo-600 transition">Reservas</a>
            <a href="{{ route('AdminProfileVista') }}"
                class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
                Perfil
            </a>
        </div>
    </nav>

    <main class="mx-auto mt-10 mb-32 px-4 md:px-8">

        <!-- NAVBAR MOBILE -->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center">
                    <a href="{{ route('admin.index') }}">
                        <img class="w-6" src="{{ asset('images/admin.home.nav.png') }}" alt="Home">
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}">
                        <img class="w-6" src="{{ asset('images/admin.sellers.nav.png') }}" alt="Vendedores">
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}">
                        <img class="w-6" src="{{ asset('images/admin.users.nav.png') }}" alt="Clientes">
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('AdminProfileVista')}}">
                        <img class="w-6" src="{{ asset('images/UserIcon.png') }}" alt="Perfil">
                    </a>
                </div>
            </div>
        </div>
        <!-- /NAVBAR MOBILE -->

        <!-- HEADER / SALUDO -->
        <header class="mt-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold gradient-text">
                    Hola! Bienvenido 👋
                </h1>
                <h3 class="text-indigo-600 font-semibold text-lg md:text-xl lg:text-2xl">
                    Administrador General
                </h3>
            </div>
        </header>

        <!-- ALERTA DE NUEVA ÁREA (si aplica) -->
        @if(session('usuario') && session('password'))
            <div class="bg-green-500 text-white text-center py-4 px-6 rounded-md mt-6">
                <strong>¡Nueva area creada llamado "{{ session('nombre')}}"!</strong><br>
                Las credenciales del mercado son las siguientes:<br>
                <span><strong>Usuario:</strong> {{ session('usuario') }}</span><br>
                <span><strong>Contraseña:</strong> {{ session('password') }}</span>
                <p>Son Unicas asi que no se le olvide!</p>
            </div>
        @endif

        <!-- MÉTRICAS RÁPIDAS -->
        <section class="mt-8">
            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-3">

                <a href="{{ route('admin.areas') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Áreas</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($areas) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

                <a href="{{ route('admin.vendedores') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Vendedores</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($vendedores) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

                <a href="{{ route('admin.clientes') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Clientes</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($clientes) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

                <a href="{{ route('reservations.index') }}"
                    class="group rounded-2xl bg-white ring-1 ring-gray-200 p-4 text-center hover:shadow-md transition">
                    <p class="text-xs text-gray-500">Reservas</p>
                    <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ number_format($reservas) }}</p>
                    <span class="mt-2 block h-1 w-8 mx-auto rounded bg-indigo-500"></span>
                </a>

            </div>
        </section>

        <!-- DASHBOARD CHARTS -->
        <section class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Clientes por mes -->
            <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                            Tendencia de clientes
                        </p>
                        <h2 class="text-lg font-bold text-gray-800 -mt-1">
                            Nuevos clientes por mes
                        </h2>
                    </div>

                    <a href="{{ route('admin.clientes') }}"
                        class="text-[11px] font-semibold bg-indigo-600 text-white px-3 py-1 rounded-xl hover:bg-indigo-500 transition">
                        Ver clientes
                    </a>
                </div>

                <div class="h-48">
                    <canvas id="chartClientes"></canvas>
                </div>
            </div>

            <!-- Reservas últimos días -->
            <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                            Actividad reciente
                        </p>
                        <h2 class="text-lg font-bold text-gray-800 -mt-1">
                            Reservas en los últimos días
                        </h2>
                    </div>

                    <a href="{{ route('reservations.index') }}"
                        class="text-[11px] font-semibold bg-indigo-600 text-white px-3 py-1 rounded-xl hover:bg-indigo-500 transition">
                        Ver reservas
                    </a>
                </div>

                <div class="h-48">
                    <canvas id="chartReservas"></canvas>
                </div>
            </div>

            <!-- Actividad por área / mercado -->
            <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                            Distribución por área
                        </p>
                        <h2 class="text-lg font-bold text-gray-800 -mt-1">
                            Actividad por área / mercado
                        </h2>
                    </div>

                    <a href="{{ route('admin.areas') }}"
                        class="text-[11px] font-semibold bg-indigo-600 text-white px-3 py-1 rounded-xl hover:bg-indigo-500 transition">
                        Ver áreas
                    </a>
                </div>

                <div class="h-64">
                    <canvas id="chartAreas"></canvas>
                </div>
            </div>

            <!-- Sesiones activas -->
            <div class="bg-white rounded-2xl shadow-lg p-5 flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">
                            Seguridad / monitoreo
                        </p>
                        <h2 class="text-lg font-bold text-gray-800 -mt-1">
                            Sesiones activas
                        </h2>
                        <p class="text-xs text-gray-500 mt-2 leading-relaxed max-w-[220px]">
                            Cantidad de sesiones abiertas actualmente en el sistema
                            (cualquier usuario logueado).
                        </p>
                    </div>
                </div>

                <div class="flex-1 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-5xl font-extrabold text-indigo-600 leading-none">
                            {{ number_format($sesionesActivas) }}
                        </div>
                        <div class="text-sm text-gray-600 font-medium mt-2">
                            sesión(es) registradas
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    @include('components.footer')

    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Pasamos los arrays PHP -> JS
        const clientesPorMesLabels = @json($clientesPorMesLabels ?? []);
        const clientesPorMesData = @json($clientesPorMesData ?? []);

        const reservasPorDiaLabels = @json($reservasPorDiaLabels ?? []);
        const reservasPorDiaData = @json($reservasPorDiaData ?? []);

        const areasLabels = @json($areasLabels ?? []);
        const areasData = @json($areasData ?? []);

        // === Gráfica 1: Clientes nuevos (línea)
        new Chart(
            document.getElementById('chartClientes').getContext('2d'),
            {
                type: 'line',
                data: {
                    labels: clientesPorMesLabels,
                    datasets: [{
                        label: 'Clientes nuevos',
                        data: clientesPorMesData,
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            }
        );

        // === Gráfica 2: Reservas últimos días (barras)
        new Chart(
            document.getElementById('chartReservas').getContext('2d'),
            {
                type: 'bar',
                data: {
                    labels: reservasPorDiaLabels,
                    datasets: [{
                        label: 'Reservas',
                        data: reservasPorDiaData,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            }
        );

        // === Gráfica 3: Actividad por área (doughnut)
        new Chart(
            document.getElementById('chartAreas').getContext('2d'),
            {
                type: 'doughnut',
                data: {
                    labels: areasLabels,
                    datasets: [{
                        label: 'Movimientos',
                        data: areasData,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 12 }
                            }
                        }
                    },
                    cutout: '60%'
                }
            }
        );
    </script>

</body>

</html>