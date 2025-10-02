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
    // Mostrar formulario de login
    public function login()
    {
        return view('LoginUser');
    }

    // Registrar nuevo usuario
    public function register(Request $request)
    {
        // Validación de los datos con mensajes personalizados
        $request->validate([
            'usuario' => [
                'required',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (User::where('usuario', $value)->exists() ||
                        Vendedor::where('usuario', $value)->exists() ||
                        MercadoLocal::where('usuario', $value)->exists()) {
                        $fail('El correo electrónico ya está en uso. Por favor, elige otro.');
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
        ], [
            'usuario.required' => 'El correo electrónico es obligatorio.',
            'usuario.email' => 'Debes ingresar un correo electrónico válido.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'sexo.required' => 'Debes seleccionar tu sexo.',
            'sexo.in' => 'Sexo inválido. Debe ser Masc o Fem.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, verifica.',
        ]);

        // Crear el usuario
        $user = User::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'ROL' => 4, // Usuario normal
        ]);

        Auth::login($user);

        return redirect()->route('usuarios.index')->with('success', '¡Registro exitoso!');
    }

    // Login de usuario
    public function LoginUser(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'usuario.required' => 'El correo electrónico es obligatorio.',
            'usuario.email' => 'Debes ingresar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $credentials = $request->only('usuario', 'password');
        $remember = $request->filled('remember');

        // Intentar login en tabla User
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->redirectUser(Auth::user()->ROL);
        }

        // Intentar login en tabla Vendedor
        $vendedor = Vendedor::where('usuario', $credentials['usuario'])->first();
        if ($vendedor && Hash::check($credentials['password'], $vendedor->password)) {
            Auth::guard('vendedor')->login($vendedor, $remember);
            $request->session()->regenerate();
            return $this->redirectUser(3);
        }

        // Intentar login en tabla MercadoLocal
        $mercado = MercadoLocal::where('usuario', $credentials['usuario'])->first();
        if ($mercado && Hash::check($credentials['password'], $mercado->password)) {
            Auth::guard('mercado')->login($mercado, $remember);
            $request->session()->regenerate();
            return $this->redirectUser(2);
        }

        // Si falla todo
        return redirect()->back()->withErrors([
            'usuario' => 'Correo o contraseña incorrectos. Intenta de nuevo.',
        ])->withInput($request->only('usuario'));
    }

    // Redirige según rol
    protected function redirectUser($rol)
    {
        switch ($rol) {
            case 1:
                return redirect()->intended('admin');
            case 2:
                return redirect()->intended('mercados');
            case 3:
                return redirect()->intended('vendedores');
            case 4:
                return redirect()->intended('usuarios');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Rol no reconocido.');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
