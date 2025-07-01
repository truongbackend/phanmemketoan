<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();
        $query = Order::with('package');

        if ($authUser->hasRole('administration')) {
            if ($request->filled('user_id')) {
                $query->where('order_user_id', $request->input('user_id'));
            }
        } else {
            $query->where('order_user_id', $authUser->id);
        }

        if ($request->filled('search')) {
            $query->where('customer_name', 'like', '%' . $request->search . '%');
        }
        $query->orderBy('created_at', 'desc');
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();
        $user = $authUser;
        $package = Package::find($request->input('package_id'));
        if (!$package) {
            return response()->json(['message' => 'Gói dịch vụ không tồn tại!'], 404);
        }
        $totalAmount = $request->input('total_amount');
        if (!is_numeric($totalAmount) || $totalAmount < 0) {
            return response()->json(['message' => 'Tổng tiền không hợp lệ!'], 422);
        }
        $order = Order::create([
            'customer_name' => $authUser->name,
            'email' => $authUser->email,
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'total_amount' => $totalAmount,
            'package_id' => $request->input('package_id'),
            'note' => $request->input('note'),
            'companyTax' => $request->input('company_tax'),
            'companyName' => $request->input('company_name'),
            'order_user_id' => $user->id,
            'status' => 1,
        ]);

        return response()->json(['message' => 'Đơn hàng được tạo thành công!', 'order' => $order], 201);
    }

    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        return response()->json('Xoá thành công');
    }
     public function update($id)
{
    $order = Order::find($id);
    if (!$order) {
        return response()->json(['message' => 'Đơn hàng không tồn tại!'], 404);
    }
    $user = User::find($order->order_user_id);
    if (!$user) {
        return response()->json(['message' => 'Người dùng không tồn tại!'], 404);
    }

    $package = Package::find($order->package_id);
    if (!$package) {
        return response()->json(['message' => 'Gói dịch vụ không tồn tại!'], 404);
    }
    $currentExpiration = $user->expiration_package ? Carbon::parse($user->expiration_package) : now();
    $baseDate = $currentExpiration->isFuture() ? $currentExpiration : now();
    $newExpiration = $baseDate->copy()->addDays($package->expiration_time);
    $user->expiration_package = $newExpiration;
    $user->packages_id = $package->id;
    $user->save();
    $order->status = 2;
    $order->save();

    return response()->json(['message' => 'Đơn hàng được cập nhật thành công!'], 200);
}





}
