<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Src\PageData\Models\Meta;
use Src\Store\ShopifyApi;

class ShopController extends FrontController
{
    public function index(ShopifyApi $shopifyApi)
    {
        $products = cache()->remember('products', 60 * 5, function () use ($shopifyApi) {
            return $shopifyApi->getProducts();
        });

        $metaData = new Meta(
            'btp-laravel-base',
            'btp-laravel-base',
            route('shop.index'),
        );

        return view('front.shop.index', [
            'products' => $products,
            'metaData' => $metaData,
        ]);
    }

    public function show(ShopifyApi $shopifyApi, Request $request)
    {

        $product = $shopifyApi->getProduct($request->handle)[0];
        $product_name = $product['title'];
        $product_description = strip_tags($product['body_html']);
        $product_price = $product['variants'][0]['price'];
        $product_quantity_available = $product['variants'][0]['inventory_quantity'];

        $metaData = new Meta(
            $product_name,
            $product_description,
            route('shop.show', ['handle' => $request->handle]),
        );

        return view('front.shop.show', [
            'metaData' => $metaData,
            'product' => $product,
            'product_description' => $product_description,
            'product_price' => $product_price,
            'product_quantity_available' => $product_quantity_available,
        ]);
    }

    public function cart()
    {
        $metaData = new Meta(
            'btp-laravel-base',
            'btp-laravel-base',
            route('shop.cart'),
        );

        return view('front.shop.cart', [
            'metaData' => $metaData,
        ]);
    }
}
