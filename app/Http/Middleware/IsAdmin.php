<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->rol !== 'admin') {
            return response()->json(['message' => 'Acceso no autorizado. Solo para administradores.'], 403);
        }

        return $next($request);
    }
}
