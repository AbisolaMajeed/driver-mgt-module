<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = $request->user();

        // Ensure the user is authenticated
        if (!$user) {
            return errorResponse("Unauthorized action.");
        }

        // Check if the user has the required permission
        if (Gate::denies($permission, $user)) {
            return errorResponse("You do not have permission to perform this action.");
        }

        return $next($request);
    }
}
