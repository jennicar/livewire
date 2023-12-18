<?php

namespace App\Providers;

use Src\Store\ShopifyApi;
use Illuminate\Support\ServiceProvider;
use PHPShopify\ShopifySDK;

class ShopifyApiProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ShopifyApi::class, function () {

            $shopify = ShopifySDK::config([
                'ShopUrl' => config('shopify.shop_url'),
                'ApiKey' => config('shopify.api_key'),
                'Password' => config('shopify.password'),
            ]);

            return new ShopifyApi($shopify);
        });
    }
}
