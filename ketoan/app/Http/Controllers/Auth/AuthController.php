<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\package;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;

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
        $user =User::where('email', $credentials['email'])->first();
            if (!$user) {
                return response()->json(['error' => 'Email chưa được đăng ký'], 404);
            }
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Email hoặc mật khẩu không đúng'], 401);
        }

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Email không tồn tại'], 404);
        }

        if ($user->status == 0) {
            return response()->json(['error' => 'Tài khoản của bạn đã bị khóa'], 403);
        }

        if ($user->expiration_package && now()->gt(Carbon::parse($user->expiration_package))) {
            return response()->json(['error' => 'Gói sử dụng của bạn đã hết hạn'], 403);
        }
        $user->api_token = $token;
        $user->save();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user
        ]);
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
            $user = auth()->user()->load('roles.permissions');
            $perms = $user->getAllPermissions()->pluck('name');
            return response()->json([
            'user' => $user,
            'permissions' => $perms
            ]);
        }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['unique:users,email'],
        ], [
            'email.unique' => 'Email đã tồn tại',
        ]);
        $role = Role::where('default_role', 1)->first();


        $package = Package::where('default_packages', 1)->first();
        if (!$package) {
            return response()->json(['error' => 'Không tìm thấy gói mặc định'], 400);
        }
        $expiration_days = $package->expiration_time;
        $expiration_package = Carbon::now()->addDays($expiration_days);
        $now = Carbon::now();
        $user = User::create([
            'name' => $request->name,
            'email' => $validatedData['email'],
            'password' => bcrypt($request->password),
            'packages_id' => $package->id,
            'create_package' => $now,
            'expiration_package' => $expiration_package,

        ]);
        Mail::to($user->email)->send(new RegisterMail($user));
        if ($role) {
            $user->roles()->attach($role->id);
        }
        $token = auth()->login($user);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }


    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Email không tồn tại trong hệ thống',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $newPassword = Str::random(16);
            $symbols = ['-', '_', '[', ']', ';', '(', ')', '@', '!'];
            $newPassword = substr_replace($newPassword, $symbols[random_int(0, count($symbols)-1)], random_int(0, strlen($newPassword)-1), 0);

            $user->password = Hash::make($newPassword);
            $user->save();
            try {
            Mail::to($user->email)->send(new ResetPasswordMail($user, $newPassword));
            } catch (\Exception $e) {
                \Log::error('Lỗi gửi email đặt lại mật khẩu: ' . $e->getMessage());
                return response()->json(['error' => 'Đặt lại mật khẩu thành công nhưng gửi email thất bại. Vui lòng thử lại sau.'], 500);
            }
            return response()->json(['message' => 'Mật khẩu đã được đặt lại thành công']);
        }
        return response()->json(['message' => 'Không tìm thấy người dùng.'], 404);
    }




}
