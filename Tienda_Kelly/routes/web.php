<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoLocalController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\AdminClienteController;
use App\Http\Controllers\AdminVendedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminMercadoLocalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationItemController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MercadosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//use App\Http\Controllers\MercadoLocalController;



/*Vistas Principales*/
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'LoginUser'])->name('inicia-sesion');
Route::view('/','Index')->name('Index');
Route::view('/LoginUser','LoginUser')->name('LoginUser');
Route::view('/RegistroUser','RegistroUser')->name('RegistroUser');
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'loginuser'])->name('inicia-sesion');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('LoginUser', [LoginController::class, 'LoginUser']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



/*Vistas de Clientes*/
Route::view('/UserProfileVista', 'UserProfileVista')->name('UserProfileVista')->middleware('check.user.session');

/*Vistas de Vendedores*/

Route::view('/VendedorProfileVista','VendedorProfileVista')->name('VendedorProfileVista')->middleware('check.user.session');




/*Vistas de Mercado*/
//ELIMINAR



/*Administrador General*/
Route::view('/AdminProfileVista','AdminProfileVista')->name('AdminProfileVista')->middleware('check.user.session');

Route::view('/UserHistorialPedidos', 'UserHistorialPedidos')->name('UserHistorialPedidos')->middleware('check.user.session');







/**RUTAS DEL ADMINISTRADOR
 */
//mercadolocales
 Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('check.user.session');
 Route::get('/admin/crearmercados', [AdminController::class, 'crearmercados'])->name('admin.crearmercados')->middleware('check.user.session');
 Route::post('/admin/guardarmercados', [AdminController::class, 'guardarmercados'])->name('admin.guardarmercados')->middleware('check.user.session');
 Route::get('/admin/vermercados/{id}', [AdminController::class, 'vermercados'])->name('admin.vermercados')->middleware('check.user.session');
 Route::get('/admin/editarmercados/{id}', [AdminController::class, 'editarmercados'])->name('admin.editarmercados')->middleware('check.user.session');
 Route::patch('/admin/actualizarmercados/{id}', [AdminController::class, 'actualizarmercados'])->name('admin.actualizarmercados')->middleware('check.user.session');
 Route::delete('/admin/eliminarmercados/{id}', [AdminController::class, 'eliminarmercados'])->name('admin.eliminarmercados')->middleware('check.user.session');
//VENDEDORES
 Route::get('/admin/vendedores', [AdminController::class, 'vendedores'])->name('admin.vendedores')->middleware('check.user.session');
 Route::get('/admin/crearvendedores', [AdminController::class, 'crearvendedores'])->name('admin.crearvendedores')->middleware('check.user.session');
 Route::post('/admin/guardarvendedores', [AdminController::class, 'guardarvendedores'])->name('admin.guardarvendedores')->middleware('check.user.session');
 Route::get('/admin/vervendedores/{id}', [AdminController::class, 'vervendedores'])->name('admin.vervendedores')->middleware('check.user.session');
 Route::get('/admin/editarvendedores/{id}', [AdminController::class, 'editarvendedores'])->name('admin.editarvendedores')->middleware('check.user.session');
 Route::post('/admin/actualizarvendedor/{id}', [AdminController::class, 'actualizarvendedor'])->name('admin.actualizarvendedor')->middleware('check.user.session');
 Route::delete('/admin/eliminarvendedores/{id}', [AdminController::class, 'eliminarvendedores'])->name('admin.eliminarvendedores')->middleware('check.user.session');
 //CLIENTES
 Route::get('/admin/clientes', [AdminController::class, 'clientes'])->name('admin.clientes')->middleware('check.user.session');
 Route::delete('/admin/eliminarclientes/{id}', [AdminController::class, 'eliminarclientes'])->name('admin.eliminarclientes')->middleware('check.user.session');
//producto
Route::get('/admin/verproducto/{id}', [AdminController::class, 'verproducto'])->name('admin.verproducto')->middleware('check.user.session');
Route::delete('/vendedores/eliminarreservationitem/{id}', [VendedoresController::class, 'eliminarreservationitem'])->name('vendedores.eliminarrreservationitem')->middleware('check.user.session');




/**
 * RUTAS DEL USUARIO
 */
//Controlador e index
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index')->middleware('check.user.session');
// Ruta para el método mercado,vendedor y producto
Route::get('/usuarios/mercado/{id}', [UsuariosController::class, 'mercado'])->name('usuarios.mercado')->middleware('check.user.session');
Route::get('/usuarios/vendedor/{id}', [UsuariosController::class, 'vendedor'])->name('usuarios.vendedor')->middleware('check.user.session');
Route::get('/usuarios/producto/{id}', [UsuariosController::class, 'producto'])->name('usuarios.producto')->middleware('check.user.session');
//ruta para aniadir alc arrito e index
Route::post('/usuarios/addcarrito/{product}', [UsuariosController::class, 'addcarrito'])->name('usuarios.addcarrito')->middleware('check.user.session');
//RESERVAR y RESERVAS
Route::post('/usuarios/reservar', [UsuariosController::class, 'reservar'])->name('usuarios.reservar')->middleware('check.user.session');
// Ruta para ver el carrito
Route::get('/usuarios/carrito', [UsuariosController::class, 'carrito'])->name('usuarios.carrito')->middleware('check.user.session');
// Ruta para ver las reservas del usuario
Route::get('/usuarios/reservas', [UsuariosController::class, 'reservas'])->name('usuarios.reservas')->middleware('check.user.session');
Route::post('/usuarios/publicarestadoreserva/{id}', [UsuariosController::class, 'publicarestadoreserva'])->name('usuarios.publicarestadoreserva')->middleware('check.user.session');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/historial', [UsuariosController::class, 'historial'])->name('usuarios.historial');
Route::get('/usuarios/reservas/pdf/{id}', [UsuariosController::class, 'generateReceipt'])->name('reservas.pdf');
Route::delete('/usuarios/eliminarcarrito/{product}', [UsuariosController::class, 'eliminarcarrito'])->name('usuarios.eliminarcarrito')->middleware('check.user.session');
Route::get('/receipt/{id}', [UsuariosController::class, 'viewReceipt'])->name('viewReceipt')->middleware('check.user.session');
Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'editar'])->name('usuarios.editar')->middleware('check.user.session');
Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'actualizar'])->name('usuarios.actualizar')->middleware('check.user.session');



/**
 * RUTAS PARA EL VENDEDOR CONTROLADOR
 */
Route::get('/vendedores', [VendedoresController::class, 'index'])->name('vendedores.index')->middleware('check.user.session');
Route::get('/vendedores/perfil', [VendedoresController::class, 'perfil'])->name('vendedor.perfil')->middleware('check.user.session');
Route::get('/vendedores/editar/{id}', [VendedoresController::class, 'editar'])->name('vendedores.editar')->middleware('check.user.session');
Route::post('/vendedores/actualizar/{id}', [VendedoresController::class, 'actualizar'])->name('vendedores.actualizar')->middleware('check.user.session');
//producto
Route::get('/vendedores/productos', [VendedoresController::class, 'productos'])->name('vendedores.productos')->middleware('check.user.session');
Route::get('/vendedores/verproducto/{id}', [VendedoresController::class, 'verproducto'])->name('vendedores.verproducto')->middleware('check.user.session');
Route::get('/vendedores/agregarproducto/{id}',[VendedoresController::class, 'agregarproducto'])->name('vendedores.agregarproducto')->middleware('check.user.session');
Route::post('/vendedores/guardarproducto', [VendedoresController::class, 'guardarproducto'])->name('vendedores.guardarproducto')->middleware('check.user.session');
Route::get('/vendedores/editarproducto/{id}', [VendedoresController::class, 'editarproducto'])->name('vendedores.editarproducto')->middleware('check.user.session');
Route::put('/vendedores/actualizarproducto/{id}', [VendedoresController::class, 'actualizarproducto'])->name('vendedores.actualizarproducto')->middleware('check.user.session');
Route::get('/vendedores/actualizarestadoproducto/{id}', [VendedoresController::class, 'actualizarestadoprodcuto'])->name('vendedores.actualizarestadoproducto')->middleware('check.user.session');
Route::post('/vendedores/publicarestadoproducto/{id}', [VendedoresController::class, 'publicarestadoproducto'])->name('vendedores.publicarestadoproducto')->middleware('check.user.session');
Route::delete('/vendedores/eliminarproducto/{id}', [VendedoresController::class, 'eliminarproducto'])->name('vendedores.eliminarproducto')->middleware('check.user.session');
//Reservas
Route::get('/vendedores/reservas', [VendedoresController::class, 'reservas'])->name('vendedores.reservas')->middleware('check.user.session');
Route::get('/vendedores/verreserva/{id}', [VendedoresController::class, 'verreserva'])->name('vendedores.verreserva')->middleware('check.user.session');
Route::get('/vendedores/actualizarestadoreserva/{id}', [VendedoresController::class])->name('vendedores.actualizarestadoreserva')->middleware('check.user.session');
Route::post('/vendedores/publicarestadoreserva/{id}', [VendedoresController::class, 'publicarestadoreserva'])->name('vendedores.publicarestadoreserva')->middleware('check.user.session');
Route::get('/vendedores/historial', [VendedoresController::class, 'historial'])->name('vendedores.historial')->middleware('check.user.session');




/**
 * RUTAS PARA EL MERCADO CONTROLADOR
 */
Route::get('/mercados', [MercadosController::class, 'index'])->name('mercados.index')->middleware('check.user.session');
Route::get('/mercados/editar', [MercadosController::class, 'editar'])->name('mercados.editar')->middleware('check.user.session');
Route::patch('/mercados/actualizar/{id}', [MercadosController::class, 'actualizar'])->name('mercados.actualizar')->middleware('check.user.session');
//vendedores
Route::get('/mercados/vervendedor/{id}', [MercadosController::class, 'vervendedor'])->name('mercados.vervendedor')->middleware('check.user.session');
Route::get('/mercados/listavendedores', [MercadosController::class, 'listavendedores'])->name('mercados.listavendedores')->middleware('check.user.session');
Route::get('/mercados/editarvendedor/{id}', [MercadosController::class, 'editarvendedor'])->name('mercados.editarvendedor')->middleware('check.user.session');
Route::post('/mercados/actualizarvendedor/{id}', [MercadosController::class, 'actualizarvendedor'])->name('mercados.actualizarvendedor')->middleware('check.user.session');
Route::get('/mercados/agregarvendedor', [MercadosController::class, 'agregarvendedor'])->name('mercados.agregarvendedor')->middleware('check.user.session');
Route::post('/mercados/guardarvendedor', [MercadosController::class, 'guardarvendedor'])->name('mercados.guardarvendedor')->middleware('check.user.session');
Route::delete('/mercados/eliminarvendedor/{id}', [MercadosController::class, 'eliminarvendedor'])->name('mercados.eliminarvendedor')->middleware('check.user.session');
//Reservas
Route::get('/mercados/reservas', [MercadosController::class, 'reservas'])->name('mercados.reservas')->middleware('check.user.session');
Route::get('/mercados/reservadelvendedor/{id}', [MercadosController::class, 'reservasdelvendedor'])->name('mercados.reservasdelvendedor')->middleware('check.user.session');
Route::get('/mercados/editarreservas/{id}', [MercadosController::class, 'editarreservas'])->name('mercados.editarreservas')->middleware('check.user.session');
//productos
Route::get('/mercados/verproducto/{id}', [MercadosController::class, 'verproducto'])->name('mercados.verproducto')->middleware('check.user.session');
Route::get('/mercados/perfil', [MercadosController::class, 'perfil'])->name('mercados.perfil')->middleware('check.user.session');
Route::get('/mercados/historial', [MercadosController::class, 'historial'])->name('mercados.historial');






/*PRUEBAS PARA EL CARRITO*/
//CARRITOOOO
Route::get('/pruebauno', function () {
    return view('layout');
});
//Route::resource('users', UserController::class);
//CARRITOO
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');;
});
//RESERVAAAS
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');;
// routes/web.php
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
//RESERVA
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

