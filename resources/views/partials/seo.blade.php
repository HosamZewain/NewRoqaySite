<title>{{ $seoTitle ?? ($isRtl ? ($settings['default_seo_title_ar'] ?? 'رقي') : ($settings['default_seo_title_en'] ?? 'RoQay')) }}</title>
<meta name="description" content="{{ $seoDescription ?? ($isRtl ? ($settings['default_seo_description_ar'] ?? '') : ($settings['default_seo_description_en'] ?? '')) }}">
<meta name="keywords" content="{{ $seoKeywords ?? ($isRtl ? ($settings['default_seo_keywords_ar'] ?? '') : ($settings['default_seo_keywords_en'] ?? '')) }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:url" content="{{ request()->url() }}">
<meta property="og:title" content="{{ $seoTitle ?? ($isRtl ? ($settings['default_seo_title_ar'] ?? 'رقي') : ($settings['default_seo_title_en'] ?? 'RoQay')) }}">
<meta property="og:description" content="{{ $seoDescription ?? ($isRtl ? ($settings['default_seo_description_ar'] ?? '') : ($settings['default_seo_description_en'] ?? '')) }}">
<meta property="og:image" content="{{ isset($seoImage) ? asset('storage/' . $seoImage) : asset('images/default-og.jpg') }}">
<meta property="og:locale" content="{{ $isRtl ? 'ar_SA' : 'en_US' }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ request()->url() }}">
<meta property="twitter:title" content="{{ $seoTitle ?? ($isRtl ? ($settings['default_seo_title_ar'] ?? 'رقي') : ($settings['default_seo_title_en'] ?? 'RoQay')) }}">
<meta property="twitter:description" content="{{ $seoDescription ?? ($isRtl ? ($settings['default_seo_description_ar'] ?? '') : ($settings['default_seo_description_en'] ?? '')) }}">
<meta property="twitter:image" content="{{ isset($seoImage) ? asset('storage/' . $seoImage) : asset('images/default-og.jpg') }}">

<!-- Canonical and Alternates -->
<link rel="canonical" href="{{ $canonicalUrl ?? request()->url() }}" />

@if(isset($alternateUrl))
    <link rel="alternate" hreflang="{{ $isRtl ? 'en' : 'ar' }}" href="{{ $alternateUrl }}" />
@else
    @if($locale === 'ar')
        <link rel="alternate" hreflang="en" href="{{ str_replace(url('/'), url('/en'), request()->url()) }}" />
    @else
        <link rel="alternate" hreflang="ar" href="{{ str_replace(url('/en'), url('/'), request()->url()) }}" />
    @endif
@endif
<link rel="alternate" hreflang="x-default" href="{{ str_replace(url('/en'), url('/'), request()->url()) }}" />

<!-- Favicon (prefers brand PNG, falls back to bundled SVG) -->
@if(!empty($settings['favicon']))
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings['favicon']) }}">
@else
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
@endif
