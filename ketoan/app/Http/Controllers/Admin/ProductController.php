<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('market_code', 'like', "%$search%")
                  ->orWhere('accounting_system_code', 'like', "%$search%")
                  ->orWhere('product_name', 'like', "%$search%")
                  ->orWhere('combo_detail_code', 'like', "%$search%");
            });
        }

        $perPage = $request->input('per_page', 10);
        $products = $query->paginate($perPage);

        return response()->json([
            'data' => $products->items(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
        ]);
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
                'market_code' => 'required|string|max:255|unique:products,market_code',
                'accounting_system_code' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'unit' => 'nullable|string|max:50',
                'tax_rate' => 'nullable|numeric|min:0|max:100',
                'combo_detail_code' => 'nullable|string|max:255',
                'combo_name' => 'nullable|string|max:255',
                'combo_unit' => 'nullable|string|max:50',
                'quantity' => 'nullable|integer|min:0',
            ]);

            $product = Product::create($validatedData);

            return response()->json($product, 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Lỗi xác thực dữ liệu.',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi tạo sản phẩm.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
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
                'tax_rate' => 'nullable|numeric|min:0|max:100',
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
