<?php

namespace App\Http\Middleware;

use App\Models\BlogPost;
use App\Models\PageVisit;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Increments a counter for the visited public page after the response
 * is built. Skips: non-GET, non-200 responses, prefetches, admin users,
 * obvious bots. Locale is taken from the active app locale, so the
 * Arabic and English variants of the same page count separately.
 */
class TrackPageVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Filter out anything that isn't an interactive page view
        if (! $this->shouldTrack($request, $response)) {
            return $response;
        }

        $resolved = $this->resolvePage($request);
        if ($resolved === null) {
            return $response;
        }

        // Atomic increment — no read-then-write race on busy pages
        $visit = PageVisit::firstOrCreate(
            ['page_key' => $resolved['key'], 'locale' => $resolved['locale']],
            ['label' => $resolved['label'], 'url' => $resolved['url']]
        );

        // Use raw SQL to avoid two queries; updated_at also bumps via Eloquent's increment()
        PageVisit::where('id', $visit->id)->update([
            'visit_count'      => DB::raw('visit_count + 1'),
            'last_visited_at'  => now(),
            // Keep label/url fresh in case the product or post was renamed
            'label'            => $resolved['label'],
            'url'              => $resolved['url'],
        ]);

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }
        if ($response->getStatusCode() !== 200) {
            return false;
        }
        // Skip browser prefetch / link previews
        if ($request->headers->get('Purpose') === 'prefetch' || $request->headers->get('Sec-Purpose') === 'prefetch') {
            return false;
        }
        // Don't count logged-in admins browsing their own site
        if (auth()->check()) {
            return false;
        }
        // Cheap bot heuristic — most well-behaved bots set this
        $ua = strtolower((string) $request->userAgent());
        if ($ua === '' || str_contains($ua, 'bot') || str_contains($ua, 'crawler') || str_contains($ua, 'spider')) {
            return false;
        }
        return true;
    }

    /**
     * Map the current route to a stable page_key + human label.
     * Returns null for routes we don't track (admin, sitemap, robots).
     *
     * @return array{key:string, label:string, url:string, locale:string}|null
     */
    private function resolvePage(Request $request): ?array
    {
        $route = $request->route();
        if (! $route) {
            return null;
        }

        $name = $route->getName() ?? '';
        // Locale-aware routes are prefixed with `ar.` or `en.`
        if (! preg_match('/^(ar|en)\.(.+)$/', $name, $m)) {
            return null;
        }

        $locale = $m[1];
        $action = $m[2];
        $url    = $request->url();

        return match (true) {
            $action === 'home'         => ['key' => 'home',     'label' => 'Home',      'url' => $url, 'locale' => $locale],
            $action === 'products'     => ['key' => 'products', 'label' => 'Products',  'url' => $url, 'locale' => $locale],
            $action === 'services'     => ['key' => 'services', 'label' => 'Services',  'url' => $url, 'locale' => $locale],
            $action === 'about'        => ['key' => 'about',    'label' => 'About',     'url' => $url, 'locale' => $locale],
            $action === 'blog'         => ['key' => 'blog',     'label' => 'Blog',      'url' => $url, 'locale' => $locale],
            $action === 'contact'      => ['key' => 'contact',  'label' => 'Contact',   'url' => $url, 'locale' => $locale],

            $action === 'product.show' => $this->productPage($route->parameter('slug'), $locale, $url),
            $action === 'blog.show'    => $this->blogPage($route->parameter('slug'), $locale, $url),

            default => null,
        };
    }

    private function productPage(?string $slug, string $locale, string $url): ?array
    {
        if (! $slug) {
            return null;
        }
        $product = Product::where('slug_ar', $slug)
            ->orWhere('slug_en', $slug)
            ->first();
        $title = $product
            ? ($locale === 'ar' ? $product->title_ar : $product->title_en)
            : $slug;
        return [
            'key'    => 'product:' . $slug,
            'label'  => 'Product · ' . $title,
            'url'    => $url,
            'locale' => $locale,
        ];
    }

    private function blogPage(?string $slug, string $locale, string $url): ?array
    {
        if (! $slug) {
            return null;
        }
        $post = BlogPost::where('slug_ar', $slug)
            ->orWhere('slug_en', $slug)
            ->first();
        $title = $post
            ? ($locale === 'ar' ? $post->title_ar : $post->title_en)
            : $slug;
        return [
            'key'    => 'blog:' . $slug,
            'label'  => 'Blog · ' . $title,
            'url'    => $url,
            'locale' => $locale,
        ];
    }
}
