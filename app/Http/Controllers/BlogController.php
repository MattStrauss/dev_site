<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        return Inertia::render('Blog/Index',
            [
                'posts' => $this->getBlogPosts(),
                'filters' => Request::only(['search', 'tag']),
            ]);
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
        return Post::query()
            ->when(Request::input("search"), function ($query, $search) {
                $query->where('body', 'like', "%" . $search . "%");
            })
            ->when(Request::input("tag"), function ($query, $tag) {
                $query->whereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('name', $tag);
                })->get();
            })
            ->with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')
            ->paginate(3)
            ->withQueryString();
    }
}
