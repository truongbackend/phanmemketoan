<?php

namespace App\Services;

use App\Repositories\ShopeeShopDataRepository;
use Illuminate\Support\Facades\Http;

class TikTokShopService
{
    protected $host;

    public function getAuthorisationLink()
    {
        return config('services.tiktokshop.authorisation_link');
    }
}