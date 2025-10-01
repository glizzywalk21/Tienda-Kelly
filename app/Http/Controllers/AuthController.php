<?php

namespace App\Http\Controllers;

use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
  
    public function create()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:user',
            'password'=> 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'rol' => 'cliente',
        ]);

        auth::login($user);

        return redirect('/')->with('success','¡Registro exitoso!');
    }

    public function showLoginform()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials =$request->validate(   [
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success','Inicio de sesión exitoso');
        }

        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success','Sesión cerrada');
    }
    //
}
