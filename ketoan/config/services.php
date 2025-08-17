<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'shopee' => [
        'host' => env('SHOPEE_API_HOST', 'https://partner.test-stable.shopeemobile.com'),
        'partner_id' => env('SHOPEE_PARTNER_ID', '1280537'),
        'partner_key' => env('SHOPEE_PARTNER_KEY', 'shpk5a424d7a6a5553766f52445a4a46734c724c78564e637a54624668534d79'),
    ],

    'tiktokshop' => [
        'authorisation_link' => env('TIKTOK_SHOP_API_HOST', 'https://services.tiktokshop.com/open/authorize'),
        'authorisation_service_id' => env('TIKTOK_SHOP_AUTHORISATION_SERVICE_ID', '7484171759699445509'),
        'app_key' => env('TIKTOK_SHOP_APP_KEY', '6fmlfsk9o594g'),
        'app_secret' => env('TIKTOK_SHOP_APP_SECRET', 'b7a47b9668131c7a19e2909bc67e84654f81c241'),
        'tiktok_api_url' => 'https://auth.tiktok-shops.com/api',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
