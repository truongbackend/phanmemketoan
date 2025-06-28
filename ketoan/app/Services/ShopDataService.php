<?php
namespace App\Services;

use App\Repositories\ShopDataRepository;

class ShopDataService
{
    protected $repo;
    public function __construct(ShopDataRepository $repo)
    {
        $this->repo = $repo;
    }

    public function saveOrUpdateLazadaShopToken($data)
    {
        return $this->repo->createOrUpdateBySellerId($data);
    }

    public function getBySellerId($sellerId)
    {
        return $this->repo->findBySellerId($sellerId);
    }

    public function getByUserId($userId)
    {
        return $this->repo->findByUserId($userId);
    }

    public function getTokenByAuthUserId($userId)
    {
        $find = $this->repo->findByAuthUserId($userId);
        if (!$find) {
            throw new \Exception('No Lazada token found for user ID: ' . $userId);
        }
        return $find->access_token;
    }
}