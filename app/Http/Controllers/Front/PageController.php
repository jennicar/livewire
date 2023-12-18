<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Src\PageData\Models\Image;
use Src\PageData\Models\Meta;

class PageController extends FrontController
{
    public function home()
    {
        $posts = Post::published()
            ->with(['author', 'category'])
            ->newToOld()
            ->limit(8)
            ->get();


        $metaData = new Meta(
            'btp-laravel-base',
            'btp-laravel-base',
            route('home'),
        );

        return view('front.pages.home', [
            'posts' => $posts,
            'metaData' => $metaData,
        ]);
    }

    public function design()
    {
        return view('development.pages.design');
    }
}
