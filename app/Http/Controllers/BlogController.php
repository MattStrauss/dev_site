<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        return Inertia::render('Blog/Index', ['posts' => $this->getBlogPosts()]);
    }

    public function show($slug)
    {
        $post = Post::with('tags')
        ->live()->whereSlug($slug)->first();

        if (! $post) {
            return Inertia::render('Blog/Index', ['error' => true, 'posts' => $this->getBlogPosts()]);
        }

        return Inertia::render('Blog/Show', ['post' => $post]);
    }

    private function getBlogPosts()
    {
        return Post::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')->paginate(3);
    }
}
