<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share common data with every view (so page-level @section('seo') blocks see $settings too)
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $settings = null, $headerMenu = null, $footerMenu = null;

            $settings ??= \App\Models\SiteSetting::all()->pluck('value', 'key');
            $headerMenu ??= \App\Models\MenuItem::active()->header()->ordered()->get();
            $footerMenu ??= \App\Models\MenuItem::active()->footer()->ordered()->get();

            $view->with('settings', $settings);
            $view->with('headerMenu', $headerMenu);
            $view->with('footerMenu', $footerMenu);
            $view->with('locale', app()->getLocale());
            $view->with('isRtl', app()->getLocale() === 'ar');
        });
    }
}
