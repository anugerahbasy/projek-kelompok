<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($request->routeIs('login') || $request->routeIs('register')) {
                $route = match ($user->role) {
                    'admin' => 'admin.dashboard',
                    'manager' => 'manager.dashboard',
                    'staff' => 'staff.dashboard',
                    'pegawai' => 'pegawai.dashboard',
                    'kurir' => 'kurir.dashboard',
                    default => 'client.dashboard',
                };
                
                return redirect()->route($route);
            }
        }

        return $next($request);
    }
}