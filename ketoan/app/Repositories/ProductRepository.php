<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function findBySku($sku)
    {
        return Product::where('sku', $sku)->first();
    }

    public function findBySkus($skus)
    {
        return Product::whereIn('sku', $skus)->get();
    }

    public function getAllSkus()
    {
        return Product::pluck('sku')->toArray();
    }

    public function findMissingSkus($skus)
    {
        $query = Product::query();
        $query->whereIn('sku', $skus);

        $existingSkus = $query->pluck('sku')->toArray();
        $records = $query->with('details')->get();

        return [
            'missing_skus' => array_diff($skus, $existingSkus),
            'records' => !empty($records) ? $records->toArray() : []
        ];
    }
} 