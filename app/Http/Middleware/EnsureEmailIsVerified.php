<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->hasVerifiedEmail()) {
            return response()->json(['error' => 'Your email address is not verified.'], 403);
        }

        return $next($request);
    }
}
