<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('LoginUser');
    }

    public function register(Request $request)
    {
         // Validación de los datos con mensajes de error personalizados
    $request->validate([
        'usuario' => [
            'required',
            'email',
            function ($attribute, $value, $fail) {
                if (User::where('usuario', $value)->exists() ||
                    Vendedor::where('usuario', $value)->exists() ||
                    MercadoLocal::where('usuario', $value)->exists()) {
                    $fail('El nombre de usuario ya está en uso en otra tabla.');
                }
            },
        ],
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => [
            'required',
            'string',
            'max:15',
            function ($attribute, $value, $fail) {
                if (User::where('telefono', $value)->exists()) {
                    $fail('El número de teléfono ya está registrado.');
                }
            },
        ],
        'sexo' => 'required|in:Masc,Fem',
        'password' => 'required|min:8|confirmed',
    ]);

    // Crear un nuevo usuario si la validación pasa
    $user = new User();
    $user->usuario = $request->usuario;
    $user->password = Hash::make($request->password);
    $user->nombre = $request->nombre;
    $user->apellido = $request->apellido;
    $user->telefono = $request->telefono;
    $user->sexo = $request->sexo;

    $user->save();

    Auth::login($user);

    return redirect(route('usuarios.index','user'))->with('success', '¡Registro exitoso!');
    }

    public function LoginUser(Request $request)
{
    // Validar los campos de entrada
    $request->validate([
        'usuario' => 'required|string',
        'password' => 'required|string',
    ], [
        'usuario.required' => 'El campo email es obligatorio.',
        'password.required' => 'El campo contraseña es obligatorio.',
    ]);

    $credentials = $request->only('usuario', 'password');
    $remember = $request->filled('remember');

    // Intentar autenticar al usuario en la tabla `User`
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        $user = Auth::user();
        return $this->redirectUser($user->ROL);
    }

    // Si no es un usuario, intentar en las otras tablas según el rol
    $vendedor = Vendedor::where('usuario', $credentials['usuario'])->first();
    if ($vendedor && Hash::check($credentials['password'], $vendedor->password)) {
        Auth::guard('vendedor')->login($vendedor, $remember);
        $request->session()->regenerate();
        return $this->redirectUser(3);
    }

    $mercado = MercadoLocal::where('usuario', $credentials['usuario'])->first();
    if ($mercado && Hash::check($credentials['password'], $mercado->password)) {
        Auth::guard('mercado')->login($mercado, $remember);
        $request->session()->regenerate();
        return $this->redirectUser(2);
    }

    // Si la autenticación falla
    return redirect('login')->withErrors([
        'usuario' => 'Datos inválidos. Inténtelo de nuevo.',
    ]);
}


    protected function redirectUser($rol)
    {
        switch ($rol) {
            case 1:
                return redirect()->intended('admin'); // Ruta para Admin General
            case 2:
                return redirect()->intended('mercados'); // Ruta para Admin Mercado
            case 3:
                return redirect()->intended('vendedores'); // Ruta para Vendedores
            case 4:
                return redirect()->intended('usuarios'); // Ruta para Usuarios normales
            default:
                Auth::logout();
                return redirect('login')->with('error', 'Rol no reconocido.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
