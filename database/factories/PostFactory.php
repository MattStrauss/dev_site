<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wink\WinkAuthor;

class PostFactory extends Factory
{

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'title' => $this->faker->sentence(10),
            'excerpt' => $this->faker->text,
            'slug' => $this->faker->slug,
            'body' => $this->faker->paragraph,
            'published' => '1',
            'markdown' => '0',
            'author_id' => $this->getAuthor(),
            'featured_image' => null,
            'featured_image_caption' => "",
            'publish_date' => $this->faker->date,
            'meta' => null,
        ];
    }

    private function getAuthor()
    {
        $author = WinkAuthor::create([
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'email' => $this->faker->safeEmail,
            'bio' => $this->faker->sentence,
            'avatar' => null,
            'password' => 'password',
        ]);

        return $author->id;
    }
}
