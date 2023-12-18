<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $dates = ['published_at'];

    protected $casts = [
        'published_at' => 'date',
        'created_at' => 'date',
        'updated_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function getSnippet($length = 160)
    {
        // if our post has something like <p>abc cde</p><p>whatever</p>
        // we want "abc cde whatever", NOT "abc cdewhatever".. so:
        $snippet = str_replace('<', ' <', $this->content);

        return Str::limit(strip_tags($snippet), $length);
    }

    public function getUrl()
    {
        return route('blog.show', ['post' => $this]);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('published_at', '<=', Carbon::now())
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc');
    }

    public function scopeCategory(Builder $query, Category $category): Builder
    {
        return $query->where('category_id', $category->id);
    }

    public function scopeCategoryId(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeNewToOld(Builder $query): Builder
    {
        return $query->orderBy('published_at', 'desc');
    }
}
