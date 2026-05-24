<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $products = Product::active()->ordered()->get();
        $services = Service::active()->get();
        $posts = BlogPost::published()->get();

        $content = view('seo.sitemap', compact('products', 'services', 'posts'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
