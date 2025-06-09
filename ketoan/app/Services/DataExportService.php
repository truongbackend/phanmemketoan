<?php

namespace App\Services;

// use App\Repositories\Currency\CurrencyInterface;

class DataExportService
{
    // protected $currencyRepository;

    // public function __construct(CurrencyInterface $currencyRepository)
    // {
    //     $this->currencyRepository = $currencyRepository;
    // }

    /**
     * Trả về mảng head cho xuất file xls theo loại: ban hang hoặc dich vu
     * @param string $type
     * @return array
     */
    public function getExportHead($type = 'sales')
    {
        $heads = config('heading_row');
        return $heads[$type] ?? [];
    }
}
