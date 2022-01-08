<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wink\WinkPost;

class Post extends WinkPost
{

    use HasFactory;

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
