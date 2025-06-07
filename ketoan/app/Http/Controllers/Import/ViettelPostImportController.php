<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportDataRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ViettelPostImportController extends Controller
{
    public function importData(ImportDataRequest $request)
    {
        $validated = $request->validated();

        $fileInfoData = Excel::toArray([], $request->file('file_info'));
        $filePushSaleData = Excel::toArray([], $request->file('file_push_sale'));
        $fileDataProductData = Excel::toArray([], $request->file('file_data_product'));

        $fileInfoDataFiltered = collect($fileInfoData[0])
            ->filter(function($row) {
                for ($i = 0; $i <= 10; $i++) {
                    if (empty($row[$i])) {
                        return false; 
                    }
                }
                return true; 
            })
            ->values()
            ->all();

        $fileInfoDataFilteredFiltered = collect($filePushSaleData[0])
            ->filter(function($row) {
                for ($i = 0; $i <= 10; $i++) {
                    if (empty($row[$i])) {
                        return false; 
                    }
                }
                return true; 
            })
            ->values()
            ->all();

        $fileDataProductDataFiltered = collect($fileDataProductData[0])
            ->filter(function($row) {
                for ($i = 0; $i <= 2; $i++) {
                    if (empty($row[$i])) {
                        return false; 
                    }
                }
                return true; 
            })
            ->values()
            ->all();


        dd($fileDataProductDataFiltered);
        return response()->json([
            'file_info' => $fileInfoDataFiltered,
            'file_push_sale' => $filePushSaleData,
            'file_data_product' => $fileDataProductData,
            'message' => 'Excel files read successfully',
        ]);
    }
}
