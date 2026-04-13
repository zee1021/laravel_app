<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Add this import at the top

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is logged in AND if they are an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Proceed to the requested page
        }

        // 2. If not an admin, kick them back to the homepage with an error
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}