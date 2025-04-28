<?php

namespace App\Http\Controllers;

//modelos
use App\Models\User;
use App\Models\Cliente;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ReservationItem;
//request
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\MercadoLocalRequest;
use App\Http\Requests\VendedorRequest;
use App\Http\Requests\CartRequest;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ProductRequest;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

 class UsuariosController extends Controller{


    //VER MERCADOS LOCALES O INDEX
    public function index(){
        $mercadoLocals = MercadoLocal::paginate();
        $vendedors = Vendedor::paginate();

        $iVendedors = (request()->input('page', 1) - 1) * $vendedors->perPage();
        $iMercadoLocals = (request()->input('page', 1) - 1) * $mercadoLocals->perPage();

        // Retorna la vista 'UserHome' con los datos paginados
        return view('UserHome', compact('vendedors', 'mercadoLocals'))
        ->with('iVendedors', $iVendedors)
        ->with('iMercadoLocals', $iMercadoLocals);
    }
    public function create(){
        $cliente = new User();
        return view('RegistroUser', compact('cliente'));

    }
    public function editar($id)
    {
        // Verificar si el vendedor autenticado puede editar este registro
        if (Auth::user()->id == $id) {
            $cliente = User::find($id);

            return view('UserEditarPerfil', compact('cliente'));
        }

        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    public function actualizar(Request $request, $id)
{
    // Validación de los campos
    $request->validate([
        'password' => 'nullable|string|min:8|confirmed',
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:15',
        'sexo' => 'nullable|string|in:Masculino,Femenino',
        'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'usuario' => 'required|string|email|max:255|unique:users,usuario,' . $id, // Asegura la unicidad del usuario (correo)
        'ROL' => 'required|in:4', // Asegura que el ROL sea uno de los permitidos
    ]);

    // Verificar si el usuario autenticado puede actualizar este registro
    if (Auth::id() != $id && Auth::user()->ROL != 1) {
        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    // Encontrar el usuario por ID
    $user = User::findOrFail($id);

    // Actualizar los campos
    $user->usuario = $request->input('usuario');
    $user->ROL = $request->input('ROL');

    // Si la contraseña se envía, actualiza, de lo contrario, deja la existente
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    // Actualizar los demás campos
    $user->nombre = $request->input('nombre');
    $user->apellido = $request->input('apellido');
    $user->telefono = $request->input('telefono');
    $user->sexo = $request->input('sexo');

    // Manejar la imagen de perfil
    if ($request->hasFile('imagen_perfil')) {
        // Guardar la nueva imagen
        $imageName = time() . '.' . $request->imagen_perfil->extension();
        $request->imagen_perfil->move(public_path('imgs'), $imageName);

        // Eliminar la imagen anterior si existe
        if ($user->imagen_perfil && $user->imagen_perfil != 'non-img.png' && file_exists(public_path('imgs/' . $user->imagen_perfil))) {
            unlink(public_path('imgs/' . $user->imagen_perfil));
        }

        // Actualizar la referencia de la imagen de perfil en la base de datos
        $user->imagen_perfil = $imageName;
    }

    // Guardar los cambios en la base de datos
    $user->save();

    // Redireccionar o devolver una respuesta
    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
}




    /**
     * FUNCIONES DEL USUARIO
     */
    public function store(ClienteRequest $request){
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:clientes',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:clientes',
            'sexo' => 'required|string',
            'contrasena' => 'required|string|min:8|confirmed',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear cliente si la validación pasa
        $cliente = User::create([
            'usuario' => $request->usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'contrasena' => bcrypt($request->contrasena), // Asegúrate de encriptar la contraseña
        ]);

        // Guardar el ID del cliente en la sesión
        Session::put('id', $cliente->id);

        return redirect()->route('LoginUser', ['success' => true]);

    }

    //VER MERCADO Y SUS PUESTOS
    public function mercado($id, Request $request)
{
    // Buscar el mercado local por ID
    $mercadoLocal = MercadoLocal::find($id);

    // Filtrar vendedores según la clasificación si se proporciona, de lo contrario obtener todos con paginación
    $query = Vendedor::where('fk_mercado', $id);

    if ($request->has('clasificacion') && $request->clasificacion != 'todos') {
        $query->where('clasificacion', $request->clasificacion);
    }

    // Obtener los vendedores filtrados con paginación
    $vendedors = $query->paginate();

    // Retornar la vista con ambos datos
    return view('UserPuestosVendedores', compact('mercadoLocal', 'vendedors'))
        ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
}


    //VER VENDEDOR Y SUS PRODUCTOS
    public function vendedor($id)
    {
        $vendedor = Vendedor::find($id);

        if(!$vendedor) {
            return redirect()->back()->with('error','Vendedor no encontrado');
        }

        //Esta variable es para sacar el nombre del fk__mercadolocal
        $mercadoLocal = $vendedor->mercadoLocal;

        //esta varaible es para sacar los productos
        $products = Product::where('fk_vendedors',$id)->paginate();

        return view('UserProductosDeUnPuesto', compact('vendedor','mercadoLocal','products'))->with('i',(request()->input('page',1) - 1) * $products->perPage());
    }

    //VER EL PRODCUTO
    public function producto($id)
    {
        // Obtener el producto específico por su ID
        $product = Product::find($id);

        // Obtener otros 3 productos de la misma categoría que no sean el actual
        $products = Product::where('id', '!=', $id)
        ->where('clasificacion', $product->clasificacion)
        ->take(3)
            ->get();
        $vendedor = $product->vendedor;

        // Retornar la vista con ambos datos
        return view('UserProductoEnEspecifico', compact('product', 'products', 'vendedor'))
        ->with('i', 0); // Ajustar 'i' manualmente si es necesario
    }



    //AGREGAR EL PRODUCTO AL CARRITO
    public function addcarrito(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        $cartItem = Cart::where('fk_product', $product->id)
                        ->where('fk_user', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->subtotal = $cartItem->quantity * $cartItem->product->price;
            $cartItem->save();
        } else {
            Cart::create([
                'fk_product' => $product->id,
                'fk_user' => Auth::id(),
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price
            ]);
        }

        return redirect()->route('usuarios.carrito')->with('success', 'Producto agregado al carrito correctamente.');
    }

    /**
     * IMPRIMIR RECIBO
     */
        public function generateReceipt($id)
{
    // Obtener la reserva y los ítems relacionados con el vendedor y el mercado local
    $reservation = Reservation::with('items.product.vendedor.mercadoLocal')->findOrFail($id);

    // Obtener los mercados únicos relacionados con la reserva
    $mercados = $reservation->items->map(function($item) {
        return $item->product->vendedor->mercadoLocal;
    })->unique('id');

    $vendedor = $reservation->items->map(function($item) {
        return $item->product->vendedor;
    })->unique('id');

    // Generar el PDF
    $pdf = Pdf::loadView('receipt', [
        'reservation' => $reservation,
        'mercados' => $mercados,
        'vendedor' => $vendedor
    ]);

    // Descargar el PDF
    $pdf->download('recibo-reserva-'.$id.'.pdf');

    // Redirigir a la vista usuarios.reservas
    return redirect()->route('usuarios.reservas');
}

        /**
         * ABRIR RECIBO
         */
        public function viewReceipt($id)
{
    // Obtener la reserva y los ítems relacionados con el vendedor y el mercado local
    $reservation = Reservation::with('items.product.vendedor.mercadoLocal')->findOrFail($id);

    // Obtener los mercados únicos relacionados con la reserva
    $mercados = $reservation->items->map(function($item) {
        return $item->product->vendedor->mercadoLocal;
    })->unique('id');

    // Obtener los vendedores únicos
    $vendedor = $reservation->items->map(function($item) {
        return $item->product->vendedor;
    })->unique('id');

    // Generar el PDF
    $pdf = Pdf::loadView('receipt', [
        'reservation' => $reservation,
        'mercados' => $mercados,
        'vendedor' => $vendedor
    ]);

    // Abrir el PDF en una nueva página
    return $pdf->stream('recibo-reserva-' . $id . '.pdf');
}



    public function carrito()
    {
        try {
            $userid = Auth::id();

            $cartItems = Cart::with('product')->where('fk_user', $userid)->get();
            $total = $cartItems->reduce(fn ($carry, $item) => $carry + ($item->product->price * $item->quantity), 0);
            return view('UserCarritoGeneral', compact('cartItems', 'total', 'userid'));
        } catch (\Exception $e) {
            \Log::error('Error en carrito: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error interno del servidor'], 500);
        }
    }
    public function reservar(Request $request)
    {
        DB::beginTransaction();

        try {
            // Crear la reserva con el campo 'fk_user' incluido
            $reservation = Reservation::create([
                'fk_user' => Auth::id(), // Asegúrate de que este campo coincide con tu esquema
                'total' => 0, // Se actualizará después

            ]);

            // Obtener los artículos del carrito
            $cartItems = Cart::where('fk_user', Auth::id())->get();

            $total = 0;

            foreach ($cartItems as $item) {
                // Crear elementos de reserva
                ReservationItem::create([
                    'fk_reservation' => $reservation->id,
                    'fk_product' => $item->fk_product,
                    'quantity' => $item->quantity,
                    'nombre'=>$item->product->nombre,
                    'subtotal' => $item->subtotal,
                    'fk_vendedors' => $item->product->vendedor->id,
                    'fk_mercados' => $item->product->vendedor->fk_mercado,
                    'precio' => $item->product->price// Ajusta según la lógica
                ]);

                // Calcular el total
                $total += $item->subtotal;
            }

            // Actualizar el total de la reserva
            $reservation->total = $total;
            $reservation->save();

            // Vaciar el carrito
            Cart::where('fk_user', Auth::id())->delete();

            DB::commit();

            return redirect()->route('reservas.pdf', ['id' => $reservation->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear la reserva: ' . $e->getMessage());
        }
    }
    public function reservas()
    {
        // Obtener las reservas del usuario autenticado con los ítems y productos relacionados
        $reservations = Reservation::where('fk_user', Auth::id())->with('items.product')->get();

        return view('UserEstadoReservas', compact('reservations'));
    }
    public function historial()
    {
        // Obtener las reservas del usuario autenticado con los ítems y productos relacionados
        // y que el estado sea "archivado"
        $reservations = Reservation::where('fk_user', Auth::id())
        ->where('estado', 'archivado')
        ->with('items.product')
        ->get();

        return view('UserHistorialPedidos', compact('reservations'));
    }




    /**
     * CAMBIAR ESTADO RESERVAS
     */
    public function publicarestadoreserva(Request $request, $id)
        {
            // Obtener el ReservationItem por ID
            $item = ReservationItem::find($id);

            // Verificar si el item fue encontrado
            if (!$item) {
                return redirect()->route('usuarios.reservas')->with('error', 'El ítem de la reserva no fue encontrado.');
            }

            // Verificar si el item pertenece al vendedor con id = 1
            if ($item->reservation->user->id == Auth::id()) {
                // Validar el estado enviado
                $estadoValido = ['enviado', 'sin_existencias', 'en_espera', 'sin_espera', 'en_entrega', 'recibido', 'sin_recibir', 'problemas', 'archivado'];
                $nuevoEstado = $request->input('estado');

                if (in_array($nuevoEstado, $estadoValido)) {
                    // Actualizar el estado del item
                    $item->estado = $nuevoEstado;
                    $item->save();


                    /**
                     * SIN EXISTENCIAS
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'sin_existencias')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'sin_existencias';
                        $reserva->save();
                    }
                    /**
                     * EN ESPERA
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'en_espera')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'en_espera';
                        $reserva->save();
                    }
                    /**
                     * SIN ESPERA
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'sin_espera')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'sin_espera';
                        $reserva->save();
                    }





                    /**
                     * En ENTREGA
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'en_entrega')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'en_entrega';
                        $reserva->save();
                    }
                    /**
                     * SIN RECIBIR
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'sin_recibir')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'sin_recibir';
                        $reserva->save();
                    }
                    /**
                     * PROBLEMA
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'problema')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'problema';
                        $reserva->save();
                    }
                    /**
                     * RECIBIDO
                     */
                    // Verificar si todos los items relacionados tienen estado 'en_entrega'
                    $fk_reservation = $item->fk_reservation;
                    $todosEnEntrega = ReservationItem::where('fk_reservation', $fk_reservation)
                        ->where('estado', '!=', 'recibido')
                        ->count() == 0;

                    if ($todosEnEntrega) {
                        // Actualizar el estado de la reserva a 'en_entrega'
                        $reserva = Reservation::find($fk_reservation);
                        $reserva->estado = 'recibido';
                        $reserva->save();
                    }


                    // Redireccionar a la vista o hacer otra acción
                    return redirect()->route('usuarios.reservas')->with('success', 'El estado de la reserva ha sido actualizado.');
                } else {
                    // Estado no válido
                    return redirect()->route('usuarios.reservas')->with('error', 'El estado proporcionado no es válido.');
                }
            } else {
                // Si no pertenece al vendedor correcto, mostrar un error
                return redirect()->route('usuarios.reservas')->with('error', 'No tienes permiso para actualizar este item.');
            }
        }

        public function eliminarcarrito(Product $product){
            {
                $cartItem = Cart::where('fk_product', $product->id)
                                ->where('fk_user', Auth::id())
                                ->first();

                if ($cartItem) {
                    if ($cartItem->quantity > 1) {
                        $cartItem->quantity--;
                        $cartItem->subtotal = $cartItem->quantity * $cartItem->product->price;
                        $cartItem->save();
                    } else {
                        $cartItem->delete();
                    }
                }

                return redirect()->route('usuarios.carrito')->with('success', 'Producto eliminado del carrito correctamente.');
            }
        }


 }

