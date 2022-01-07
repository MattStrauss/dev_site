<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;


class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')->get();

        return Inertia::render('Blog/Index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::live()->whereSlug($slug)->first();

        if (! $post) {
            flash()->error('Post not found.');
            return redirect()->route('blog.index');
        }

        return Inertia::render('Home', ['post' => $post]);
    }
}
