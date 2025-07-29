<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingAccountEcommerce;

class SettingController extends Controller
{

    public function index()
    {
        $settings = SettingAccountEcommerce::where('user_id', auth()->id())->first();

        return response()->json([
            'settings' => $settings,
        ], 200);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_code'           => 'required|string|max:255',
            'customer_name'           => 'required|string|max:255',
            'product_name_setting'    => 'nullable|array',
            'product_name_setting.*'  => 'string|max:255',
            'interpretation'          => 'nullable|array',
            'interpretation.*'        => 'string|max:255',
            'added_tax_vat'           => 'nullable|numeric',
            'warehouse'               => 'nullable|string|max:255',
            'account_capital_price'   => 'nullable|string|max:255',
            'account_warehouse'       => 'nullable|string|max:255',
            'payment_method'          => 'nullable|integer',
        ]);
        $data['user_id'] = auth()->id();

        $setting = SettingAccountEcommerce::updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );

        return response()->json([
            'message'  => 'Settings saved successfully',
            'settings' => $setting,
        ], 200);
    }

}
