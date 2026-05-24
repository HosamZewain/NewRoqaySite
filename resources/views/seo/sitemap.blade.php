<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @php
        $staticPages = [
            ['ar' => route('ar.home'),     'en' => route('en.home'),     'priority' => '1.0', 'changefreq' => 'daily'],
            ['ar' => route('ar.products'), 'en' => route('en.products'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['ar' => route('ar.services'), 'en' => route('en.services'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['ar' => route('ar.about'),    'en' => route('en.about'),    'priority' => '0.7', 'changefreq' => 'monthly'],
            ['ar' => route('ar.blog'),     'en' => route('en.blog'),     'priority' => '0.8', 'changefreq' => 'weekly'],
            ['ar' => route('ar.contact'),  'en' => route('en.contact'),  'priority' => '0.6', 'changefreq' => 'monthly'],
        ];
    @endphp
    @foreach($staticPages as $page)
    <url>
        <loc>{{ $page['ar'] }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ $page['ar'] }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ $page['en'] }}" />
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $page['ar'] }}" />
    </url>
    <url>
        <loc>{{ $page['en'] }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ $page['ar'] }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ $page['en'] }}" />
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $page['ar'] }}" />
    </url>
    @endforeach

    @foreach($products as $product)
    <url>
        <loc>{{ route('ar.product.show', $product->slug_ar) }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('ar.product.show', $product->slug_ar) }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('en.product.show', $product->slug_en) }}" />
    </url>
    <url>
        <loc>{{ route('en.product.show', $product->slug_en) }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('ar.product.show', $product->slug_ar) }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('en.product.show', $product->slug_en) }}" />
    </url>
    @endforeach

    @foreach($posts as $post)
    <url>
        <loc>{{ route('ar.blog.show', $post->slug_ar) }}</loc>
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('ar.blog.show', $post->slug_ar) }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('en.blog.show', $post->slug_en) }}" />
    </url>
    <url>
        <loc>{{ route('en.blog.show', $post->slug_en) }}</loc>
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('ar.blog.show', $post->slug_ar) }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('en.blog.show', $post->slug_en) }}" />
    </url>
    @endforeach
</urlset>
