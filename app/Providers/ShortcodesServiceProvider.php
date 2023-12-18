<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Shortcodes\ButtonShortcode;
use Shortcode;

class ShortcodesServiceProvider extends ServiceProvider
{
    public function register()
    {
        Shortcode::register('button', ButtonShortcode::class);
    }

    public function boot()
    {
        //
    }
}
