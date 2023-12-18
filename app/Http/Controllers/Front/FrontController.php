<?php

namespace App\Http\Controllers\Front;

use Src\Breadcrumbs\Models\Breadcrumb;
use Src\Breadcrumbs\Models\Breadcrumbs;
use Src\PageData\Models\Image;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

abstract class FrontController extends BaseController
{
    protected Breadcrumbs $breadcrumbs;

    protected Image $baseSiteImage;

    public function __construct()
    {
        $this->breadcrumbs = new Breadcrumbs();
        $this->breadcrumbs->add(new Breadcrumb(route('home'), 'btp-laravel-base'));

        $this->baseSiteImage = new Image(
            'static/global/btp-laravel-base.jpg',
            'btp-laravel-base'
        );

        $this->criticalCSS = inlineCssFile('css-critical/' . Route::getCurrentRoute()->getName() . '.css');

        View::share([
            'breadcrumbs' => $this->breadcrumbs,
            'criticalCSS' => $this->criticalCSS,
            'image' => $this->baseSiteImage,
        ]);
    }
}
