<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\HomepageSection;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::active()->ordered()->get()->keyBy('section_key');
        $products = Product::active()->ordered()->take(5)->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->whereNull('product_id')->take(8)->get();
        $posts = BlogPost::published()->latest('published_at')->take(3)->get();

        return view('pages.home', compact('sections', 'products', 'testimonials', 'faqs', 'posts'));
    }
}
