<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $query = Product::with('details')
            ->where('product_user_id', auth()->id());
         if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('sku', 'like', "%{$search}%")
                ->orWhere('product_name', 'like', "%{$search}%");
            });
        }
        $products = $query->paginate($perPage);
        return response()->json($products, 201);
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sku'               => 'required|string|max:255|unique:products,sku',
                'accounting_code'   => 'required|string|max:255',
                'product_name'      => 'required|string',
                'unit'              => 'nullable|string|max:50',
                'tax_rate'          => 'required|integer|min:0|max:100',
                'details'                       => 'nullable|array',
                'details.*.combo_detail_code'   => 'nullable|string|max:255',
                'details.*.detail_name'         => 'required_with:details|string|max:255',
                'details.*.unit'                => 'required_with:details|string|max:50',
                'details.*.quantity'            => 'required_with:details|numeric|min:1',
            ]);
            $validatedData['product_user_id'] = auth()->id();
            $product = DB::transaction(function() use ($validatedData) {
                $prodData = Arr::only($validatedData, [
                    'sku', 'accounting_code', 'product_name', 'unit', 'tax_rate', 'product_user_id'
                ]);
                $p = Product::create($prodData);
                if (!empty($validatedData['details'])) {
                    $p->details()->createMany($validatedData['details']);
                }
                return $p;
            });
            $product->load('details');
            return response()->json([
                'message' => 'Product created successfully.',
                'data'    => $product
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Lỗi xác thực dữ liệu.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi tạo sản phẩm.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {
         $products = Product::with('details')->find($id);

        if (!$products) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm.'], 404);
        }

        return response()->json($products);
    }
    public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'sku'              => 'required|string|max:255|unique:products,sku,' . $id,
            'accounting_code'  => 'nullable|string|max:255',
            'product_name'     => 'required|string|max:255',
            'unit'             => 'nullable|string|max:50',
            'tax_rate'         => 'required|numeric',
            'details'          => 'array',
            'details.*.combo_detail_code' => 'nullable|string|max:255',
            'details.*.detail_name'       => 'required|string|max:255',
            'details.*.unit'              => 'nullable|string|max:50',
            'details.*.quantity'          => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // Xoá các chi tiết cũ
        $product->details()->delete();

        // Tạo lại chi tiết combo
        if (!empty($validatedData['details'])) {
            foreach ($validatedData['details'] as $detail) {
                $product->details()->create([
                    'combo_detail_code' => $detail['combo_detail_code'] ?? null,
                    'detail_name'       => $detail['detail_name'],
                    'unit'              => $detail['unit'] ?? null,
                    'quantity'          => $detail['quantity'],
                ]);
            }
        }

        return response()->json(['message' => 'Cập nhật sản phẩm thành công.']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Dữ liệu không hợp lệ.',
            'errors'  => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Đã xảy ra lỗi khi cập nhật sản phẩm.',
            'error'   => $e->getMessage(),
        ], 500);
    }
}

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm.'], 404);
        }
        try {
            $product->delete();
            return response()->json(['message' => 'Sản phẩm đã được xoá thành công.'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi xoá sản phẩm.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
