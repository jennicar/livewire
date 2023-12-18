<?php

namespace Src\Store;

use PHPShopify\ShopifySDK;

class ShopifyApi
{
    private ShopifySDK $shopify;

    public function __construct(ShopifySDK $shopify)
    {
        $this->shopify = $shopify;
    }

    public function getProducts(): array
    {
        return $this->shopify->Product->get();
    }

    public function getProduct(string $handle)
    {
        return $this->shopify->Product->get(['handle' => $handle]);
    }
}
