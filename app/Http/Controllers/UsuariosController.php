<?php

namespace App\Http\Controllers;

// Modelos
use App\Models\User;
use App\Models\Cliente;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ReservationItem;

// Requests
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuariosController extends Controller
{
    // VER MERCADOS LOCALES O INDEX
    public function index()
    {
        $mercadoLocals = MercadoLocal::paginate();
        $vendedors = Vendedor::paginate();

        $iVendedors = (request()->input('page', 1) - 1) * $vendedors->perPage();
        $iMercadoLocals = (request()->input('page', 1) - 1) * $mercadoLocals->perPage();

        return view('UserHome', compact('vendedors', 'mercadoLocals'))
            ->with('iVendedors', $iVendedors)
            ->with('iMercadoLocals', $iMercadoLocals);
    }

    public function create()
    {
        $cliente = new User();
        return view('RegistroUser', compact('cliente'));
    }

    public function editar($id)
    {
        if (Auth::user()->id == $id) {
            $cliente = User::find($id);
            return view('UserEditarPerfil', compact('cliente'));
        }
        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required|string|email|max:255|unique:users,usuario,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'sexo' => 'nullable|string|in:Masc,Fem,Masculino,Femenino',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
        ]);

        $user = User::findOrFail($id);

        $user->usuario = $request->input('usuario');
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->telefono = $request->input('telefono');

        $sexo = $request->input('sexo');
        if ($sexo === 'Masculino') $sexo = 'Masc';
        if ($sexo === 'Femenino')  $sexo = 'Fem';
        $user->sexo = $sexo;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('imagen_perfil') && $request->file('imagen_perfil')->isValid()) {
            $file = $request->file('imagen_perfil');

            $imagesDir = public_path('images');
            if (!is_dir($imagesDir)) {
                @mkdir($imagesDir, 0775, true);
            }

            $base = Str::slug(($user->nombre . '_' . $user->apellido) ?: 'avatar', '_');
            $ext = strtolower($file->getClientOriginalExtension()) ?: 'png';
            $imageName = time() . '_' . $base . '_' . Str::random(6) . '.' . $ext;

            $file->move($imagesDir, $imageName);

            if (!empty($user->imagen_perfil)) {
                $old = $user->imagen_perfil;
                $oldPath = \Illuminate\Support\Str::startsWith($old, 'images/')
                    ? public_path($old)
                    : public_path('images/' . ltrim($old, '/'));
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $user->imagen_perfil = $imageName;
        }

        $user->save();

        if (Auth::id() === $user->id) {
            Auth::setUser($user->fresh());
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * FUNCIONES DEL USUARIO
     */
    public function store(ClienteRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:clientes',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:clientes',
            'sexo' => 'required|string',
            'contrasena' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cliente = User::create([
            'usuario' => $request->usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'password' => bcrypt($request->contrasena),
        ]);

        Session::put('id', $cliente->id);
        return redirect()->route('LoginUser', ['success' => true]);
    }

    // VER MERCADO Y SUS PUESTOS
    public function mercado($id, Request $request)
    {
        $mercadoLocal = MercadoLocal::find($id);

        $query = Vendedor::where('fk_mercado', $id);
        if ($request->has('clasificacion') && $request->clasificacion !== 'todos') {
            $query->where('clasificacion', $request->clasificacion);
        }
        $vendedors = $query->paginate();

        return view('UserPuestosVendedores', compact('mercadoLocal', 'vendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
    }

    // VER VENDEDOR Y SUS PRODUCTOS
    public function vendedor($id)
    {
        $vendedor = Vendedor::find($id);
        if (!$vendedor) {
            return redirect()->back()->with('error', 'Vendedor no encontrado');
        }

        $mercadoLocal = $vendedor->mercadoLocal;
        $products = Product::where('fk_vendedors', $id)->paginate();

        return view('UserProductosDeUnPuesto', compact('vendedor', 'mercadoLocal', 'products'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    // VER EL PRODUCTO
    public function producto($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $products = Product::where('id', '!=', $id)
            ->where('fk_vendedors', $product->fk_vendedors)
            ->take(3)
            ->get();

        $vendedor = $product->vendedor;

        return view('UserProductoEnEspecifico', compact('product', 'products', 'vendedor'))->with('i', 0);
    }

    // AGREGAR AL CARRITO
    public function addcarrito(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'talla' => 'string|max:10',
        ]);

        $quantity = $request->input('quantity');
        $talla = $request->input('talla');

        $cartItem = Cart::where('fk_product', $product->id)
            ->where('fk_user', Auth::id())
            ->where('talla', $talla)
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
                'talla' => $talla,
                'subtotal' => $quantity * $product->price
            ]);
        }

        return redirect()->route('usuarios.carrito')->with('success', 'Producto agregado al carrito correctamente.');
    }

    /**
     * CHECKOUT (pago inmediato con tarjeta)
     * - Crea la reserva
     * - Mueve los ítems del carrito a reservation_items
     * - Descuenta stock
     * - Limpia carrito
     * - Redirige a usuarios.reservas
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para completar el pago');
        }

        DB::beginTransaction();
        try {
            // Traemos el carrito con las relaciones necesarias
            $cartItems = Cart::where('fk_user', Auth::id())
                ->with('product.vendedor')
                ->get();

            if ($cartItems->isEmpty()) {
                DB::rollBack();
                return redirect()->route('usuarios.carrito')->with('error', 'Su carrito está vacío. Agregue productos antes de pagar.');
            }

            // 1. Crear la reserva manualmente (sin ::create())
            $reservation = new Reservation();
            $reservation->fk_user = Auth::id();
            $reservation->total = 0;
            $reservation->estado = 'en_espera'; // existe la col "estado" en reservations :contentReference[oaicite:2]{index=2}
            $reservation->retiro = 'Entrada del Mercado'; // la migración pone default, pero lo seteamos igual :contentReference[oaicite:3]{index=3}
            $reservation->save();

            $total = 0;

            // 2. Por cada item del carrito creamos ReservationItem
            foreach ($cartItems as $item) {

                // Validar stock
                if ($item->product->stock < $item->quantity) {
                    DB::rollBack();
                    return redirect()->route('usuarios.carrito')
                        ->with('error', 'El producto ' . $item->product->name . ' no tiene suficiente stock disponible');
                }

                $resItem = new ReservationItem();
                $resItem->fk_reservation = $reservation->id;
                $resItem->fk_product     = $item->fk_product;
                $resItem->fk_vendedors   = $item->product->vendedor->id;
                $resItem->fk_mercados    = $item->product->vendedor->fk_mercado;
                $resItem->nombre         = $item->product->name;
                $resItem->precio         = $item->product->price;
                $resItem->quantity       = $item->quantity;
                $resItem->subtotal       = $item->subtotal;
                $resItem->estado         = 'en_espera'; // "estado" existe en reservation_items :contentReference[oaicite:4]{index=4}
                $resItem->save();

                // Descontar stock de producto
                $item->product->decrement('stock', $item->quantity);

                $total += $item->subtotal;
            }

            // 3. Actualizar total de la reserva
            $reservation->total = $total;
            $reservation->save();

            // 4. Vaciar carrito
            Cart::where('fk_user', Auth::id())->delete();

            DB::commit();

            // 5. Mandar al apartado de reservas del usuario
            return redirect()->route('usuarios.reservas')
                ->with('success', '¡Pago procesado! Tu reserva fue creada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Fallo de checkout:', [
                'user_id' => Auth::id(),
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('usuarios.carrito')->with('error', 'Ocurrió un error al procesar el pago.');
        }
    }

    /**
     * GUARDAR RESERVA (sin pago tarjeta, solo "Guardar Reserva")
     * - MISMA LÓGICA que checkout() pero sin validaciones de tarjeta
     * - NO descarga PDF
     * - Redirige directo a usuarios.reservas
     */
    public function reservar(Request $request)
    {
        DB::beginTransaction();
        try {
            // Traemos carrito con producto y vendedor
            $cartItems = Cart::where('fk_user', Auth::id())
                ->with('product.vendedor')
                ->get();

            if ($cartItems->isEmpty()) {
                DB::rollBack();
                return redirect()->route('usuarios.carrito')
                    ->with('error', 'No tienes productos en el carrito.');
            }

            // Crear reserva
            $reservation = new Reservation();
            $reservation->fk_user = Auth::id();
            $reservation->total = 0;
            $reservation->estado = 'en_espera';
            $reservation->retiro = 'Entrada del Mercado';
            $reservation->save();

            $total = 0;

            foreach ($cartItems as $item) {

                $resItem = new ReservationItem();
                $resItem->fk_reservation = $reservation->id;
                $resItem->fk_product     = $item->fk_product;
                $resItem->fk_vendedors   = $item->product->vendedor->id;
                $resItem->fk_mercados    = $item->product->vendedor->fk_mercado;
                $resItem->nombre         = $item->product->name;
                $resItem->precio         = $item->product->price;
                $resItem->quantity       = $item->quantity;
                $resItem->subtotal       = $item->subtotal;
                $resItem->estado         = 'en_espera';
                $resItem->save();

                $total += $item->subtotal;
            }

            $reservation->total = $total;
            $reservation->save();

            // Vaciar carrito
            Cart::where('fk_user', Auth::id())->delete();

            DB::commit();

            // Ir directo al panel de reservas del usuario
            return redirect()->route('usuarios.reservas')
                ->with('success', 'Tu reserva fue creada correctamente. Ya está en espera de los vendedores.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear la reserva:', [
                'user_id' => Auth::id(),
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('usuarios.carrito')
                ->with('error', 'Error interno al crear la reserva.');
        }
    }

    /**
     * IMPRIMIR RECIBO - DESCARGA DIRECTA (binario limpio)
     */
    public function generateReceipt($id)
    {
        $reservation = Reservation::with([
            'user',
            'items.product.vendedor.mercadoLocal',
        ])->findOrFail($id);

        $mercados = collect($reservation->items)
            ->map(function ($item) {
                return optional(optional($item->product)->vendedor)->mercadoLocal;
            })
            ->filter()
            ->unique('id')
            ->values();

        if (ob_get_length()) {
            @ob_end_clean();
        }

        $pdf = Pdf::loadView('receipt', [
            'reservation' => $reservation,
            'mercados' => $mercados,
        ])->setPaper('letter');

        $binary = $pdf->output();

        return response()->streamDownload(
            function () use ($binary) {
                echo $binary;
            },
            'recibo_reserva_' . $reservation->id . '.pdf',
            [
                'Content-Type' => 'application/pdf',
                'Cache-Control' => 'private, must-revalidate, max-age=0',
                'Pragma' => 'public',
                'Content-Disposition' => 'attachment; filename="recibo_reserva_' . $reservation->id . '.pdf"',
            ]
        );
    }

    /**
     * VER RECIBO EN EL NAVEGADOR (stream inline)
     */
    public function viewReceipt($id)
    {
        $reservation = Reservation::with([
            'user',
            'items.product.vendedor.mercadoLocal',
        ])->findOrFail($id);

        $mercados = collect($reservation->items)
            ->map(function ($item) {
                return optional(optional($item->product)->vendedor)->mercadoLocal;
            })
            ->filter()
            ->unique('id')
            ->values();

        if (ob_get_length()) {
            @ob_end_clean();
        }

        $pdf = Pdf::loadView('receipt', ['reservation' => $reservation, 'mercados' => $mercados])->setPaper('letter');
        $binary = $pdf->output();

        return response($binary, 200, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'private, must-revalidate, max-age=0',
            'Pragma' => 'public',
            'Content-Disposition' => 'inline; filename="recibo_reserva_' . $reservation->id . '.pdf"',
        ]);
    }

    public function carrito()
    {
        try {
            $userid = Auth::id();
            $cartItems = Cart::with('product')->where('fk_user', $userid)->get();
            $total = $cartItems->reduce(fn($carry, $item) => $carry + ($item->product->price * $item->quantity), 0);

            return view('UserCarritoGeneral', compact('cartItems', 'total', 'userid'));
        } catch (\Exception $e) {
            Log::error('Error en carrito: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error interno del servidor'], 500);
        }
    }

    public function reservas()
    {
        $reservations = Reservation::where('fk_user', Auth::id())
            ->with('items.product')
            ->get();

        return view('UserEstadoReservas', compact('reservations'));
    }

    public function historial()
    {
        $reservations = Reservation::where('fk_user', Auth::id())
            ->where('estado', 'archivado')
            ->with('items.product')
            ->get();

        return view('UserHistorialPedidos', compact('reservations'));
    }

    /**
     * CAMBIAR ESTADO RESERVAS (usuario)
     */
public function publicarestadoreserva(Request $request, $id)
{
    // Buscar el item de reserva al que se le dio "Confirmar Recepción"
    $item = ReservationItem::find($id);
    if (!$item) {
        return redirect()->route('usuarios.reservas')
            ->with('error', 'El ítem de la reserva no fue encontrado.');
    }

    // Seguridad: solo el dueño puede cambiar su estado
    if ($item->reservation->user->id != Auth::id()) {
        return redirect()->route('usuarios.reservas')
            ->with('error', 'No tienes permiso para actualizar este item.');
    }

    // Estado solicitado desde el form (por ejemplo "recibido")
    $nuevoEstado = $request->input('estado');

    // Estados válidos que dejamos que el usuario ponga manualmente
    $estadoValido = [
        'enviado',
        'sin_existencias',
        'en_espera',
        'sin_espera',
        'en_entrega',
        'recibido',
        'sin_recibir',
        'problemas',
        'archivado'
    ];

    if (!in_array($nuevoEstado, $estadoValido)) {
        return redirect()->route('usuarios.reservas')
            ->with('error', 'El estado proporcionado no es válido.');
    }

    // 1. Actualizar el estado del item actual
    $item->estado = $nuevoEstado;
    $item->save();

    $reservation = $item->reservation;
    $reservationId = $reservation->id;

    // 2. Si el usuario marcó este item como "recibido", vemos si YA RECIBIÓ TODO
    //    - Si TODOS los items de la misma reserva están recibidos (o ya archivados),
    //      entonces mandamos esa reserva al historial.
    if ($nuevoEstado === 'recibido') {

        // Traemos TODOS los items de esta reserva
        $itemsDeLaReserva = ReservationItem::where('fk_reservation', $reservationId)->get();

        // ¿Quedan pendientes? (pendiente = algo que NO está 'recibido' NI 'archivado')
        $quedanPendientes = $itemsDeLaReserva->contains(function ($it) {
            return !in_array($it->estado, ['recibido', 'archivado']);
        });

        if (!$quedanPendientes) {
            // ✅ Todos fueron recibidos -> archivamos la reserva completa

            // 2.a) Marcamos TODOS los items como 'archivado'
            foreach ($itemsDeLaReserva as $it) {
                $it->estado = 'archivado';
                $it->save();
            }

            // 2.b) Marcamos la reserva como 'archivado'
            $reservation->estado = 'archivado';
            $reservation->save();

            // 2.c) Y redirigimos directo al historial
            return redirect()->route('usuarios.historial')
                ->with('success', 'La reserva #' . $reservationId . ' ha sido archivada. ¡Gracias por tu compra!');
        }
    }

    // 3. Si todavía hay items pendientes en esa reserva:
    //    volvemos a "Mis Reservas" normal.
    return redirect()->route('usuarios.reservas')
        ->with('success', 'Estado actualizado correctamente.');
}


    public function eliminarcarrito(Product $product)
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
