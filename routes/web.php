<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
| Arabic routes (default, no prefix) and English routes (with /en prefix)
|--------------------------------------------------------------------------
*/

// SEO routes (no locale needed)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /admin/*\n\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
})->name('robots');

// Arabic routes (default language, no prefix)
Route::middleware([SetLocale::class . ':ar', SecurityHeaders::class])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('ar.home');
        Route::get('/products', [ProductController::class, 'index'])->name('ar.products');
        Route::get('/products/{slug}', [ProductController::class, 'show'])->name('ar.product.show');
        Route::get('/services', [ServiceController::class, 'index'])->name('ar.services');
        Route::get('/about', [PageController::class, 'about'])->name('ar.about');
        Route::get('/blog', [BlogController::class, 'index'])->name('ar.blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('ar.blog.show');
        Route::get('/contact', [ContactController::class, 'index'])->name('ar.contact');
        Route::post('/contact', [ContactController::class, 'store'])
            ->middleware('throttle:60,1')
            ->name('ar.contact.store');
    });

// English routes (with /en prefix)
Route::prefix('en')
    ->middleware([SetLocale::class . ':en', SecurityHeaders::class])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('en.home');
        Route::get('/products', [ProductController::class, 'index'])->name('en.products');
        Route::get('/products/{slug}', [ProductController::class, 'show'])->name('en.product.show');
        Route::get('/services', [ServiceController::class, 'index'])->name('en.services');
        Route::get('/about', [PageController::class, 'about'])->name('en.about');
        Route::get('/blog', [BlogController::class, 'index'])->name('en.blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('en.blog.show');
        Route::get('/contact', [ContactController::class, 'index'])->name('en.contact');
        Route::post('/contact', [ContactController::class, 'store'])
            ->middleware('throttle:60,1')
            ->name('en.contact.store');
    });
