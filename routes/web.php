<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Front')->group(function () {

    Route::middleware(['noindex'])->group(function () {
        Route::get('/sitemap.xml', 'SitemapController@index');
        Route::get('/blog-sitemap.xml', 'SitemapController@blog')->name('sitemap.blog');
        Route::get('/page-sitemap.xml', 'SitemapController@pages')->name('sitemap.pages');
    });

    // Static Pages
    Route::get('/', 'PageController@home')->name('home');

    // Shop
    Route::get('/shop', 'ShopController@index')->name('shop.index');
    Route::get('/shop/{handle}', 'ShopController@show')->name('shop.show');
    Route::get('/cart', 'ShopController@cart')->name('shop.cart');

    // Generic Blog Routes
    Route::get('/blog', 'BlogController@index')->name('blog.index');
    Route::get('/blog/{post:slug}', 'BlogController@show')->name('blog.show');
    Route::get('/blog/c/{category:slug}', 'BlogController@categoryIndex')->name('blog.categoryIndex');
    Route::get('/blog/more/{offset}/{category?}', 'BlogController@indexMore');

    // Image routes
    Route::get('/img/static/{path}', 'ImageController@showStatic')->where('path', '.*')->name('static.image');
    Route::get('/img/{path}', 'ImageController@show')->where('path', '.*')->name('image');
});
