<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

    public function guardarmercados(Request $request)
    {
        $request->validate([
            'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'email' => 'required|email|unique:mercado_locals,usuario',
            'password' => 'required|string|min:6',
        ]);

        $mercadolocal = new MercadoLocal();
        $mercadolocal->nombre = $request->nombre;
        $mercadolocal->descripcion = $request->descripcion;
        $mercadolocal->usuario = $request->email;
        $mercadolocal->password = Hash::make($request->password);

        // Subir imagen a /public/images
        if ($request->hasFile('imagen_referencia')) {
            $image = $request->file('imagen_referencia');
            $dir = public_path('images');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $imageName = time() . '_' . str_replace(' ', '_', strtolower($request->nombre)) . '.' . $image->extension();
            $image->move($dir, $imageName);
            $mercadolocal->imagen_referencia = $imageName;
        }

        $mercadolocal->save();

        return redirect()->route('admin.index')->with([
            'success' => 'Mercado registrado correctamente',
            'usuario' => $request->email,
            'password' => $request->password,
            'nombre' => $mercadolocal->nombre,
        ]);
    }

    public function vermercados($id)
    {
        $mercadoLocal = MercadoLocal::find($id);
        $vendedors = Vendedor::where('fk_mercado', $id)->get();

        return view('AdminMercadoEspecifico', compact('mercadoLocal', 'vendedors'));
    }

    public function editarmercados($id)
    {
        $mercadoLocal = MercadoLocal::findOrFail($id);
        return view('AdminEditarMercado', compact('mercadoLocal'));
    }

    public function actualizarmercados(Request $request, $id)
    {
        Log::info('[ADMIN] actualizarmercados', ['id' => $id, 'payload' => $request->all()]);

        $mercadoLocal = MercadoLocal::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'nueva_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar texto
        $mercadoLocal->nombre = $validated['nombre'];
        $mercadoLocal->descripcion = $validated['descripcion'];

        // Imagen (opcional) -> /public/images
        if ($request->hasFile('nueva_imagen')) {
            $image = $request->file('nueva_imagen');

            $dir = public_path('images');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $imageName = time() . '_' . str_replace(' ', '_', strtolower($mercadoLocal->nombre)) . '.' . $image->extension();
            $image->move($dir, $imageName);

            if ($mercadoLocal->imagen_referencia && File::exists(public_path('images/' . $mercadoLocal->imagen_referencia))) {
                @unlink(public_path('images/' . $mercadoLocal->imagen_referencia));
            }

            $mercadoLocal->imagen_referencia = $imageName;
        }

        $mercadoLocal->save();

        Log::info('[ADMIN] Mercado actualizado', [
            'id' => $mercadoLocal->id,
            'nombre' => $mercadoLocal->nombre,
            'descripcion' => $mercadoLocal->descripcion,
            'imagen_referencia' => $mercadoLocal->imagen_referencia,
        ]);

        return redirect()->route('admin.index')->with('success', 'Mercado Local actualizado con éxito');
    }

    public function eliminarmercados($id)
    {
        $registro = MercadoLocal::find($id);
        if ($registro) {
            if ($registro->imagen_referencia && File::exists(public_path('images/' . $registro->imagen_referencia))) {
                @unlink(public_path('images/' . $registro->imagen_referencia));
            }
            $registro->delete();
        }
        return redirect()->route('admin.index')->with('success', 'Mercado Local eliminado correctamente');
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

    public function guardarvendedores(\App\Http\Requests\VendedorRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors,usuario',
            'imagen_de_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors,telefono',
            'numero_puesto' => 'required|integer|min:1',
            'password' => 'required|string|min:8|confirmed',
            'fk_mercado' => 'required|exists:mercado_locals,id',
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (
            Vendedor::where('fk_mercado', $request->fk_mercado)
                ->where('numero_puesto', $request->numero_puesto)->exists()
        ) {
            return back()->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Número de Puesto en este Mercado.');
        }

        $vendedor = new Vendedor();
        $vendedor->usuario = $request->usuario;
        $vendedor->nombre = $request->nombre;
        $vendedor->nombre_del_local = $request->nombre_del_local;
        $vendedor->apellidos = $request->apellidos;
        $vendedor->telefono = $request->telefono;
        $vendedor->numero_puesto = $request->numero_puesto;
        $vendedor->fk_mercado = $request->fk_mercado;
        $vendedor->password = Hash::make($request->password);

        if ($request->hasFile('imagen_de_referencia')) {
            $file = $request->file('imagen_de_referencia');
            $dir = public_path('images');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $imageName = str_replace(' ', '_', $request->nombre . '_' . $request->nombre_del_local) . '.png';
            $file->move($dir, $imageName);
            $vendedor->imagen_de_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor creado exitosamente.');
    }

    public function vervendedores($id)
    {
        $vendedor = Vendedor::find($id);
        if (!$vendedor)
            return back()->with('error', 'Vendedor no encontrado');

        $mercadoLocal = $vendedor->mercadoLocal;
        $products = Product::where('fk_vendedors', $id)->paginate();

        return view('AdminPuestoDelVendedor', compact('vendedor', 'mercadoLocal', 'products'))
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
        $request->validate([
            'usuario' => ['required', 'email', 'max:255', Rule::unique('vendedors', 'usuario')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'nombre' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => ['required', 'string', 'max:255', Rule::unique('vendedors', 'telefono')->ignore($id)],
            'fk_mercado' => ['required', 'integer', Rule::exists('mercado_locals', 'id')],
            'numero_puesto' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('vendedors', 'numero_puesto')->ignore($id)
                    ->where(fn($q) => $q->where('fk_mercado', $request->fk_mercado)),
            ],
            'imagen_de_referencia' => 'nullable|image|max:2048',
        ]);

        $vendedor = Vendedor::findOrFail($id);

        $vendedor->usuario = $request->input('usuario');
        $vendedor->nombre = $request->input('nombre');
        $vendedor->nombre_del_local = $request->input('nombre_del_local');
        $vendedor->apellidos = $request->input('apellidos');
        $vendedor->telefono = $request->input('telefono');
        $vendedor->numero_puesto = $request->input('numero_puesto');
        $vendedor->fk_mercado = $request->input('fk_mercado');

        if ($request->filled('password')) {
            $vendedor->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('imagen_de_referencia')) {
            $image = $request->file('imagen_de_referencia');
            $dir = public_path('images');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $imageName = time() . '.' . $image->extension();
            $image->move($dir, $imageName);

            if ($vendedor->imagen_de_referencia && File::exists(public_path('images/' . $vendedor->imagen_de_referencia))) {
                @unlink(public_path('images/' . $vendedor->imagen_de_referencia));
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
            User::where('usuario', $vendedor->usuario)->delete();
            if ($vendedor->imagen_de_referencia && File::exists(public_path('images/' . $vendedor->imagen_de_referencia))) {
                @unlink(public_path('images/' . $vendedor->imagen_de_referencia));
            }
            $vendedor->delete();
        }

        return redirect()->route('admin.vendedores')->with('success', 'Vendedor eliminado exitosamente.');
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
    try {
        // Buscar al usuario
        $cliente = \App\Models\User::find($id);

        if (!$cliente) {
            return redirect()->back()->with('error', 'El usuario no existe.');
        }

        // Evitar que el admin se elimine a sí mismo
        if (Auth::guard('admin')->check() && Auth::guard('admin')->id() == $id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta mientras estás conectado.');
        }

        // Eliminar usuario de la base de datos
        $cliente->delete();

        // ✅ No eliminar sesiones aquí mismo para no invalidar el token CSRF del admin
        // En lugar de eso, marcamos para limpiar después
        register_shutdown_function(function () use ($id) {
            try {
                $sessions = \DB::table('sessions')->get();
                foreach ($sessions as $session) {
                    $payload = @unserialize(@base64_decode($session->payload));
                    if (is_array($payload) && array_key_exists('login_web_' . $id, $payload)) {
                        \DB::table('sessions')->where('id', $session->id)->delete();
                    }
                }
            } catch (\Throwable $e) {
                \Log::warning('Error al limpiar sesiones diferidas: ' . $e->getMessage());
            }
        });

        // Redirigir sin afectar la sesión actual del admin
        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');

    } catch (\Throwable $e) {
        \Log::error('Error al eliminar cliente: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error interno al eliminar el usuario.');
    }
}



    /** ---------------------------
     *  PRODUCTO
     *  ---------------------------
     */
    public function verproducto($id)
    {
        $product = Product::find($id);
        if (!$product)
            return back()->with('error', 'Producto no encontrado.');

        $vendedor = $product->vendedor;
        $products = Product::where('fk_vendedors', $product->fk_vendedors)
            ->where('id', '!=', $id)
            ->paginate();

        return view('AdminProductoEspecifico', compact('product', 'products', 'vendedor'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }
}
