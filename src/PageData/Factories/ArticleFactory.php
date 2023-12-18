<?php

namespace Src\PageData\Factories;

use App\Models\Post;
use Src\PageData\Models\Article;
use Src\PageData\Models\Author;
use Src\PageData\Models\Image;
use Src\PageData\Models\Meta;
use Src\PageData\Models\Publisher;
use Src\PageData\Models\Timestamps;

class ArticleFactory
{
    public static function fromPost(Post $post)
    {
        $author = new Author(
            $post->author->name,
            $post->author->photo,
            'Person'
        );

        $publisher = new Publisher(
            'btp-laravel-base',
            'btp-laravel-base',
        );

        $timestamps = new Timestamps(
            $post->created_at,
            $post->updated_at,
            $post->published_at
        );

        $image = new Image(
            "/$post->photo",
            ($post->photo_description ? $post->photo_description : $post->title)
        );

        $metaData = new Meta(
            $post->title,
            $post->description ? $post->description : $post->getSnippet(),
            $post->getUrl(),
            $image,
            'article'
        );

        return new Article($metaData, $author, $publisher, $timestamps, $post->content);
    }
}
