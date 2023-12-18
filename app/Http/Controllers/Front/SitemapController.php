<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Src\Routes\PageRoutes;
use Watson\Sitemap\Facades\Sitemap;

class SitemapController extends Controller
{
    public function index()
    {
        Sitemap::addSitemap(route('sitemap.pages'));
        Sitemap::addSitemap(route('sitemap.blog'));

        return Sitemap::index();
    }

    public function pages()
    {
        foreach (PageRoutes::getData() as $row) {
            Sitemap::addTag($row['url']);
        }

        return Sitemap::render();
    }

    public function blog()
    {
        foreach (Category::getAllHavingPosts() as $category) {
            $latestCategoryPost = Post::published()->categoryId($category->id)->limit(1)->first();
            Sitemap::addTag(
                route("blog.categoryIndex", ['category' => $category->slug]),
                $latestCategoryPost->published_at
            );
        }

        foreach (Post::published()->get() as $post) {
            Sitemap::addTag(route("blog.show", $post), $post->updated_at);
        }

        return Sitemap::render();
    }
}
