<?php

namespace App\Http\Controllers\TikTokShop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TikTokShopService;

class TikTokShopController extends Controller
{
    protected $tiktokShopService;

    public function __construct(TikTokShopService $tiktokShopService)
    {
        $this->tiktokShopService = $tiktokShopService;
    }

    public function getAuthShopUrl(Request $request)
    {
        $authorisation_link = $this->tiktokShopService->getAuthorisationLink();

        return response()->json([
            'status' => true,
            'data' => $authorisation_link
        ]);
    }
}
