<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function validateSkus($skus)
    {
        if (empty($skus)) {
            return [
                'valid' => true,
                'missing_skus' => [],
                'message' => 'No SKUs to validate'
            ];
        }

        $result = $this->repo->findMissingSkus($skus);

        if (!empty($result['missing_skus'])) {
            return [
                'valid' => false,
                'missing_skus' => $result['missing_skus'],
                'message' => 'The following SKUs do not exist in the product database: ' . implode(', ', $result['missing_skus']),
            ];
        }

        return [
            'valid' => true,
            'missing_skus' => [],
            'message' => 'All SKUs are valid',
            'records' => $result['records']
        ];
    }

    public function getProductsBySkus($skus)
    {
        return $this->repo->findBySkus($skus);
    }

    public function getProductBySku($sku)
    {
        return $this->repo->findBySku($sku);
    }

    public function getAllSkus()
    {
        return $this->repo->getAllSkus();
    }
} 