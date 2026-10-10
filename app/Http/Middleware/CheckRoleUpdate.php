<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUpdate
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->rol_id == $role) {
            return $next($request);
        }
        return redirect()->route('admin.usuarios');
    }
}
