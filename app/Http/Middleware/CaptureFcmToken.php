<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CaptureFcmToken
{
    public function handle($request, Closure $next)
    {
        if ($request->header('fcm_token')) {
            $user = Auth::user();
            if ($user) {
                $user->fcm_token = $request->header('fcm_token');
                $user->save();
            }
        }

        return $next($request);
    }
}
