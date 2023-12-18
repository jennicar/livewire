<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Carbon\Carbon;
use Src\Breadcrumbs\Models\Breadcrumb;
use Src\PageData\Factories\ArticleFactory;
use App\Models\Category;
use Src\PageData\Models\Image;
use Src\PageData\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends FrontController
{
    public static $postsPerPage = 8;

    public function __construct()
    {

        parent::__construct();

        $this->breadcrumbs->add(new Breadcrumb(route('blog.index'), 'Blog'));
    }

    public function index(Request $request)
    {
        if ($request->has('page')) {
            $page = intval($request->query('page'), 10);
            self::$postsPerPage = ($page + 1) * 8;
        }

        $blogs = Post::published()
            ->with(['author', 'category'])
            ->limit(self::$postsPerPage + 1)
            ->newToOld()
            ->get();

        $categories = Category::getAllHavingPosts();

        $metaData = new Meta(
            'btp-laravel-base',
            'btp-laravel-base',
            route("blog.index"),
        );

        return view('front.blog.index', [
            'posts' => $blogs->slice(0, self::$postsPerPage),
            'categories' => $categories,
            'morePosts' => count($blogs) > self::$postsPerPage,
            'metaData' => $metaData,
        ]);
    }

    public function indexMore(int $offset, Category $category = null)
    {
        $query = Post::published()
            ->with(['author', 'category'])
            ->limit(self::$postsPerPage + 1)
            ->newToOld()
            ->offset($offset);

        if ($category) {
            $query->category($category);
        }

        $posts = $query->get();

        $html = view('front.blog.more', [
            'posts' => $posts->slice(0, self::$postsPerPage)
        ])->render();

        return response()->json([
            'html' => $html,
            'more' => count($posts) > self::$postsPerPage
        ]);
    }

    public function categoryIndex(Category $category)
    {
        $this->breadcrumbs->add(
            new Breadcrumb(
                route('blog.categoryIndex', ['category' => $category]),
                $category->name
            )
        );

        $posts = Post::published()
            ->category($category)
            ->with(['author', 'category'])
            ->limit(self::$postsPerPage + 1)
            ->newToOld()
            ->get();

        $categories = Category::getAllHavingPosts();

        $metaData = new Meta(
            $category->name,
            $category->description,
            route("blog.categoryIndex", ['category' => $category]),
            $category->photo ? new Image("/$category->photo", $category->name) : null,
        );

        return view('front.blog.index', [
            'posts' => $posts->slice(0, self::$postsPerPage),
            'categories' => $categories,
            'category' => $category,
            'morePosts' => count($posts) > self::$postsPerPage,
            'metaData' => $metaData,
        ]);
    }

    public function show(Post $post, Request $request)
    {
        if ((!$post->published_at || $post->published_at >= Carbon::now()) && !Auth::user()) {
            abort(404);
        }

        $this->breadcrumbs->add(new Breadcrumb(route('blog.show', ['post' => $post]), $post->title));

        $articleMetaData = ArticleFactory::fromPost($post);

        $categories = Category::getAllHavingPosts();

        $posts = Post::published()
            ->with(['author', 'category'])
            ->limit(self::$postsPerPage)
            ->category($post->category)
            ->get();

        return view('front.blog.show', [
            'relatedPosts' => $posts,
            'post' => $post,
            'categories' => $categories,
            'articleMetaData' => $articleMetaData
        ]);
    }
}
