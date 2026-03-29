<?php

namespace App\Http\Middleware;

use App\Enums\SystemRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === SystemRoles::ADMIN->value) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
