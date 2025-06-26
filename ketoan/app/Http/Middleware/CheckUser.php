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
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $token = Auth::getToken();
        if (!$user || !$token) {
            return response()->json(['error' => 'Chưa đăng nhập hoặc token không hợp lệ'], 401);
        }
        if ($user->api_token !== (string)$token) {
            return response()->json(['error' => 'Thiết bị đã được đăng nhập ở một nơi khác'], 408);
        }
        return $next($request);
    }
}
