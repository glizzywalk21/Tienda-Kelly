<?php

namespace App\Http\Controllers;

//modelos
use App\Models\User;
use App\Models\Clientes;
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
use App\Http\Requests\ReservationItemRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class VendedoresController
 * @package App/Http/Controllers
 */

class VendedoresController extends Controller{

    public function index()
    {
        // Verificar si el usuario autenticado es un vendedor
        if (Auth::guard('vendedor')->check()) {
            // Obtener el vendedor autenticado desde el guard 'vendedor'
            $vendedor = Auth::guard('vendedor')->user();

            // Obtener la información del mercado local relacionado con el vendedor
            $mercadoLocal = $vendedor->mercadoLocal;

            // Obtener los productos del vendedor autenticado
            $products = Product::where('fk_vendedors', $vendedor->id)->get();

            // Retornar la vista con los datos del vendedor, productos y mercado local
            return view('VendedorHome', compact('vendedor', 'products', 'mercadoLocal'));
        }

        // Si el usuario no es un vendedor, se puede redirigir o manejar el error
        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    public function perfil()
    {
        if (Auth::guard('vendedor')->check()) {
            // Obtener el vendedor autenticado desde el guard 'vendedor'
            $vendedor = Auth::guard('vendedor')->user();

            // Obtener la información del mercado local relacionado con el vendedor
            $mercadoLocal = $vendedor->mercadoLocal;

            // Obtener los productos del vendedor autenticado
            $products = Product::where('fk_vendedors', $vendedor->id)->get();

            // Retornar la vista con los datos del vendedor, productos y mercado local
            return view('VendedorProfileVista', compact('vendedor', 'products', 'mercadoLocal'));
        }

        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    public function editar($id)
    {
        // Verificar si el vendedor autenticado puede editar este registro
        if (Auth::guard('vendedor')->id() == $id) {
            $vendedor = Vendedor::find($id);
            $mercados = MercadoLocal::all();
            return view('VendedorEditarPuesto', compact('vendedor', 'mercados'));
        }

        return redirect()->route('login')->with('error', 'Acceso no autorizado');
    }

    public function actualizar(VendedorRequest $request, $id)
    {
        $request->validate([
            'password' => 'nullable|string|min:8|confirmed',
            'nombre' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'imagen_de_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'clasificacion' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'numero_puesto' => 'required|integer|unique:vendedors,numero_puesto,' . $id,
            'fk_mercado' => 'required|exists:mercado_locals,id',
        ]);

        // Verificar si el vendedor autenticado puede actualizar este registro
        if (Auth::guard('vendedor')->id() != $id) {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        // Encontrar el vendedor por ID
        $vendedor = Vendedor::findOrFail($id);

        // Actualizar los campos
        $vendedor->usuario = $request->input('usuario');
        $vendedor->ROL = $request->input('ROL');

        // Si la contraseña se envía, actualiza, de lo contrario, deja la existente
        if ($request->filled('password')) {
            $vendedor->password = bcrypt($request->input('password'));
        }

        $vendedor->nombre = $request->input('nombre');
        $vendedor->nombre_del_local = $request->input('nombre_del_local');
        $vendedor->clasificacion = $request->input('clasificacion');
        $vendedor->apellidos = $request->input('apellidos');
        $vendedor->telefono = $request->input('telefono');
        $vendedor->numero_puesto = $request->input('numero_puesto');
        $vendedor->fk_mercado = $request->input('fk_mercado');

        // Manejar la imagen de referencia
        if ($request->hasFile('imagen_de_referencia')) {
            // Guardar la imagen
            $imageName = time() . '.' . $request->imagen_de_referencia->extension();
            $request->imagen_de_referencia->move(public_path('imgs'), $imageName);

            // Eliminar la imagen antigua si existe
            if ($vendedor->imagen_de_referencia && file_exists(public_path('imgs/' . $vendedor->imagen_de_referencia))) {
                unlink(public_path('imgs/' . $vendedor->imagen_de_referencia));
            }

            // Actualizar la referencia en la base de datos
            $vendedor->imagen_de_referencia = $imageName;
        }

        // Guardar los cambios en la base de datos
        $vendedor->save();

        // Redireccionar o devolver una respuesta
        return redirect()->route('vendedores.index')->with('success', 'Vendedor actualizado correctamente.');
    }

    public function productos()
    {
        $vendedor = Auth::guard('vendedor')->user(); // Obtener el vendedor autenticado

        // Obtener todos los productos que pertenecen al vendedor autenticado
        $productos = Product::where('fk_vendedors', $vendedor->id)->get();

        // Pasar los productos a la vista para su visualización
        return view('VendedorMisProductos', compact('productos', 'vendedor'));
    }

    public function verproducto($id)
    {
        $product = Product::find($id);

        // Verificar si el producto existe antes de proceder
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Verificar si el vendedor autenticado es el propietario del producto
        if ($product->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para ver este producto.');
        }

        // Obtener el vendedor del producto
        $vendedor = $product->vendedor;

        // Obtener los productos que comparten la misma llave foránea del vendedor,
        // pero excluyendo el producto actual
        $products = Product::where('fk_vendedors', $product->fk_vendedors)
            ->where('id', '!=', $id)
            ->paginate(3);

        // Retornar la vista con los datos del producto y otros productos del mismo vendedor
        return view('VendedorProductoEnEspecifico', compact('product', 'products', 'vendedor'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    public function agregarproducto()
    {
        $vendedor = Auth::guard('vendedor')->user(); // Obtener el vendedor autenticado
        $product = new Product();

        return view('VendedorRegistroProducto', compact('product', 'vendedor'));
    }

    public function guardarproducto(Request $request)
    {
        // Definir las reglas de validación iniciales
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:200',
            'imagen_referencia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'clasificacion' => 'required|string',
        ];

        // Definir mensajes de error personalizados
        $messages = [
            'name.required' => 'Campo obligatorio',
            'description.required' => 'Campo obligatorio',
            'imagen_referencia.required' => 'Campo obligatorio',
            'clasificacion.required' => 'Campo obligatorio',
        ];

        // Validar los datos del formulario
        $validatedData = $request->validate($rules, $messages);

        // Manejar la imagen del producto
        if ($request->hasFile('imagen_referencia')) {
            $nombreProducto = str_replace(' ', '_', strtolower($request->input('name')));
            $clasificacion = str_replace(' ', '_', strtolower($request->input('clasificacion')));
            $imageName = "{$nombreProducto}_{$clasificacion}.png";

            $path = $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

            if (!$path) {
                return back()->withErrors(['imagen_referencia' => 'No se pudo mover la imagen.'])->withInput();
            }
        } else {
            return back()->withErrors(['imagen_referencia' => 'Es obligatorio subir una imagen.'])->withInput();
        }

        // Determinar el precio en base al tipo de precio
        $priceType = $request->input('price_type');
        $price = $request->input('price');
        $quantity = $request->input('quantity', 1);

        if ($priceType === 'per_dollar') {
            $price = 1 / max($quantity, 1); // Asegurarse de que la cantidad sea al menos 1
        }

        // Crear y guardar el producto
        $vendedor = Auth::guard('vendedor')->user();
        $producto = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $price,
            'clasificacion' => $request->input('clasificacion'),
            'estado' => 'Disponible',
            'fk_vendedors' => $vendedor->id,
            'imagen_referencia' => $imageName,
        ]);

        $producto->save();

        return redirect()->route('vendedores.productos')->with('success', 'Producto registrado exitosamente.');
    }






    public function editarproducto($id)
    {
        $producto = Product::find($id);

        // Verificar si el producto existe antes de proceder
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Verificar si el vendedor autenticado es el propietario del producto
        if ($producto->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este producto.');
        }

        $vendedor = Auth::guard('vendedor')->user(); // Obtener el vendedor autenticado

        return view('VendedorEditarProducto', compact('producto', 'vendedor'));
    }

    public function actualizarproducto(ProductRequest $request, $id)
{
    // Validación de los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:200',
        'price_type' => 'required|string|in:fixed,per_dollar',
        'price' => 'nullable|numeric|required_if:price_type,fixed',
        'quantity_per_dollar' => 'nullable|integer|required_if:price_type,per_dollar',
        'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'clasificacion' => 'required|string',
        'estado' => 'nullable|string',
    ]);

    $producto = Product::findOrFail($id);

    // Verificar si el vendedor autenticado es el propietario del producto
    if ($producto->fk_vendedors != Auth::guard('vendedor')->id()) {
        return redirect()->back()->with('error', 'No tienes permiso para actualizar este producto.');
    }

    // Manejo de la imagen
    if ($request->hasFile('imagen_referencia')) {
        // Eliminar la imagen anterior si existe
        if ($producto->imagen_referencia) {
            Storage::disk('public')->delete('imgs/' . $producto->imagen_referencia);
        }

        try {
            // Crear el nombre de la imagen basado en el nombre y la categoría
            $imageName = $request->input('name') . '_' . $request->input('clasificacion') . '.png';
            $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

            $producto->imagen_referencia = $imageName;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
        }
    }

    // Actualizar los campos del producto
    $producto->name = $request->input('name');
    $producto->description = $request->input('description');
    $producto->price_type = $request->input('price_type');

    if ($producto->price_type === 'fixed') {
        $producto->price = $request->input('price');
        $producto->quantity_per_dollar = null;
    } else {
        $producto->price = null;
        $producto->quantity_per_dollar = $request->input('quantity_per_dollar');
    }

    $producto->clasificacion = $request->input('clasificacion');
    $producto->estado = $request->input('estado', 'disponible');

    // Guardar cambios
    if (!$producto->save()) {
        return redirect()->back()->with('error', 'Error al actualizar el producto.');
    }

    return redirect()->route('vendedores.productos')->with('success', 'Producto actualizado exitosamente.');
}


    public function eliminarproducto($id)
    {
        $producto = Product::find($id);

        // Verificar si el vendedor autenticado es el propietario del producto
        if ($producto->fk_vendedors != Auth::guard('vendedor')->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este producto.');
        }

        if ($producto) {
            $producto->delete();
            return redirect()->route('vendedores.productos')->with('success', 'Producto eliminado correctamente.');
        } else {
            return redirect()->route('vendedores.productos')->with('error', 'Producto no encontrado.');
        }
    }

    public function reservas()
    {
        $vendedor = Auth::guard('vendedor')->user(); // Obtener el vendedor autenticado

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

        $estadoValido = ['enviado', 'sin_existencias', 'en_espera', 'sin_espera', 'en_entrega', 'recibido', 'sin_recibir', 'problemas', 'archivado'];
        $nuevoEstado = $request->input('estado');

        if (in_array($nuevoEstado, $estadoValido)) {
            $item->estado = $nuevoEstado;
            $item->save();

            $fk_reservation = $item->fk_reservation;
            $todosEnEstado = function($estado) use ($fk_reservation) {
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
        } else {
            return redirect()->route('vendedores.reservas')->with('error', 'El estado proporcionado no es válido.');
        }
    }

    public function historial()
    {
        $vendedor = Auth::guard('vendedor')->user(); // Obtener el vendedor autenticado

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
    // Encuentra el ReservationItem por su ID
    $reservationItem = ReservationItem::find($id);

    if ($reservationItem) {
        // Obtén la reserva asociada
        $reservation = $reservationItem->reservation;

        // Elimina el ReservationItem
        $reservationItem->delete();

        // Verifica si la reserva está vacía
        if ($reservation->items()->count() === 0) {
            // Si no tiene más items, elimina la Reservation
            $reservation->delete();
        }
        // Redirige a la vista de vendedores.reservas con un mensaje de éxito
        return redirect()->route('vendedores.reservas')->with('success', 'Reservation item deleted successfully.');
    }

    // Si el item no fue encontrado, redirige con un mensaje de error
    return redirect()->route('vendedores.reservas')->with('error', 'Reservation item not found.');
}

}
