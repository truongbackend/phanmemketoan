<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $query = Product::with('details');
         if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('sku', 'like', "%{$search}%")
                ->orWhere('product_name', 'like', "%{$search}%");
            });
        }
        $products = $query->paginate($perPage);
        return response()->json($products, 201);
    }

    /**
     * Lưu trữ một sản phẩm mới vào cơ sở dữ liệu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'market_code'            => 'required|string|max:255|unique:products,market_code',
                'accounting_system_code' => 'required|string|max:255',
                'product_name'           => 'required|string|max:255',
                'unit'                   => 'nullable',
                'tax_rate'               => 'required',
            ]);

            // Lấy user_id và gán vào data
            $validatedData['user_id'] = auth()->id();

            $product = Product::create($validatedData);

            return response()->json($product, 201);

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


    /**
     * Hiển thị thông tin của một sản phẩm cụ thể.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm.'], 404); // 404 Not Found
        }

        return response()->json($product);
    }

    /**
     * Cập nhật một sản phẩm trong cơ sở dữ liệu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm.'], 404);
        }

        try {
            $validatedData = $request->validate([
                'market_code' => 'required|string|max:255|unique:products,market_code,' . $id,
                'accounting_system_code' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'unit' => 'nullable|string|max:50',
                'tax_rate' => 'nullable|numeric',
                'combo_detail_code' => 'nullable|string|max:255',
                'combo_name' => 'nullable|string|max:255',
                'combo_unit' => 'nullable|string|max:50',
                'quantity' => 'nullable|integer|min:0',
            ]);

            $product->update($validatedData);

            return response()->json($product);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Lỗi xác thực dữ liệu.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi cập nhật sản phẩm.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xoá một sản phẩm khỏi cơ sở dữ liệu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm.'], 404);
        }

        try {
            $product->delete();
            return response()->json(['message' => 'Sản phẩm đã được xoá thành công.'], 200); // 200 OK
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi xoá sản phẩm.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
