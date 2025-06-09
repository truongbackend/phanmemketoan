<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Hãy nhập đúng định dạng email',
            'password.required' => 'Hãy nhập mật khẩu',
        ]);

        $credentials = request(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }
        if ($user->status == 0) {
            return response()->json(['error' => 'Tài khoản của bạn đã bị khóa'], 403);
        }
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email hoặc mật khẩu không đúng'], 401);
        }
        if ($user->expiration_package && now()->gt(Carbon::parse($user->expiration_package))) {
            return response()->json(['error' => 'Gói sử dụng của bạn đã hết hạn'], 403);
        }
        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
    public function userProfile()
    {
        return response()->json(Auth::user());
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => [ 'unique:users,email'],
        ], [
            'email.unique' => 'Email đã tồn tại',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $validatedData['email'],
            'password' => bcrypt($request->password),
        ]);

        $token = auth()->login($user);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }


}
