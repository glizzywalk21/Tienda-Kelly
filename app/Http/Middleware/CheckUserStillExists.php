<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckUserStillExists
{
    public function handle($request, Closure $next)
    {
        // Solo aplica a usuarios normales (guard web)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // Si el usuario fue eliminado de la BD
            $exists = \App\Models\User::where('id', $user->id)->exists();

            if (!$exists) {
                // Cerrar sesión localmente
                Auth::guard('web')->logout();

                // 🔥 Borrar la sesión activa del storage (archivo o BD)
                DB::table('sessions')
                    ->where('id', session()->getId())
                    ->delete();

                // Limpiar sesión del navegador
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', 'Tu cuenta ha sido eliminada. Inicia sesión nuevamente.');
            }
        }

        return $next($request);
    }
}
