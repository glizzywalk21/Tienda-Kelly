<!-- Navbar Desktop -->
<nav class="hidden md:flex px-8 py-4 bg-white items-center justify-between shadow-lg sticky top-0 z-50">
    <a href="{{ route('usuarios.index') }}" class="flex items-center gap-2">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
            Tienda <span class="text-indigo-600">Kelly</span>
        </h1>
    </a>
    <div class="flex gap-8">
        <a href="{{ route('usuarios.index') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Hogar</a>
        <a href="{{ route('usuarios.carrito') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Carrito</a>
        <a href="{{ route('usuarios.reservas') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Reservas</a>
        <a href="{{ route('usuarios.historial') }}" class="font-medium uppercase text-sm hover:text-indigo-600 transition">Historial</a>
        <a href="{{ route('UserProfileVista') }}" class="font-semibold uppercase text-sm border border-indigo-600 text-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-600 hover:text-white transition">
            Perfil
        </a>
    </div>
</nav>

<!-- Navbar Móvil -->
<div class="bottom-bar fixed bottom-3 left-0 right-0 md:hidden flex justify-center z-50">
    <div class="bg-gray-900 shadow-xl rounded-2xl w-72 h-14 flex justify-around items-center px-3">
        <a href="{{ route('usuarios.index') }}" class="bg-white rounded-full p-2 shadow-lg">
            <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
        </a>
        <a href="{{ route('usuarios.carrito') }}">
            <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
        </a>
        <a href="{{ route('usuarios.reservas') }}">
            <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
        </a>
        <a href="{{ route('UserProfileVista') }}">
            <img class="w-8 h-8 rounded-full object-cover border-2 border-white shadow" src="{{ asset('storage/imgs/' . (Auth::user()->imagen_perfil ?? 'non-img.png')) }}" alt="Profile Icon" />
        </a>
    </div>
</div>
