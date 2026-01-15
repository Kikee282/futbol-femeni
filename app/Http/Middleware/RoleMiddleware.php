<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Añade esta importación
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Verificar si el usuario ha iniciado sesión
        if (!Auth::check()) { //
            return redirect('/login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user(); //

        // 2. Verificar si el usuario tiene el rol necesario
        if ($user->role !== $role) { //
            return redirect('/')->with('error', 'No tens permís per accedir a aquesta pàgina.');
        }

        return $next($request);
    }
}