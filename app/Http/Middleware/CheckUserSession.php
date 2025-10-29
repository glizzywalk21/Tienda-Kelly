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
        // 🔐 Verificar si hay sesión en cualquier guard
        if (!Auth::guard('web')->check() && !Auth::guard('admin')->check()) {
            return redirect()->route('login')->with('error', 'Sesión expirada o cerrada.');
        }

        // 📌 Si hay usuario logueado en 'web', verificar si aún existe
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if (!$user || !User::where('id', $user->id)->exists()) {
                Auth::guard('web')->logout();
                Session::flush();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('error', 'Tu cuenta fue eliminada.');
            }
        }
        
        if (!Auth::guard('web')->check() && !Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }

        // 🚫 No hacer logout si es admin
        return $next($request);
    }
}
