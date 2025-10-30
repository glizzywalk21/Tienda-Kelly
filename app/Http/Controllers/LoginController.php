<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /** =====================================================
     *  VISTA DE LOGIN
     *  ===================================================== */
    public function login()
    {
        return view('LoginUser');
    }

    /** =====================================================
     *  REGISTRO DE NUEVO USUARIO (tabla users)
     *  ===================================================== */
    public function validarRegistro(Request $request)
    {
        $request->validate([
            'usuario' => [
                'required',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (
                        User::where('usuario', $value)->exists() ||
                        Vendedor::where('usuario', $value)->exists() ||
                        MercadoLocal::where('usuario', $value)->exists() ||
                        Cliente::where('usuario', $value)->exists()
                    ) {
                        $fail('El correo electrónico ya está en uso.');
                    }
                },
            ],
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => [
                'required',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    if (User::where('telefono', $value)->exists()) {
                        $fail('El número de teléfono ya está registrado.');
                    }
                },
            ],
            'sexo' => 'required|in:Masc,Fem',
            'password' => 'required|min:8|confirmed',
            'imagen_perfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // === Procesar imagen ===
        $imageName = null;
        if ($request->hasFile('imagen_perfil')) {
            $file = $request->file('imagen_perfil');
            $imagesDir = public_path('images');
            if (!is_dir($imagesDir)) {
                @mkdir($imagesDir, 0775, true);
            }
            $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '_') ?: 'avatar';
            $imageName = time() . '_' . $base . '.' . $file->getClientOriginalExtension();
            $file->move($imagesDir, $imageName);
        }

        // === Crear usuario (rol 4 por defecto) ===
        $user = User::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'ROL' => 4, // usuario normal
            'imagen_perfil' => $imageName,
        ]);

        Auth::login($user);
        session(['guard' => 'web']);

        return redirect()->route('usuarios.index')->with('success', '¡Registro exitoso!');
    }

    /** =====================================================
     *  LOGIN GENERAL (ADMIN, USER, VENDEDOR, MERCADO)
     *  ===================================================== */
    public function loginUser(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('usuario', 'password');
        $remember = $request->filled('remember');

        /** ---------------------------
         *  1️⃣ ADMIN (tabla clientes)
         *  --------------------------- */
        $clienteAdmin = Cliente::where('usuario', $credentials['usuario'])->first();
        if ($clienteAdmin && Hash::check($credentials['password'], $clienteAdmin->password) && $clienteAdmin->ROL == 1) {
            Auth::guard('admin')->login($clienteAdmin, $remember);
            session(['guard' => 'admin']);
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        /** ---------------------------
         *  2️⃣ USUARIO NORMAL (tabla users)
         *  --------------------------- */
        $user = User::where('usuario', $credentials['usuario'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $remember);
            session(['guard' => 'web']);
            $request->session()->regenerate();
            return redirect()->route('usuarios.index');
        }

        /** ---------------------------
         *  3️⃣ VENDEDOR
         *  --------------------------- */
        $vendedor = Vendedor::where('usuario', $credentials['usuario'])->first();
        if ($vendedor && Hash::check($credentials['password'], $vendedor->password)) {
            Auth::guard('vendedor')->login($vendedor, $remember);
            session(['guard' => 'vendedor']);
            $request->session()->regenerate();
            return redirect()->route('vendedores.index');
        }

        /** ---------------------------
         *  4️⃣ MERCADO LOCAL
         *  --------------------------- */
        $mercado = MercadoLocal::where('usuario', $credentials['usuario'])->first();
        if ($mercado && Hash::check($credentials['password'], $mercado->password)) {
            Auth::guard('mercado')->login($mercado, $remember);
            session(['guard' => 'mercado']);
            $request->session()->regenerate();
            return redirect()->route('mercados.index');
        }

        /** ---------------------------
         *  ❌ SI NINGUNO COINCIDE
         *  --------------------------- */
        return back()->withErrors([
            'usuario' => 'Credenciales incorrectas o usuario no encontrado.',
        ]);
    }

    /** =====================================================
     *  LOGOUT
     *  ===================================================== */
    public function logout(Request $request)
    {
        $guard = session('guard', 'web');
        Auth::guard($guard)->logout();

        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

}
