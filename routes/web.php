<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\MercadosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ---------- Autenticación / Vistas principales ---------- */
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.attempt');
Route::post('/inicia-sesion', [LoginController::class, 'loginUser'])->name('inicia-sesion');

Route::view('/', 'Index')->name('Index');
Route::view('/LoginUser', 'LoginUser')->name('LoginUser');
Route::view('/RegistroUser', 'RegistroUser')->name('RegistroUser');
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/* ---------- Vistas de perfiles (solo render) ---------- */
Route::view('/UserProfileVista', 'UserProfileVista')->name('UserProfileVista')->middleware('check.user.session');
Route::view('/VendedorProfileVista', 'VendedorProfileVista')->name('VendedorProfileVista')->middleware('check.user.session');
Route::view('/AdminProfileVista', 'AdminProfileVista')->name('AdminProfileVista')->middleware('check.user.session');
Route::view('/UserHistorialPedidos', 'UserHistorialPedidos')->name('UserHistorialPedidos')->middleware('check.user.session');

/* =======================================================================
|                               ADMIN
======================================================================= */

// Dashboard
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('check.user.session');

/* --- Mercados (admin) --- */
Route::get('/admin/crearmercados', [AdminController::class, 'crearmercados'])
    ->name('admin.crearmercados')->middleware('check.user.session');

Route::post('/admin/guardarmercados', [AdminController::class, 'guardarmercados'])
    ->name('admin.guardarmercados')->middleware('check.user.session');

Route::get('/admin/vermercados/{id}', [AdminController::class, 'vermercados'])
    ->whereNumber('id')->name('admin.vermercados')->middleware('check.user.session');

Route::get('/admin/editarmercados/{id}', [AdminController::class, 'editarmercados'])
    ->whereNumber('id')->name('admin.editarmercados')->middleware('check.user.session');

Route::match(['put','patch'], '/admin/actualizarmercados/{id}', [AdminController::class, 'actualizarmercados'])
    ->whereNumber('id')->name('admin.actualizarmercados')->middleware('check.user.session');

Route::delete('/admin/eliminarmercados/{id}', [AdminController::class, 'eliminarmercados'])
    ->whereNumber('id')->name('admin.eliminarmercados')->middleware('check.user.session');

/* --- Vendedores (admin) --- */
Route::get('/admin/vendedores', [AdminController::class, 'vendedores'])
    ->name('admin.vendedores')->middleware('check.user.session');

Route::get('/admin/crearvendedores', [AdminController::class, 'crearvendedores'])
    ->name('admin.crearvendedores')->middleware('check.user.session');

Route::post('/admin/guardarvendedores', [AdminController::class, 'guardarvendedores'])
    ->name('admin.guardarvendedores')->middleware('check.user.session');

/* 👇 PERFIL DEL VENDEDOR (Vista correcta: AdminPuestoDelVendedor) */
Route::get('/admin/vervendedores/{id}', [AdminController::class, 'vervendedores'])
    ->whereNumber('id')->name('admin.vervendedores')->middleware('check.user.session');

Route::get('/admin/editarvendedores/{id}', [AdminController::class, 'editarvendedores'])
    ->whereNumber('id')->name('admin.editarvendedores')->middleware('check.user.session');

Route::match(['put','patch','post'], '/admin/actualizarvendedor/{id}', [AdminController::class, 'actualizarvendedor'])
    ->whereNumber('id')->name('admin.actualizarvendedor')->middleware('check.user.session');

Route::delete('/admin/eliminarvendedores/{id}', [AdminController::class, 'eliminarvendedores'])
    ->whereNumber('id')->name('admin.eliminarvendedores')->middleware('check.user.session');

/* --- Clientes (admin) --- */
Route::get('/admin/clientes', [AdminController::class, 'clientes'])
    ->name('admin.clientes')->middleware('check.user.session');

Route::delete('/admin/eliminarclientes/{id}', [AdminController::class, 'eliminarclientes'])
    ->whereNumber('id')->name('admin.eliminarclientes')->middleware('check.user.session');

/* --- Productos (admin) --- */
/* Muestra el producto específico (blade: AdminProductoEspecifico) */
Route::get('/admin/verproducto/{id}', [AdminController::class, 'verproducto'])
    ->whereNumber('id')->name('admin.verproducto')->middleware('check.user.session');

/* =======================================================================
|                               USUARIO (Catálogo)
======================================================================= */

Route::get('/usuarios', [UsuariosController::class, 'index'])
    ->name('usuarios.index')->middleware('check.user.session');

Route::get('/usuarios/mercado/{id}', [UsuariosController::class, 'mercado'])
    ->whereNumber('id')->name('usuarios.mercado')->middleware('check.user.session');

Route::get('/usuarios/vendedor/{id}', [UsuariosController::class, 'vendedor'])
    ->whereNumber('id')->name('usuarios.vendedor')->middleware('check.user.session');

Route::get('/usuarios/producto/{id}', [UsuariosController::class, 'producto'])
    ->whereNumber('id')->name('usuarios.producto')->middleware('check.user.session');

Route::post('/usuarios/addcarrito/{product}', [UsuariosController::class, 'addcarrito'])
    ->whereNumber('product')->name('usuarios.addcarrito')->middleware('check.user.session');

Route::post('/usuarios/reservar', [UsuariosController::class, 'reservar'])
    ->name('usuarios.reservar')->middleware('check.user.session');

Route::post('/usuarios/checkout', [UsuariosController::class, 'checkout'])
    ->name('usuarios.checkout')->middleware('check.user.session');

Route::get('/usuarios/carrito', [UsuariosController::class, 'carrito'])
    ->name('usuarios.carrito')->middleware('check.user.session');

Route::get('/usuarios/reservas', [UsuariosController::class, 'reservas'])
    ->name('usuarios.reservas')->middleware('check.user.session');

Route::post('/usuarios/publicarestadoreserva/{id}', [UsuariosController::class, 'publicarestadoreserva'])
    ->whereNumber('id')->name('usuarios.publicarestadoreserva')->middleware('check.user.session');

Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');

Route::get('/usuarios/historial', [UsuariosController::class, 'historial'])
    ->name('usuarios.historial')->middleware('check.user.session');

/* PDF de reservas (descargar de una vez) */
Route::get('/usuarios/reservas/pdf/{id}', [UsuariosController::class, 'generateReceipt'])
    ->whereNumber('id')->name('reservas.pdf'); // puedes añadir middleware si quieres protegerlo

/* Ver PDF en navegador (opcional) */
Route::get('/receipt/{id}', [UsuariosController::class, 'viewReceipt'])
    ->whereNumber('id')->name('viewReceipt')->middleware('check.user.session');

Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'editar'])
    ->whereNumber('id')->name('usuarios.editar')->middleware('check.user.session');

Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'actualizar'])
    ->whereNumber('id')->name('usuarios.actualizar')->middleware('check.user.session');

Route::delete('/usuarios/eliminarcarrito/{product}', [UsuariosController::class, 'eliminarcarrito'])
    ->whereNumber('product')->name('usuarios.eliminarcarrito')->middleware('check.user.session');

/* =======================================================================
|                               VENDEDOR
======================================================================= */

Route::get('/vendedores', [VendedoresController::class, 'index'])
    ->name('vendedores.index')->middleware('check.user.session');

Route::get('/vendedores/perfil', [VendedoresController::class, 'perfil'])
    ->name('vendedor.perfil')->middleware('check.user.session');

Route::get('/vendedores/editar/{id}', [VendedoresController::class, 'editar'])
    ->whereNumber('id')->name('vendedores.editar')->middleware('check.user.session');

Route::put('/vendedores/actualizar/{id}', [VendedoresController::class, 'actualizar'])
    ->whereNumber('id')->name('vendedores.actualizar')->middleware('check.user.session');

/* Productos (vendedor) */
Route::get('/vendedores/productos', [VendedoresController::class, 'productos'])
    ->name('vendedores.productos')->middleware('check.user.session');

Route::get('/vendedores/verproducto/{id}', [VendedoresController::class, 'verproducto'])
    ->whereNumber('id')->name('vendedores.verproducto')->middleware('check.user.session');

Route::get('/vendedores/agregarproducto/{id}', [VendedoresController::class, 'agregarproducto'])
    ->whereNumber('id')->name('vendedores.agregarproducto')->middleware('check.user.session');

Route::post('/vendedores/guardarproducto', [VendedoresController::class, 'guardarproducto'])
    ->name('vendedores.guardarproducto')->middleware('check.user.session');

Route::get('/vendedores/editarproducto/{id}', [VendedoresController::class, 'editarproducto'])
    ->whereNumber('id')->name('vendedores.editarproducto')->middleware('check.user.session');

Route::put('/vendedores/actualizarproducto/{id}', [VendedoresController::class, 'actualizarproducto'])
    ->whereNumber('id')->name('vendedores.actualizarproducto')->middleware('check.user.session');

Route::get('/vendedores/actualizarestadoproducto/{id}', [VendedoresController::class, 'actualizarestadoprodcuto'])
    ->whereNumber('id')->name('vendedores.actualizarestadoproducto')->middleware('check.user.session');

Route::post('/vendedores/publicarestadoproducto/{id}', [VendedoresController::class, 'publicarestadoproducto'])
    ->whereNumber('id')->name('vendedores.publicarestadoproducto')->middleware('check.user.session');

Route::delete('/vendedores/eliminarproducto/{id}', [VendedoresController::class, 'eliminarproducto'])
    ->whereNumber('id')->name('vendedores.eliminarproducto')->middleware('check.user.session');

/* Reservas (vendedor) */
Route::get('/vendedores/reservas', [VendedoresController::class, 'reservas'])
    ->name('vendedores.reservas')->middleware('check.user.session');

Route::get('/vendedores/verreserva/{id}', [VendedoresController::class, 'verreserva'])
    ->whereNumber('id')->name('vendedores.verreserva')->middleware('check.user.session');

Route::get('/vendedores/actualizarestadoreserva/{id}', [VendedoresController::class, 'actualizarestadoreserva'])
    ->whereNumber('id')->name('vendedores.actualizarestadoreserva')->middleware('check.user.session');

Route::post('/vendedores/publicarestadoreserva/{id}', [VendedoresController::class, 'publicarestadoreserva'])
    ->whereNumber('id')->name('vendedores.publicarestadoreserva')->middleware('check.user.session');

Route::get('/vendedores/historial', [VendedoresController::class, 'historial'])
    ->name('vendedores.historial')->middleware('check.user.session');

/* Eliminar ReservationItem (vendedor) */
Route::delete('/vendedores/eliminarreservationitem/{id}', [VendedoresController::class, 'eliminarreservationitem'])
    ->whereNumber('id')->name('vendedores.eliminarrreservationitem')->middleware('check.user.session');

/* =======================================================================
|                               MERCADO (gestión)
======================================================================= */

Route::get('/mercados', [MercadosController::class, 'index'])
    ->name('mercados.index')->middleware('check.user.session');

Route::get('/mercados/editar', [MercadosController::class, 'editar'])
    ->name('mercados.editar')->middleware('check.user.session');

Route::match(['put','patch'], '/mercados/actualizar/{id}', [MercadosController::class, 'actualizar'])
    ->whereNumber('id')->name('mercados.actualizar')->middleware('check.user.session');

Route::get('/mercados/vervendedor/{id}', [MercadosController::class, 'vervendedor'])
    ->whereNumber('id')->name('mercados.vervendedor')->middleware('check.user.session');

Route::get('/mercados/listavendedores', [MercadosController::class, 'listavendedores'])
    ->name('mercados.listavendedores')->middleware('check.user.session');

Route::get('/mercados/editarvendedor/{id}', [MercadosController::class, 'editarvendedor'])
    ->whereNumber('id')->name('mercados.editarvendedor')->middleware('check.user.session');

Route::put('/mercados/actualizarvendedor/{id}', [MercadosController::class, 'actualizarvendedor'])
    ->whereNumber('id')->name('mercados.actualizarvendedor')->middleware('check.user.session');

Route::get('/mercados/agregarvendedor', [MercadosController::class, 'agregarvendedor'])
    ->name('mercados.agregarvendedor')->middleware('check.user.session');

Route::post('/mercados/guardarvendedor', [MercadosController::class, 'guardarvendedor'])
    ->name('mercados.guardarvendedor')->middleware('check.user.session');

Route::delete('/mercados/eliminarvendedor/{id}', [MercadosController::class, 'eliminarvendedor'])
    ->whereNumber('id')->name('mercados.eliminarvendedor')->middleware('check.user.session');

Route::get('/mercados/reservas', [MercadosController::class, 'reservas'])
    ->name('mercados.reservas')->middleware('check.user.session');

Route::get('/mercados/reservadelvendedor/{id}', [MercadosController::class, 'reservasdelvendedor'])
    ->whereNumber('id')->name('mercados.reservasdelvendedor')->middleware('check.user.session');

Route::get('/mercados/editarreservas/{id}', [MercadosController::class, 'editarreservas'])
    ->whereNumber('id')->name('mercados.editarreservas')->middleware('check.user.session');

Route::get('/mercados/verproducto/{id}', [MercadosController::class, 'verproducto'])
    ->whereNumber('id')->name('mercados.verproducto')->middleware('check.user.session');

Route::get('/mercados/perfil', [MercadosController::class, 'perfil'])
    ->name('mercados.perfil')->middleware('check.user.session');

Route::get('/mercados/historial', [MercadosController::class, 'historial'])
    ->name('mercados.historial');

/* =======================================================================
|                          Carrito (demo / clásico)
======================================================================= */

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->whereNumber('product')->name('cart.add');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->whereNumber('product')->name('cart.remove');
});

Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/* =======================================================================
|                         CRUD Reservations (admin/demo)
|   Nota: Si quieres que sólo admin acceda, agrega tu middleware aquí.
======================================================================= */

Route::middleware(['check.user.session'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->whereNumber('reservation')->name('reservations.show');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->whereNumber('reservation')->name('reservations.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->whereNumber('reservation')->name('reservations.destroy');
});

/* ---------- Prueba layout ---------- */
Route::get('/pruebauno', fn () => view('layout'));
