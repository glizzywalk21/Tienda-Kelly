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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

    class AdminController extends Controller
    {

        /**MERCADOS LOCALES */
        public function index()
        {
            $id = 1; // ID del cliente para obtener datos específicos
        $mercadoLocals = MercadoLocal::paginate(); // Obtener mercados locales paginados
        $vendedors = Vendedor::paginate(); // Obtener vendedores paginados
        $clientes = User::where('id', $id)->get(); // Obtener cliente específico

        // Retornar la vista 'AdminHome' con los datos paginados y la variable 'i' para la paginación
        return view('AdminHome', compact('mercadoLocals', 'vendedors', 'clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $mercadoLocals->perPage());
        }

        public function crearmercados()
        {
            $mercadoLocal = new MercadoLocal(); // Crear nueva instancia de MercadoLocal

            // Retornar vista 'AdminAgregarMercado' con el mercado local creado
            return view('AdminAgregarMercado', compact('mercadoLocal'));
        }

        public function guardarmercados(MercadoLocalRequest $request)
        {
                // Validar los datos del formulario
            $request->validate([
                'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'nombre' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'horaentrada' => 'required|string|max:255',
            'horasalida' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',

        ]);

            $nombreLimpio = str_replace(' ', '', $request->nombre);
            $usuario = strtolower($nombreLimpio) . '@minishop.sv';
            $password = '1' . strtolower($nombreLimpio) . '!';

            $mercadolocal = new MercadoLocal();

        //INSTANCIAS, significa guardar variables en $variables
            $mercadolocal->usuario = $usuario;
            $mercadolocal ->password = Hash::make($password);
            $mercadolocal->nombre = $request->nombre;
            $mercadolocal->imagen_referencia = $request->imagen_referencia;
            $mercadolocal->municipio = $request->municipio;
            $mercadolocal->ubicacion = $request->ubicacion;
            $mercadolocal->horaentrada = $request->horaentrada;
            $mercadolocal->horasalida = $request->horasalida;
            $mercadolocal->descripcion = $request->descripcion;

        //if para la imagen
            if ($request->hasFile('imagen_referencia')) {
            // Construir el nuevo nombre del archivo
                $nombre = str_replace(' ', '_', strtolower($request->input('nombre')));
                $municipio = str_replace(' ', '_', strtolower($request->input('municipio')));
                $imageName = "{$nombre}_{$municipio}.png";

            // Mover el archivo a la carpeta 'imagenes' con el nuevo nombre
                $request->imagen_referencia->move(public_path('imgs'), $imageName);

            // Guardar el nombre del archivo en la base de datos
                $mercadolocal->imagen_referencia = $imageName;
            }

            $mercadolocal->save();

            return redirect()->route('admin.index')->with([
                'usuario' => $usuario,
                'password' => $password,
                'nombre' =>$mercadolocal->nombre,
            ]);
        }

        public function vermercados($id, Request $request)
        {
            $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID

            // Filtrar vendedores según la clasificación si se proporciona, de lo contrario obtener todos
            $query = Vendedor::where('Fk_Mercado', $id);
            if ($request->has('clasificacion') && $request->clasificacion != 'todos') {
                $query->where('clasificacion', $request->clasificacion);
            }
            $vendedors = $query->get(); // Obtener los vendedores filtrados

            return view('AdminMercadoEspecifico', compact('mercadoLocal','query', 'vendedors'));
        }

        public function editarmercados($id)
        {
            $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID

        // Retornar vista 'AdminEditarMercado' con el mercado local a editar
        return view('AdminEditarMercado', compact('mercadoLocal'));
        }
        public function actualizarmercados(MercadoLocalRequest $request, $id)
        {
            // Encontrar mercado local por ID
            $mercadoLocal = MercadoLocal::findOrFail($id);

            // Validar y obtener los datos del formulario
            $data = $request->validate([
                'nombre' => 'required|string|max:255',
                'municipio' => 'required|string|max:255',
                'ubicacion' => 'required|string|max:255',
                'horaentrada' => 'required',
                'horasalida' => 'required',
                'descripcion' => 'required|string|max:220',

            ]);

            // Si se ha subido una nueva imagen
            if ($request->hasFile('imagen_referencia')) {
                // Construir el nuevo nombre del archivo
                $nombre = str_replace(' ', '_', strtolower($request->input('nombre')));
                $municipio = str_replace(' ', '_', strtolower($request->input('municipio')));
                $imageName = "{$nombre}_{$municipio}.png";

                // Mover el archivo a la carpeta 'imgs' con el nuevo nombre
                $request->file('imagen_referencia')->move(public_path('imgs'), $imageName);

                // Actualizar el nombre del archivo en los datos que se guardarán en la base de datos
                $data['imagen_referencia'] = $imageName;
            }

            // Actualizar campos del mercado local con los datos del formulario
            $mercadoLocal->update($data);

            // Redirigir a la vista de índice de mercados locales con mensaje de éxito
            return redirect()->route('admin.index')
                ->with('success', 'Mercado Local actualizado con éxito');
        }



        public function eliminarmercados($id)
        {
            MercadoLocal::find($id)->delete(); // Encontrar y eliminar mercado local por ID

        // Redirigir a la vista de índice de mercados locales con mensaje de éxito
            return redirect()->route('admin.index')
            ->with('success', 'Mercado Local deleted successfully');
        }






        /**VENDEDORES */

        public function vendedores()
        {
            $vendedors = Vendedor::paginate();
        return view('AdminListadoVendedores', compact('vendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
        }
        public function crearvendedores()
        {
            $vendedor = new Vendedor();
        $mercados = MercadoLocal::all(); // Suponiendo que tu modelo de mercados se llama MercadoLocal
        return view('AdminRegistrarVendedor', compact('vendedor', 'mercados'));


        }
        public function guardarvendedores(VendedorRequest $request)
        {
                // Validar los datos del formulario
                $validator = Validator::make($request->all(), [
                    'usuario' => 'required|email|unique:vendedors',
                    'imagen_de_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                    'nombre' => 'required|string|max:255',
                    'nombre_del_local' => 'required|string|max:255',
                    'apellidos' => 'required|string|max:255',
                    'telefono' => 'required|string|max:20|unique:vendedors',
                    'numero_puesto' => 'required|integer',
                    'password' => 'string|confirmed',  // Regla de longitud mínima
                    'clasificacion' => 'required|string|max:255',
                    'fk_mercado' => 'required|exists:mercado_locals,id',
                ], [

                    'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                    'password.confirmed' => 'Las contraseñas no coinciden.',
                ]);


        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar si ya existen datos iguales en la base de datos
        if (Vendedor::where('usuario', $request->usuario)->exists() || Vendedor::where('telefono', $request->telefono)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Correo Electrónico o Teléfono.');
        }

        // Verificar si el numero_puesto ya existe en el mismo mercado
        if (Vendedor::where('fk_mercado', $request->fk_mercado)->where('numero_puesto', $request->numero_puesto)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Numero de Puesto en este Mercado.');
        }


        // Crear vendedor si la validación pasa y no hay datos repetidos
        $vendedor = new Vendedor();
        $vendedor->usuario = $request->usuario;
        $vendedor->nombre = $request->nombre;
        $vendedor->nombre_del_local = $request->nombre_del_local;
        $vendedor->apellidos = $request->apellidos;
        $vendedor->telefono = $request->telefono;
        $vendedor->numero_puesto = $request->numero_puesto;
        $vendedor->fk_mercado = $request->fk_mercado;
        $vendedor->password = Hash::make($request->password); // Encriptar la contraseña
        $vendedor->clasificacion = $request->clasificacion;

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen_de_referencia')) {
            $file = $request->file('imagen_de_referencia');
            $imageName = $request->nombre . '_' . $request->nombre_del_local . '.png';

            // Movimiento
            $file->move(public_path('imgs'), $imageName);
            // Guardar
            $vendedor->imagen_de_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor creado exitosamente.');
        }
        public function vervendedores($id)
        {
            $vendedor = Vendedor::find($id);

        if(!$vendedor) {
            return redirect()->back()->with('error','Vendedor no encontrado');
        }
            $mercadoLocal = $vendedor->mercadoLocal;
            $products = Product::where('fk_vendedors',$id)->paginate();

            return view('AdminPuestosDelMercado', compact('vendedor','mercadoLocal','products'))->with('i',(request()->input('page',1) - 1) * $products->perPage());
        }
        public function editarvendedores($id)
        {
            $vendedor = Vendedor::find($id);
        $mercados = MercadoLocal::all();
        return view('AdminEditarVendedor', compact('vendedor', 'mercados'));

        }
        public function actualizarvendedor(VendedorRequest $request ,$id){
            $request->validate([
                'password' => 'nullable|string|min:8|confirmed',
                'nombre' => 'required|string|max:255',
                'nombre_del_local' => 'required|string|max:255',

                'clasificacion' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
                'numero_puesto' => 'required|integer|unique:vendedors,numero_puesto,' . $id,
                'fk_mercado' => 'required|exists:mercado_locals,id',
            ]);

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
            return redirect()->route('admin.vendedores', $id)->with('success', 'Vendedor actualizado correctamente.');
        }
        public function eliminarvendedores($id)
        {
            $vendedor = Vendedor::find($id);

        // Eliminar el usuario en la tabla `users`
        User::where('usuario', $vendedor->usuario)->delete();

        $vendedor->delete();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor eliminado exitosamente.');
        }





        /**CLIENTES */
        public function clientes()
{
    // Filtrar usuarios excluyendo el que tiene ID 1
    $clientes = User::where('id', '!=', 1)->paginate();

    return view('AdminListadoClientes', compact('clientes'))
        ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
}


        public function eliminarclientes($id)
        {
            User::find($id)->delete();

            return redirect()->route('admin.clientes')
                ->with('success', 'Cliente deleted successfully');
        }


        /**
         * PRODUCTO
         */
        public function verproducto($id){
                    // Obtener el producto específico
            $product = Product::find($id);
            // Verificar si el producto existe antes de proceder
            if (!$product) {
                return redirect()->back()->with('error', 'Producto no encontrado.');
            }
            // Obtener el vendedor del producto
            $vendedor = $product->vendedor;

            // Obtener los productos que comparten la misma llave foránea del vendedor,
            // pero excluyendo el producto actual
            $products = Product::where('fk_vendedors', $product->fk_vendedors)
        ->where('id', '!=', $id)
        ->paginate();

        // Retornar la vista con los datos del producto y otros productos del mismo vendedor
        return view('AdminProductoEspecifico', compact('product', 'products', 'vendedor'))
        ->with('i', (request()->input('page', 1) - 1) * $products->perPage());

        }
    }
