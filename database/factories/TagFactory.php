<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Wink\WinkTag;

class TagFactory extends Factory
{

    protected $model = Tag::class;


    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'name' => strtolower($this->faker->word),
            'slug' => strtolower($this->faker->word),
        ];
    }
}
