<?php

namespace App\Http\Controllers;

use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ReservationItem;
use Illuminate\Http\Request;
use App\Http\Requests\VendedorRequest;
use Illuminate\Support\Facades\Auth;

class VendedoresController extends Controller
{
    /* ========== DASHBOARD & PERFIL ========== */
    public function index()
    {
        if (!Auth::guard('vendedor')->check()) {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $vendedor     = Auth::guard('vendedor')->user();
        $mercadoLocal = $vendedor->mercadoLocal;
        $products     = Product::where('fk_vendedors', $vendedor->id)->get();

        return view('VendedorHome', compact('vendedor', 'products', 'mercadoLocal'));
    }

    public function perfil()
    {
        if (!Auth::guard('vendedor')->check()) {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $vendedor     = Auth::guard('vendedor')->user();
        $mercadoLocal = $vendedor->mercadoLocal;
        $products     = Product::where('fk_vendedors', $vendedor->id)->get();

        return view('VendedorProfileVista', compact('vendedor', 'products', 'mercadoLocal'));
    }

    /* ========== EDITAR PUESTO ========== */
    public function editar($id)
    {
        if (Auth::guard('vendedor')->id() != $id) {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $vendedor = Vendedor::findOrFail($id);
        $mercados = MercadoLocal::all();

        return view('VendedorEditarPuesto', compact('vendedor', 'mercados'));
    }

    public function actualizar(VendedorRequest $request, $id)
    {
        $request->validate([
            'usuario' => 'required|email|unique:vendedors,usuario,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'nombre' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'imagen_de_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'clasificacion' => 'nullable|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'numero_puesto' => 'nullable|integer|unique:vendedors,numero_puesto,' . $id,
            'fk_mercado' => 'nullable|exists:mercado_locals,id',
        ]);

        if (Auth::guard('vendedor')->id() != $id) {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $vendedor = Vendedor::findOrFail($id);

        $vendedor->usuario = $request->input('usuario');
        //$vendedor->ROL = $request->input('ROL');
        $vendedor->nombre = $request->input('nombre');
        $vendedor->apellidos = $request->input('apellidos');
        $vendedor->telefono = $request->input('telefono');
        $vendedor->nombre_del_local = $request->input('nombre_del_local');
        $vendedor->clasificacion = $request->input('clasificacion');
        $vendedor->numero_puesto = $request->input('numero_puesto');
        $vendedor->fk_mercado = $request->input('fk_mercado');

        if ($request->filled('password')) {
            $vendedor->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('imagen_de_referencia')) {
            $imageName = time() . '.' . $request->imagen_de_referencia->extension();
            $request->imagen_de_referencia->move(public_path('imgs'), $imageName);

            if ($vendedor->imagen_de_referencia && file_exists(public_path('imgs/' . $vendedor->imagen_de_referencia))) {
                unlink(public_path('imgs/' . $vendedor->imagen_de_referencia));
            }

            $vendedor->imagen_de_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->back()->with('success', 'Datos del vendedor actualizados correctamente.');
    }

    /* ========== PRODUCTOS (LISTAR / VER) ========== */
    public function productos()
    {
        $vendedor  = Auth::guard('vendedor')->user();
        $productos = Product::where('fk_vendedors', $vendedor->id)->get();

        return view('VendedorMisProductos', compact('productos', 'vendedor'));
    }

    public function verproducto($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        if ($product->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para ver este producto.');
        }

        $vendedor = $product->vendedor;
        $products = Product::where('fk_vendedors', $product->fk_vendedors)
            ->where('id', '!=', $id)
            ->paginate(3);

        return view('VendedorProductoEnEspecifico', compact('product', 'products', 'vendedor'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    /* ========== PRODUCTOS (CREAR) ========== */
    public function agregarproducto($id = null)
    {
        // $id es opcional para tolerar rutas con o sin {id}
        $vendedor = Auth::guard('vendedor')->user();
        $product  = new Product();

        return view('VendedorRegistroProducto', compact('product', 'vendedor'));
    }

    public function guardarproducto(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'required|string|max:200',
            'imagen_referencia'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price_type'           => 'required|in:fixed,per_dollar',
            'price'                => 'nullable|numeric|min:0|required_if:price_type,fixed',
            'quantity_per_dollar'  => 'nullable|integer|min:1|required_if:price_type,per_dollar',
        ], [
            'name.required'                    => 'Campo obligatorio',
            'description.required'             => 'Campo obligatorio',
            'imagen_referencia.required'       => 'Campo obligatorio',
            'price_type.required'              => 'Selecciona el tipo de precio',
            'price.required_if'                => 'Debes ingresar el precio cuando es definido',
            'quantity_per_dollar.required_if'  => 'Debes ingresar la cantidad por dólar',
        ]);

        // Imagen -> public/imgs
        $nombreProducto = str_replace(' ', '_', strtolower($validated['name']));
        $ext            = $request->file('imagen_referencia')->getClientOriginalExtension() ?: 'png';
        $imageName      = "{$nombreProducto}.{$ext}";
        $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

        // Precio según tipo
        $price = null;
        $quantityPerDollar = null;

        if ($validated['price_type'] === 'fixed') {
            $price = round((float) $validated['price'], 2);
        } else {
            $quantityPerDollar = (int) $validated['quantity_per_dollar'];
            $price = round(1 / max($quantityPerDollar, 1), 2);
        }

        $vendedor = Auth::guard('vendedor')->user();

        $producto = new Product([
            'name'                => $validated['name'],
            'description'         => $validated['description'],
            'price_type'          => $validated['price_type'],
            'price'               => $price,
            'quantity_per_dollar' => $quantityPerDollar, // null si fixed
            'estado'              => 'Disponible',
            'fk_vendedors'        => $vendedor->id,
            'imagen_referencia'   => $imageName,
        ]);

        $producto->save();

        return redirect()->route('vendedores.productos')->with('success', 'Producto registrado exitosamente.');
    }

    /* ========== PRODUCTOS (EDITAR / ACTUALIZAR) ========== */
    public function editarproducto($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        if ($producto->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este producto.');
        }

        $vendedor = Auth::guard('vendedor')->user();

        return view('VendedorEditarProducto', compact('producto', 'vendedor'));
    }

    public function actualizarproducto(Request $request, $id)
    {
        $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'nullable|string|max:200',
            'price_type'           => 'required|string|in:fixed,per_dollar',
            'price'                => 'nullable|numeric|min:0|required_if:price_type,fixed',
            'quantity_per_dollar'  => 'nullable|integer|min:1|required_if:price_type,per_dollar',
            'imagen_referencia'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'estado'               => 'nullable|string|max:50',
        ]);

        $producto = Product::findOrFail($id);

        if ($producto->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para actualizar este producto.');
        }

        // Imagen en public/imgs
        if ($request->hasFile('imagen_referencia')) {
            if ($producto->imagen_referencia && file_exists(public_path('imgs/' . $producto->imagen_referencia))) {
                @unlink(public_path('imgs/' . $producto->imagen_referencia));
            }

            $nombreProducto = str_replace(' ', '_', strtolower($request->input('name')));
            $ext            = $request->file('imagen_referencia')->getClientOriginalExtension() ?: 'png';
            $imageName      = "{$nombreProducto}.{$ext}";
            $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

            $producto->imagen_referencia = $imageName;
        }

        // Campos base
        $producto->name        = $request->input('name');
        $producto->description = $request->input('description');
        $producto->price_type  = $request->input('price_type');
        $producto->estado      = $request->input('estado', $producto->estado ?? 'Disponible');

        // Precio según tipo
        if ($producto->price_type === 'fixed') {
            $producto->price = round((float) $request->input('price'), 2);
            $producto->quantity_per_dollar = null;
        } else {
            $qty = (int) $request->input('quantity_per_dollar');
            if ($qty <= 0) {
                return back()->with('error', 'La cantidad por dólar debe ser mayor que 0.')->withInput();
            }
            $producto->quantity_per_dollar = $qty;
            $producto->price = round(1 / $qty, 2);
        }

        $producto->save();

        return redirect()->route('vendedores.productos')->with('success', 'Producto actualizado exitosamente.');
    }

    /* ========== PRODUCTOS (ELIMINAR) ========== */
    public function eliminarproducto($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return redirect()->route('vendedores.productos')->with('error', 'Producto no encontrado.');
        }

        if ($producto->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este producto.');
        }

        if ($producto->imagen_referencia && file_exists(public_path('imgs/' . $producto->imagen_referencia))) {
            @unlink(public_path('imgs/' . $producto->imagen_referencia));
        }

        $producto->delete();

        return redirect()->route('vendedores.productos')->with('success', 'Producto eliminado correctamente.');
    }

    /* ========== RESERVAS / HISTORIAL ========== */
    public function reservas()
    {
        $vendedor = Auth::guard('vendedor')->user();

        $reservations = Reservation::whereHas('items.product.vendedor', function ($query) use ($vendedor) {
                $query->where('fk_vendedors', $vendedor->id);
            })
            ->with(['items' => function ($query) use ($vendedor) {
                $query->where('fk_vendedors', $vendedor->id)->with('product.vendedor');
            }])
            ->get();

        return view('VendedorEstadoReservas', compact('reservations', 'vendedor'));
    }

    public function publicarestadoreserva(Request $request, $id)
    {
        $item = ReservationItem::find($id);
        if (!$item) {
            return redirect()->route('vendedores.reservas')->with('error', 'El ítem de la reserva no fue encontrado.');
        }

        if ($item->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->route('vendedores.reservas')->with('error', 'No tienes permiso para actualizar este item.');
        }

        $estadoValido = [
            'enviado', 'sin_existencias', 'en_espera', 'sin_espera',
            'en_entrega', 'recibido', 'sin_recibir', 'problemas', 'archivado'
        ];
        $nuevoEstado  = $request->input('estado');

        if (!in_array($nuevoEstado, $estadoValido)) {
            return redirect()->route('vendedores.reservas')->with('error', 'El estado proporcionado no es válido.');
        }

        $item->estado = $nuevoEstado;
        $item->save();

        $fk_reservation = $item->fk_reservation;

        $todosEnEstado = function ($estado) use ($fk_reservation) {
            return ReservationItem::where('fk_reservation', $fk_reservation)
                ->where('estado', '!=', $estado)
                ->count() == 0;
        };

        if ($todosEnEstado('en_entrega')) {
            $reserva = Reservation::find($fk_reservation);
            $reserva->estado = 'en_entrega';
            $reserva->save();
        }
        if ($todosEnEstado('sin_existencias')) {
            $reserva = Reservation::find($fk_reservation);
            $reserva->estado = 'sin_existencias';
            $reserva->save();
        }
        if ($todosEnEstado('en_espera')) {
            $reserva = Reservation::find($fk_reservation);
            $reserva->estado = 'en_espera';
            $reserva->save();
        }
        if ($todosEnEstado('sin_espera')) {
            $reserva = Reservation::find($fk_reservation);
            $reserva->estado = 'sin_espera';
            $reserva->save();
        }
        if ($todosEnEstado('archivado')) {
            $reserva = Reservation::find($fk_reservation);
            $reserva->estado = 'archivado';
            $reserva->save();
        }

        return redirect()->route('vendedores.reservas')->with('success', 'El estado de la reserva ha sido actualizado.');
    }

    public function historial()
    {
        $vendedor = Auth::guard('vendedor')->user();

        $reservations = Reservation::whereHas('items', function ($query) use ($vendedor) {
                $query->where('fk_vendedors', $vendedor->id);
            })
            ->with(['items' => function ($query) use ($vendedor) {
                $query->where('fk_vendedors', $vendedor->id)->with('product.vendedor');
            }])
            ->get();

        return view('VendedorHistorialReservas', compact('reservations', 'vendedor'));
    }

    public function eliminarreservationitem($id)
    {
        $reservationItem = ReservationItem::find($id);

        if (!$reservationItem) {
            return redirect()->route('vendedores.reservas')->with('error', 'Ítem de reserva no encontrado.');
        }

        $reservation = $reservationItem->reservation;
        $reservationItem->delete();

        if ($reservation && $reservation->items()->count() === 0) {
            $reservation->delete();
        }

        return redirect()->route('vendedores.reservas')->with('success', 'Ítem de reserva eliminado correctamente.');
    }
}
