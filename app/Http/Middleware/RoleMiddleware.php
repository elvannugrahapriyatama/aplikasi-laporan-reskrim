<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        if (Auth::user()->role != $role) {
            if (Auth::user()->role == 'petugas') {
                return redirect('/petugas/dashboard');
            }
            return redirect('/pelapor/dashboard');
        }

        return $next($request);
    }
}