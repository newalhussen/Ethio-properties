<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Allow guests to view the admin login page
        if ($request->is('admin/login') || $request->is('admin/login/*')) {
            return $next($request);
        }

        // If user is not logged in, redirect to admin login
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // If logged in but not an admin, show 403
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        // Otherwise, continue
        return $next($request);
    }
}

