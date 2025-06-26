<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file_product' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new ProductsImport, $request->file('file_product'));
            return response()->json(['message' => 'Import thành công']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Import thất bại',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
