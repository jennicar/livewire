<?php

namespace App\Providers;

use Src\Images\ContentImageServer;
use Src\Images\StaticImageServer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ContentImageServer::class, function ($app) {
            $server =  ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => Storage::disk(config('filesystems.cloud'))->getDriver(),
                'cache' => Storage::disk(config('filesystems.local'))->getDriver(),
                'cache_path_prefix' => '.glide-cache/content/',
                'base_url' => 'img',
                'defaults' => [
                    'q' => '75',
                ],
            ]);

            return new ContentImageServer($server);
        });

        $this->app->singleton(StaticImageServer::class, function ($app) {
            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => Storage::disk('public-static')->getDriver(),
                'cache' => Storage::disk(config('filesystems.local'))->getDriver(),
                'cache_path_prefix' => '.glide-cache/static/',
                'base_url' => 'img',
                'defaults' => [
                    'q' => '75',
                ],
            ]);

            return new StaticImageServer($server);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
