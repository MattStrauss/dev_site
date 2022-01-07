<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wink\WinkPost;

class Post extends WinkPost
{

    protected $appends = ['readTime'];

    protected $casts = [
        'created_at' => 'datetime:Y/m/d',
    ];

    public function getReadTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, (int) floor($wordCount / 150));
    }

}
