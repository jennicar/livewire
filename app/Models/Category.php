<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function getAllHavingPosts(): Collection
    {
        $data = DB::select("
            SELECT
                categories.id as id,
                categories.name as name,
                categories.slug as slug,
                count(categories.id) as post_count
            FROM posts
            JOIN categories ON categories.id = posts.category_id
            WHERE published_at IS NOT NULL AND published_at <= NOW() AND deleted_at IS NULL
            GROUP BY categories.id;
        ");

        return new Collection($data);
    }
}
