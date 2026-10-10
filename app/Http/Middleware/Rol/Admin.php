<?php

namespace App\Http\Middleware\Rol;

use App\Http\Controllers\Admin\Seguridad;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ruta = Seguridad::validar();

        if ($ruta !== null) {
            return redirect()->route($ruta);
        }

        return $next($request);
    }
}
