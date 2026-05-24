@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? 'منتجات رقي' : 'RoQay Products') . ' | ' . ($isRtl ? ($settings['site_name_ar'] ?? '') : ($settings['site_name_en'] ?? '')),
        'seoDescription' => $isRtl ? 'استكشف أنظمة رقي البرمجية المتكاملة التي تساعدك على إدارة أعمالك بنجاح.' : 'Explore RoQay integrated software systems that help you manage your business successfully.'
    ])
@endsection

@section('content')
    <!-- Page Hero -->
    <section class="bg-[#0a1628] pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCI+PHBhdGggZD0iTTAgMGgyNHYyNEgwem0xMiAybTEwIDEwaC0yIiBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            @include('partials.breadcrumbs', ['items' => [['label' => $isRtl ? 'المنتجات' : 'Products']]])
            <h1 class="text-4xl md:text-5xl font-bold text-white mt-6 mb-4">{{ $isRtl ? 'منتجاتنا التقنية' : 'Our Tech Products' }}</h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">{{ $isRtl ? 'أنظمة برمجية ذكية وموثوقة لنمو أعمالك في مختلف القطاعات' : 'Smart and reliable software systems to grow your business across various sectors' }}</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <a href="{{ route($locale . '.product.show', $isRtl ? $product->slug_ar : $product->slug_en) }}" class="block relative h-56 bg-gradient-to-br from-blue-50 to-cyan-100 flex items-center justify-center overflow-hidden">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $isRtl ? $product->title_ar : $product->title_en }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <span class="material-icons-round text-7xl text-blue-300 group-hover:scale-110 transition-transform duration-500">{{ $product->icon ?? 'widgets' }}</span>
                        @endif
                        <div class="absolute inset-0 bg-[#0a1628]/10 group-hover:bg-transparent transition-colors"></div>
                    </a>
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="w-14 h-14 bg-white shadow-md rounded-xl flex items-center justify-center -mt-14 relative z-10 mb-6 border border-gray-100 text-blue-600">
                            <span class="material-icons-round text-2xl">{{ $product->icon ?? 'widgets' }}</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-3">
                            <a href="{{ route($locale . '.product.show', $isRtl ? $product->slug_ar : $product->slug_en) }}" class="hover:text-blue-600 transition-colors">
                                {{ $isRtl ? $product->title_ar : $product->title_en }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-6 flex-1">{{ $isRtl ? $product->short_description_ar : $product->short_description_en }}</p>
                        
                        @php
                            $features = $isRtl ? $product->features_ar : $product->features_en;
                        @endphp
                        @if(is_array($features) && count($features) > 0)
                        <ul class="mb-8 space-y-2">
                            @foreach(array_slice($features, 0, 3) as $feature)
                                <li class="flex items-center text-sm text-gray-600">
                                    <span class="material-icons-round text-cyan-500 text-sm {{ $isRtl ? 'ml-2' : 'mr-2' }}">check_circle</span>
                                    {{ is_array($feature) ? ($feature['feature'] ?? '') : $feature }}
                                </li>
                            @endforeach
                            @if(count($features) > 3)
                                <li class="text-sm text-gray-400 italic {{ $isRtl ? 'pr-6' : 'pl-6' }}">{{ $isRtl ? '+ المزيد من الميزات' : '+ More features' }}</li>
                            @endif
                        </ul>
                        @endif

                        <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                            <a href="{{ route($locale . '.product.show', $isRtl ? $product->slug_ar : $product->slug_en) }}" class="inline-flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-5 py-2.5 rounded-lg font-medium transition-colors w-full">
                                {{ $isRtl ? 'التفاصيل' : 'Details' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
