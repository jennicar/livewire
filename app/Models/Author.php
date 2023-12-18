<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
