<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if any guard is authenticated
        if (!Auth::check() && !Auth::guard('vendedor')->check() && !Auth::guard('mercado')->check()) {
            return response()->view('auth.login-required');
        }

        $response = $next($request);

        // Disable browser cache for protected routes
        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', '0');
    }
}

