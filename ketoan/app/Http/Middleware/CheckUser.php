<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
     public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
         if (!$user || $request->bearerToken() !== $user->api_token) {
            return response()->json(['message' => 'Tài khoản chỉ đăng nhập được 1 thiết bị.'], 401);
        }
        return $next($request);
    }
}
