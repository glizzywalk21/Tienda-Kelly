<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    // GET /login
    public function login()
    {
        return view('LoginUser'); // o tu vista de login; el registro lo haces en registroUserblade
    }

    // POST /validar-registro
    public function validarRegistro(Request $request)
    {
        $request->validate([
            'usuario'  => [
                'required','email','max:255',
                function ($attribute, $value, $fail) {
                    if (User::where('usuario', $value)->exists()
                        || Vendedor::where('usuario', $value)->exists()
                        || MercadoLocal::where('usuario', $value)->exists()) {
                        $fail('El correo electrónico ya está en uso. Por favor, elige otro.');
                    }
                },
            ],
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => [
                'required','string','max:20',
                function ($attribute, $value, $fail) {
                    if (User::where('telefono', $value)->exists()) {
                        $fail('El número de teléfono ya está registrado.');
                    }
                },
            ],
            'sexo'     => 'required|in:Masc,Fem',
            'password' => 'required|min:8|confirmed',
            'imagen_perfil' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB
        ]);

        // === GUARDA EN /public/images y BD solo el NOMBRE (no "images/...") ===
        $imageName = null;

        if ($request->hasFile('imagen_perfil')) {
            $file = $request->file('imagen_perfil');

            // Asegura la carpeta /public/images
            $imagesDir = public_path('images');
            if (!is_dir($imagesDir)) {
                @mkdir($imagesDir, 0775, true);
            }

            // Nombre único y legible
            $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '_') ?: 'avatar';
            $imageName = time().'_'.$base.'_'.Str::random(6).'.'.$file->getClientOriginalExtension();

            // Mueve el archivo
            $file->move($imagesDir, $imageName);

            // Verifica que realmente se movió
            if (!file_exists($imagesDir.DIRECTORY_SEPARATOR.$imageName)) {
                return back()
                    ->with('error', 'Error al guardar la imagen. Intenta de nuevo.')
                    ->withInput();
            }
        } else {
            return back()->with('error', 'No se recibió la imagen de perfil.')->withInput();
        }

        // Crea el usuario (imagen_perfil solo con el nombre)
        $user = User::create([
            'usuario'       => $request->usuario,
            'password'      => Hash::make($request->password),
            'nombre'        => $request->nombre,
            'apellido'      => $request->apellido,
            'telefono'      => $request->telefono,
            'sexo'          => $request->sexo,
            'ROL'           => 4,              // usuario normal
            'imagen_perfil' => $imageName,     // <-- SOLO nombre (ej: "hAw8lmcI9g....png")
        ]);

        Auth::login($user);

        return redirect()->route('usuarios.index')->with('success', '¡Registro exitoso!');
    }

    // POST /validar-login
    public function LoginUser(Request $request)
    {
        $request->validate([
            'usuario'  => 'required|string|email',
            'password' => 'required|string',
        ], [
            'usuario.required'  => 'El correo electrónico es obligatorio.',
            'usuario.email'     => 'Debes ingresar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $credentials = $request->only('usuario', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->redirectUser(Auth::user()->ROL);
        }

        // Si manejas otros guards:
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

        return back()->withErrors([
            'usuario' => 'Correo o contraseña incorrectos. Intenta de nuevo.',
        ])->withInput($request->only('usuario'));
    }

    protected function redirectUser($rol)
    {
        switch ($rol) {
            case 1: return redirect()->intended('admin');
            case 2: return redirect()->intended('mercados');
            case 3: return redirect()->intended('vendedores');
            case 4: return redirect()->intended('usuarios');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Rol no reconocido.');
        }
    }

    // GET /logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
