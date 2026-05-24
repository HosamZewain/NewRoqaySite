@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? $page->seo_title_ar : $page->seo_title_en) ?: ($isRtl ? $page->title_ar : $page->title_en) . ' | ' . ($settings['site_name_'.$locale] ?? 'RoQay')
    ])
@endsection

@section('content')
    <section class="bg-[#0a1628] pt-32 pb-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            @include('partials.breadcrumbs', ['items' => [['label' => $isRtl ? $page->title_ar : $page->title_en]]])
            <h1 class="text-4xl md:text-5xl font-bold text-white mt-6 mb-4">{{ $isRtl ? $page->title_ar : $page->title_en }}</h1>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg prose-blue max-w-none text-gray-600 leading-loose">
                {!! $isRtl ? $page->content_ar : $page->content_en !!}
            </div>
        </div>
    </section>
@endsection
