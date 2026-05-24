@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? $post->seo_title_ar : $post->seo_title_en) ?: ($isRtl ? $post->title_ar : $post->title_en) . ' | ' . ($settings['site_name_'.$locale] ?? 'RoQay')
    ])
@endsection

@section('content')
    <section class="bg-white pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.breadcrumbs', ['items' => [
                ['label' => $isRtl ? 'المدونة' : 'Blog', 'url' => route($locale . '.blog')],
                ['label' => $isRtl ? $post->title_ar : $post->title_en]
            ]])
            
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mt-8 mb-6">{{ $isRtl ? $post->title_ar : $post->title_en }}</h1>
            
            <div class="flex items-center gap-6 text-gray-500 mb-10 border-b border-gray-100 pb-6">
                <div class="flex items-center gap-2">
                    <span class="material-icons-round text-sm">calendar_today</span>
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}
                </div>
                @if($post->author_name)
                <div class="flex items-center gap-2">
                    <span class="material-icons-round text-sm">person</span>
                    {{ $post->author_name }}
                </div>
                @endif
            </div>

            @if($post->featured_image)
            <div class="rounded-2xl overflow-hidden mb-10 shadow-lg">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="" class="w-full h-auto object-cover max-h-[500px]">
            </div>
            @endif

            <div class="prose prose-lg prose-blue max-w-none text-gray-600 leading-loose">
                {!! $isRtl ? $post->content_ar : $post->content_en !!}
            </div>
        </div>
    </section>
@endsection
