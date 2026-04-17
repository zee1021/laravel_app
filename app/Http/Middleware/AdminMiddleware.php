<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming you have an 'is_admin' boolean column on your users table.
        // If you are using a string 'role' column instead, use: $request->user()->role === 'admin'
        if ($request->user() && $request->user()->is_admin) {
            return $next($request);
        }

        // Deny access for non-admin users
        abort(403, 'Unauthorized access: Admins only.');
    }
}