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
use Illuminate\Support\Str;

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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class AdminController
 * @package App/Http/Controllers
 */
class AdminController extends Controller
{
    /** ---------------------------
     *  MERCADOS LOCALES
     *  ---------------------------
     */
    public function index()
    {
        $id = 1;
        $mercadoLocals = MercadoLocal::paginate();
        $vendedors = Vendedor::paginate();
        $clientes = User::where('id', $id)->get();

        return view('AdminHome', compact('mercadoLocals', 'vendedors', 'clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $mercadoLocals->perPage());
    }

    public function crearmercados()
    {
        $mercadoLocal = new MercadoLocal();
        return view('AdminAgregarMercado', compact('mercadoLocal'));
    }

    public function guardarmercados(MercadoLocalRequest $request)
    {
        // Validación sin municipio/ubicación/horas
        $request->validate([
            'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'nombre'            => 'required|string|max:255',
            'descripcion'       => 'required|string|max:500',
        ]);

        $nombreLimpio = str_replace(' ', '', $request->nombre);
        $usuario  = strtolower($nombreLimpio) . '@minishop.sv';
        $password = '1' . strtolower($nombreLimpio) . '!';

        $mercadolocal = new MercadoLocal();
        $mercadolocal->usuario          = $usuario;
        $mercadolocal->password         = Hash::make($password);
        $mercadolocal->nombre           = $request->nombre;
        $mercadolocal->descripcion      = $request->descripcion;

        // Imagen (solo si se adjunta)
        if ($request->hasFile('imagen_referencia')) {
            $imageName = str_replace(' ', '_', strtolower($request->nombre)) . '.png';
            $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);
            $mercadolocal->imagen_referencia = $imageName;
        }

        $mercadolocal->save();

        return redirect()->route('admin.index')->with([
            'usuario'  => $usuario,
            'password' => $password,
            'nombre'   => $mercadolocal->nombre,
        ]);
    }

    public function vermercados($id, Request $request)
    {
        $mercadoLocal = MercadoLocal::find($id);
        // Sin filtro por clasificación
        $vendedors = Vendedor::where('fk_mercado', $id)->get();

        return view('AdminMercadoEspecifico', compact('mercadoLocal', 'vendedors'));
    }

    public function editarmercados($id)
    {
        $mercadoLocal = MercadoLocal::find($id);
        return view('AdminEditarMercado', compact('mercadoLocal'));
    }

    public function actualizarmercados(Request $request, $id)
    {
        // Buscar el mercado
        $mercadoLocal = MercadoLocal::findOrFail($id);

        // Validar los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'nueva_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar campos básicos
        $mercadoLocal->nombre = $validated['nombre'];
        $mercadoLocal->descripcion = $validated['descripcion'];

        // Manejar imagen
        if ($request->hasFile('nueva_imagen')) {
            $image = $request->file('nueva_imagen');
            $imageName = time() . '_' . str_replace(' ', '_', strtolower($mercadoLocal->nombre)) . '.' . $image->extension();
            $image->move(public_path('imgs'), $imageName);

            // Eliminar imagen anterior si existe
            if ($mercadoLocal->imagen_referencia && file_exists(public_path('imgs/' . $mercadoLocal->imagen_referencia))) {
                @unlink(public_path('imgs/' . $mercadoLocal->imagen_referencia));
            }

            $mercadoLocal->imagen_referencia = $imageName;
        }

        // Guardar cambios
        $mercadoLocal->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.index') ->with('success', 'Mercado Local actualizado con éxito');
    }


    public function eliminarmercados($id)
    {
        MercadoLocal::find($id)?->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Mercado Local eliminado correctamente');
    }

    /** ---------------------------
     *  VENDEDORES
     *  ---------------------------
     */
    public function vendedores()
    {
        $vendedors = Vendedor::paginate();
        return view('AdminListadoVendedores', compact('vendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
    }

    public function crearvendedores()
    {
        $vendedor = new Vendedor();
        $mercados = MercadoLocal::all();
        return view('AdminRegistrarVendedor', compact('vendedor', 'mercados'));
    }

    public function guardarvendedores(VendedorRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario'             => 'required|email|unique:vendedors,usuario',
            'imagen_de_referencia'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre'              => 'required|string|max:255',
            'nombre_del_local'    => 'required|string|max:255',
            'apellidos'           => 'required|string|max:255',
            'telefono'            => 'required|string|max:20|unique:vendedors,telefono',
            'numero_puesto'       => 'required|integer|min:1',
            'password'            => 'required|string|min:8|confirmed',
            'fk_mercado'          => 'required|exists:mercado_locals,id',
        ], [
            'password.min'        => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'  => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Unicidad de puesto dentro del mismo mercado
        if (Vendedor::where('fk_mercado', $request->fk_mercado)
                ->where('numero_puesto', $request->numero_puesto)
                ->exists()) {
            return back()->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Número de Puesto en este Mercado.');
        }

        $vendedor = new Vendedor();
        $vendedor->usuario          = $request->usuario;
        $vendedor->nombre           = $request->nombre;
        $vendedor->nombre_del_local = $request->nombre_del_local;
        $vendedor->apellidos        = $request->apellidos;
        $vendedor->telefono         = $request->telefono;
        $vendedor->numero_puesto    = $request->numero_puesto;
        $vendedor->fk_mercado       = $request->fk_mercado;
        $vendedor->password         = Hash::make($request->password);

        if ($request->hasFile('imagen_de_referencia')) {
            $file = $request->file('imagen_de_referencia');
            $imageName = str_replace(' ', '_', $request->nombre . '_' . $request->nombre_del_local) . '.png';
            $file->move(public_path('imgs'), $imageName);
            $vendedor->imagen_de_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor creado exitosamente.');
    }

    public function vervendedores($id)
    {
        $vendedor = Vendedor::find($id);
        if (!$vendedor) {
            return back()->with('error', 'Vendedor no encontrado');
        }

        $mercadoLocal = $vendedor->mercadoLocal;
        $products = Product::where('fk_vendedors', $id)->paginate();

        return view('AdminPuestosDelMercado', compact('vendedor', 'mercadoLocal', 'products'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    public function editarvendedores($id)
    {
        $vendedor = Vendedor::find($id);
        $mercados = MercadoLocal::all();
        return view('AdminEditarVendedor', compact('vendedor', 'mercados'));
    }

    public function actualizarvendedor(Request $request, $id)
    {
        // Validación SIN ROL
        $request->validate([
            'usuario'   => ['required','email','max:255', Rule::unique('vendedors','usuario')->ignore($id)],
            'password'  => 'nullable|string|min:8|confirmed',
            'nombre'    => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono'  => ['required','string','max:255', Rule::unique('vendedors','telefono')->ignore($id)],
            'fk_mercado'=> ['required','integer', Rule::exists('mercado_locals','id')],
            'numero_puesto' => [
                'required','integer','min:1',
                Rule::unique('vendedors','numero_puesto')
                    ->ignore($id)
                    ->where(fn($q) => $q->where('fk_mercado', $request->fk_mercado)),
            ],
            'imagen_de_referencia' => 'nullable|image|max:2048',
        ]);

        $vendedor = Vendedor::findOrFail($id);

        // Campos base (sin tocar ROL)
        $vendedor->usuario          = $request->input('usuario');
        $vendedor->nombre           = $request->input('nombre');
        $vendedor->nombre_del_local = $request->input('nombre_del_local');
        $vendedor->apellidos        = $request->input('apellidos');
        $vendedor->telefono         = $request->input('telefono');
        $vendedor->numero_puesto    = $request->input('numero_puesto');
        $vendedor->fk_mercado       = $request->input('fk_mercado');

        // Password solo si se envía
        if ($request->filled('password')) {
            $vendedor->password = Hash::make($request->input('password'));

            // Si reflejas credenciales en tabla users (opcional):
            // User::where('usuario', $vendedor->usuario)->update([
            //     'usuario'  => $request->input('usuario'),
            //     'password' => $vendedor->password,
            // ]);
        }

        // Imagen solo si se adjunta
        if ($request->hasFile('imagen_de_referencia')) {
            $image = $request->file('imagen_de_referencia');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('imgs'), $imageName);

            if ($vendedor->imagen_de_referencia && file_exists(public_path('imgs/' . $vendedor->imagen_de_referencia))) {
                @unlink(public_path('imgs/' . $vendedor->imagen_de_referencia));
            }

            $vendedor->imagen_de_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor actualizado correctamente.');
    }

    public function eliminarvendedores($id)
    {
        $vendedor = Vendedor::find($id);

        if ($vendedor) {
            // Cuidado: solo borra en users si es exactamente el mismo usuario
            User::where('usuario', $vendedor->usuario)->delete();
            $vendedor->delete();
        }

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor eliminado exitosamente.');
    }

    /** ---------------------------
     *  CLIENTES
     *  ---------------------------
     */
    public function clientes()
    {
        $clientes = User::where('id', '!=', 1)->paginate();

        return view('AdminListadoClientes', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    public function eliminarclientes($id)
    {
        User::find($id)?->delete();

        return redirect()->route('admin.clientes')
            ->with('success', 'Cliente eliminado correctamente');
    }

    /** ---------------------------
     *  PRODUCTO
     *  ---------------------------
     */
    public function verproducto($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return back()->with('error', 'Producto no encontrado.');
        }

        $vendedor = $product->vendedor;
        $products = Product::where('fk_vendedors', $product->fk_vendedors)
            ->where('id', '!=', $id)
            ->paginate();

        return view('AdminProductoEspecifico', compact('product', 'products', 'vendedor'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }
}
