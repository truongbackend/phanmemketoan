<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('package');  // eager load package

        $query->where('order_user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('customer_name', 'like', '%' . $request->search . '%');
        }

        return response()->json($query->get());
    }
    public function store(Request $request)
{
    $authUser = auth()->user();

    // Nếu có user_id và người login không phải admin -> từ chối
    if ($request->filled('user_id')) {
        if (!$authUser->hasRole('administration')) {
            return response()->json(['message' => 'Bạn không có quyền tạo đơn cho người khác!'], 403);
        }
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại!'], 404);
        }
    } else {
        $user = $authUser;
    }

    if (!$request->filled('customer_name') || !$request->filled('phone') || !$request->filled('address')) {
        return response()->json(['message' => 'Vui lòng điền đủ tên, điện thoại, địa chỉ.'], 422);
    }
    $package = Package::find($request->input('package_id'));
    if (!$package) {
        return response()->json(['message' => 'Gói dịch vụ không tồn tại!'], 404);
    }
    $totalAmount = $request->input('total_amount');
    if (!is_numeric($totalAmount) || $totalAmount < 0) {
        return response()->json(['message' => 'Tổng tiền không hợp lệ!'], 422);
    }
    $currentExpiration = $user->expiration_package ? Carbon::parse($user->expiration_package) : now();
    $baseDate = $currentExpiration->isFuture() ? $currentExpiration : now();
    $newExpiration = $baseDate->copy()->addDays($package->expiration_time);
    $user->expiration_package = $newExpiration;
    $user->packages_id = $request->input('package_id');
    $user->save();

    $order = Order::create([
        'customer_name' => $request->input('customer_name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'total_amount' => $totalAmount,
        'package_id' => $request->input('package_id'),
        'order_user_id' => $user->id,
        'status' => 1,
    ]);

    return response()->json(['message' => 'Đơn hàng được tạo thành công!', 'order' => $order], 201);
}




}
