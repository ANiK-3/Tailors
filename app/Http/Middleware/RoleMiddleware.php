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
        // Check if the user is authenticated
        if (Auth::check()) {
            $rolesdb = Auth::user()->roles()->pluck('role');

            // Check if the authenticated user has any of the specified roles
            foreach ($roles as $role) {
                if ($rolesdb->contains($role)) {
                    return $next($request);
                }
            }
        } else {
            // If the user is not authenticated, check if 'guest' is one of the roles
            if (in_array('Guest', $roles)) {
                return $next($request);
            }
        }
        return redirect()->route('home')->with('error', 'You do not have access to this section.');
    }
}
