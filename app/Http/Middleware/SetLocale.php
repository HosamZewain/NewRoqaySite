<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $locale = 'ar'): Response
    {
        app()->setLocale($locale);

        // Share direction with all views
        $direction = $locale === 'ar' ? 'rtl' : 'ltr';
        view()->share('locale', $locale);
        view()->share('dir', $direction);
        view()->share('isRtl', $locale === 'ar');

        return $next($request);
    }
}
