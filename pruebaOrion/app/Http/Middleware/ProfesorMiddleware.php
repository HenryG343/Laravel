<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProfesorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //return $next($request);
        if (!Auth::check() || !Auth::user()->hasRole('profesor')) {
            abort(403, 'No tienes permiso para acceder a esta ruta de profesor.');
        }

        return $next($request);
    }
}
