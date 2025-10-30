<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        // 🔒 Guards que existen en tu auth.php
        $guards = ['web', 'admin', 'vendedor', 'mercado', 'cliente'];
        $authenticated = false;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $authenticated = true;
                $user = Auth::guard($guard)->user();

                // Validar existencia en BD
                if (!$user) {
                    Auth::guard($guard)->logout();
                    Session::flush();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('login')->with('error', 'Tu cuenta fue eliminada.');
                }

                // Guardar el tipo de guard en sesión
                session(['guard' => $guard]);
                break;
            }
        }

        if (!$authenticated) {
            return redirect()->route('login')->with('error', 'Sesión expirada o cerrada.');
        }

        return $next($request);
    }
}
