<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
