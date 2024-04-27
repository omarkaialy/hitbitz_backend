<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guest()) {
            return ApiResponse::error(401, 'UnAuthorized');

        } else if ($request->bearerToken() != Auth::user()->token) {
            return ApiResponse::error(401, 'UnAuthorized');
        } else
            return $next($request);
    }
}
