<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        Post::factory()->count(6)->create(['published' => true]);

        $response = $this->get('/blog')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts', 6)
            );

        $response->assertStatus(200);
    }


    public function show()
    {
        $post = Post::factory()->create(['title' => "Awesome Post"]);

        $response = $this->get('/blog/' . $post->slug)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Show')
                ->has('post')
            );

        $response->assertStatus(200);
    }

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('wink:migrate');
    }

    public function teardown() : void
    {
        parent::tearDown();
    }
}



