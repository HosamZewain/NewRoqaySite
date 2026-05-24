<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->ordered()->get();
        $locale = app()->getLocale();

        return view('pages.products', compact('products', 'locale'));
    }

    public function show(string $slug)
    {
        $locale = app()->getLocale();
        $slugField = 'slug_' . $locale;

        $product = Product::where($slugField, $slug)->where('is_active', true)->firstOrFail();
        $faqs = Faq::active()->ordered()->where('product_id', $product->id)->get();
        $relatedProducts = Product::active()->ordered()
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        // Dedicated, hand-crafted page for the flagship iRes restaurant system
        if ($product->slug_ar === 'ires-system' || $product->slug_en === 'ires-system') {
            return view('pages.ires-system', compact('product', 'faqs', 'relatedProducts', 'locale'));
        }

        return view('pages.product-show', compact('product', 'faqs', 'relatedProducts', 'locale'));
    }
}
