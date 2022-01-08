<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
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


   /** @test */
    public function show()
    {
        $post = Post::factory()
            ->has(Tag::factory()->count(2))
            ->create(['title' => "Awesome Post", 'published' => '1']);


        $response = $this->get('/blog/' . $post->slug)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Show')
                ->has('post')
                ->where('post.id', $post->id)
                ->where('post.title', $post->title)
                ->where('post.tags', $post->tags)
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function showReturnedToBlogIndexBecauseSlugDoesntExist()
    {
        $response = $this->get('/blog/non-existent-slug')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts')
                ->where('error', true)
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





