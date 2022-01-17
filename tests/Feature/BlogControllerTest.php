<?php

namespace Tests\Feature;

use App\Http\Controllers\BlogController;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    private int $paginationNumber;

    /** @test */
    public function index()
    {
        Post::factory()->count($this->paginationNumber)->create(['published' => true]);

        $response = $this->get('/blog')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', $this->paginationNumber)
                ->has('filters', 0)
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexCheckPagination()
    {
        Post::factory()->count($this->paginationNumber + 10)->create(['published' => true]);

        $response = $this->get('/blog')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', $this->paginationNumber)
                ->has('filters', 0)
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexCheckPaginationSecondPage()
    {
        Post::factory()->count($this->paginationNumber + 3)->create(['published' => true]);

        $response = $this->get('/blog?page=2')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', 3)
                ->has('filters', 0)
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexCheckSearchWorksCorrectly()
    {
        Post::factory()->count($this->paginationNumber - 3)->create(['published' => true, 'body' => "certxy"]);
        Post::factory()->count(2)->create(['published' => true]);

        $response = $this->get('/blog?search=certxy')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', $this->paginationNumber - 3)
                ->has('filters', 1)
                ->where('filters', ['search' => 'certxy'])
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexCheckSearchWorksCorrectly_2()
    {
        Post::factory()->count(3)->create(['published' => true]);

        $response = $this->get('/blog?search=zzzzzzzzzzzzzz')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', 0)
                ->has('filters', 1)
                ->where('filters', ['search' => 'zzzzzzzzzzzzzz'])
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexCheckSearchWorksCorrectly_3()
    {
        Post::factory()->count($this->paginationNumber - 2)->create(['published' => true, 'title' => "wjdue"]);
        Post::factory()->count(2)->create(['published' => true]);

        $response = $this->get('/blog?search=wjdue')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', $this->paginationNumber - 2)
                ->has('filters', 1)
                ->where('filters', ['search' => 'wjdue'])
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexCheckSearchWorksCorrectly_4()
    {
        Post::factory()->count($this->paginationNumber - 2)->create(['published' => true, 'title' => "xretfd"]);
        Post::factory()->count(2)->create(['published' => true, 'body' => "xretfd"]);

        $response = $this->get('/blog?search=xretfd')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', $this->paginationNumber)
                ->has('filters', 1)
                ->where('filters', ['search' => 'xretfd'])
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexTagsFilteringWorksCorrectly()
    {
        Post::factory()->count($this->paginationNumber - 3)->hasTags(1, [
            'name' => 'testing-tag',
        ])->create(['published' => true]);

        Post::factory()->count(3)->create(['published' => true]);

        $response = $this->get('/blog?tag=testing-tag')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', $this->paginationNumber - 3)
                ->has('filters', 1)
                ->where('filters', ['tag' => 'testing-tag'])
            );

        $response->assertStatus(200);
    }

    /** @test */
    public function indexTagsFilteringWorksCorrectly_2()
    {
        Post::factory()->count(2)->create(['published' => true]);

        $response = $this->get('/blog?tag=testing-tag')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blog/Index')
                ->has('posts.data', 0)
                ->has('filters', 1)
                ->where('filters', ['tag' => 'testing-tag'])
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
        $this->paginationNumber = BlogController::getPaginationNumber();
    }

    public function teardown() : void
    {
        parent::tearDown();
    }
}





