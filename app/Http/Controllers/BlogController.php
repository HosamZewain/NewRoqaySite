<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->latest('published_at')
            ->paginate(9);

        return view('pages.blog', compact('posts'));
    }

    public function show(string $slug)
    {
        $locale = app()->getLocale();
        $slugField = 'slug_' . $locale;

        $post = BlogPost::where($slugField, $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->when($post->category, fn($q) => $q->where('category', $post->category))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.blog-show', compact('post', 'relatedPosts'));
    }
}
