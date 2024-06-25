<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $rolesdb = Auth::user()->roles()->pluck('role');

        if (Auth::check()) {
            foreach ($roles as $role) {
                if ($rolesdb->contains($role)) {
                    return $next($request);
                }
            }
        }
        return back()->with('status', 'You do not have access to this section.');
    }
}
