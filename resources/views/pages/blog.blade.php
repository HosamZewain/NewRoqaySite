@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? 'المدونة' : 'Blog') . ' | ' . ($settings['site_name_'.$locale] ?? 'RoQay')
    ])
@endsection

@section('content')
    <section class="bg-[#0a1628] pt-32 pb-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            @include('partials.breadcrumbs', ['items' => [['label' => $isRtl ? 'المدونة' : 'Blog']]])
            <h1 class="text-4xl md:text-5xl font-bold text-white mt-6 mb-4">{{ $isRtl ? 'المدونة التقنية' : 'Tech Blog' }}</h1>
        </div>
    </section>

    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all group">
                    <a href="{{ route($locale . '.blog.show', $isRtl ? $post->slug_ar : $post->slug_en) }}" class="block h-48 overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $isRtl ? $post->title_ar : $post->title_en }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                <span class="material-icons-round text-4xl text-blue-300">article</span>
                            </div>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                            <span class="material-icons-round text-sm">calendar_today</span>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3">
                            <a href="{{ route($locale . '.blog.show', $isRtl ? $post->slug_ar : $post->slug_en) }}" class="hover:text-blue-600 transition-colors">
                                {{ $isRtl ? $post->title_ar : $post->title_en }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ $isRtl ? $post->excerpt_ar : $post->excerpt_en }}</p>
                    </div>
                </article>
                @endforeach
            </div>

            @if($posts->hasPages())
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
