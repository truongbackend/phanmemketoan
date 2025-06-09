<?php
//jjaj

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportDataRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Traits\LoggerTrait;
class ViettelPostImportController extends Controller
{
    use LoggerTrait;

    public function importData(ImportDataRequest $request)
    {
        $validated = $request->validated();

        $fileInfoData = Excel::toArray([], $request->file('file_info'));
        $filePushSaleData = Excel::toArray([], $request->file('file_push_sale'));
        $fileDataProductData = Excel::toArray([], $request->file('file_data_product'));

        $dateFrom = \DateTime::createFromFormat('d/m/Y H:i:s', $validated['reporting_date_from']);
        $dateTo = \DateTime::createFromFormat('d/m/Y H:i:s', $validated['reporting_date_to']);

        $fileInfoDataFiltered = collect($fileInfoData[0])
            ->filter(function($row) use ($dateFrom, $dateTo) {
                for ($i = 0; $i <= 10; $i++) {
                    if (empty($row[$i])) {
                        return false;
                    }
                }

                if (!isset($row[2]) || substr($row[2], 0, 2) !== 'WB') return false;
                if (!isset($row[33]) || $row[33] !== 'Giao thành công') return false;
                if (empty($row[42])) return false;

                $date = \DateTime::createFromFormat('d/m/Y H:i:s', $row[42]);
                if (!$date) return false;
                if ($date < $dateFrom || $date > $dateTo) return false;

                return true;
            })
            ->values()
            ->all();

        $filePushSaleFiltered = collect($filePushSaleData[0])
            ->filter(function($row) {
                foreach ([0, 2, 3, 4] as $i) {
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

        $fileInfoDataMerged = collect($fileInfoDataFiltered)->map(function($infoRow) use ($filePushSaleFiltered) {
            $matchingPushSales = collect($filePushSaleFiltered)
                ->filter(function($pushRow) use ($infoRow) {
                    return isset($infoRow[2], $pushRow[2]) && $infoRow[2] === $pushRow[2];
                })
                ->values()
                ->all();
            $infoRow['push_sale_details'] = $matchingPushSales;
            return $infoRow;
        })->values()->all();

        dd($fileInfoDataMerged);

        return response()->json([
            'file_info' => $fileInfoDataMerged,
            'file_data_product' => $fileDataProductDataFiltered,
            'message' => 'Excel files merged successfully',
        ]);
    }
}
