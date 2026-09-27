<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        // User must be logged in
        if (!Auth::check()) {
            return redirect()->route('register');
        }

        // User must be an admin
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}