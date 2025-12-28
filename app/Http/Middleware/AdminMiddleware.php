<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()
                ->route('login')
                ->with('message', 'Debes iniciar sesión como administrador.')
                ->with('message_type', 'warning');
        }

        // Comprobar si el usuario tiene el rol "admin"
        $isAdmin = DB::table('user_roles')
            ->join('roles', 'roles.id', '=', 'user_roles.role_id') // <- aquí el cambio
            ->where('user_roles.user_id', $user->id)
            ->where('roles.name', 'admin')
            ->exists();

        if (! $isAdmin) {
            abort(403, 'No tienes permisos de administrador.');
        }

        return $next($request);
    }
}
