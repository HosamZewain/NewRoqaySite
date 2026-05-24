@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? 'خدماتنا' : 'Our Services') . ' | ' . ($settings['site_name_'.$locale] ?? 'RoQay')
    ])
@endsection

@section('content')
    <section class="bg-[#0a1628] pt-32 pb-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            @include('partials.breadcrumbs', ['items' => [['label' => $isRtl ? 'الخدمات' : 'Services']]])
            <h1 class="text-4xl md:text-5xl font-bold text-white mt-6 mb-4">{{ $isRtl ? 'الخدمات التقنية' : 'Tech Services' }}</h1>
        </div>
    </section>

    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl transition-all">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <span class="material-icons-round text-3xl">{{ $service->icon ?? 'design_services' }}</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $isRtl ? $service->title_ar : $service->title_en }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ $isRtl ? $service->short_description_ar : $service->short_description_en }}</p>
            </div>
            @endforeach
        </div>
    </section>
@endsection
