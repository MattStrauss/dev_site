<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wink\WinkTag;

class Tag extends WinkTag
{
    use HasFactory;

    // only included for testing purposes at the moment...


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'wink_posts_tags', 'tag_id', 'post_id');
    }

}

