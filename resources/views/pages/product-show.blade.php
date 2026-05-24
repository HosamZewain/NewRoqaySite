@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? $product->seo_title_ar : $product->seo_title_en) ?: ($isRtl ? $product->title_ar : $product->title_en) . ' | ' . ($settings['site_name_'.$locale] ?? 'RoQay'),
        'seoDescription' => ($isRtl ? $product->seo_description_ar : $product->seo_description_en) ?: ($isRtl ? $product->short_description_ar : $product->short_description_en),
        'seoKeywords' => $isRtl ? $product->seo_keywords_ar : $product->seo_keywords_en,
        'seoImage' => $product->og_image ?? $product->featured_image
    ])
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => $isRtl ? $product->title_ar : $product->title_en,
            'description' => $isRtl ? $product->short_description_ar : $product->short_description_en,
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web, Windows, macOS, iOS, Android'
        ];
        if($product->featured_image) {
            $schema['image'] = asset('storage/' . $product->featured_image);
        }
    @endphp
    @include('partials.schemas', ['schemas' => [$schema]])
@endsection

@section('content')
    <!-- Product Hero -->
    <section class="bg-[#0a1628] pt-32 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if($product->featured_image)
                <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('storage/' . $product->featured_image) }}')"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-[#0a1628]/90 via-[#0a1628]/95 to-[#0a1628]"></div>
            <div class="absolute top-1/4 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @include('partials.breadcrumbs', ['items' => [
                ['label' => $isRtl ? 'المنتجات' : 'Products', 'url' => route($locale . '.products')],
                ['label' => $isRtl ? $product->title_ar : $product->title_en]
            ]])
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-8 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 rounded-full px-4 py-1.5 text-blue-400 font-medium text-sm mb-6">
                        <span class="material-icons-round text-sm">{{ $product->icon ?? 'star' }}</span>
                        {{ $isRtl ? 'منتج مميز' : 'Featured Product' }}
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        {{ ($isRtl ? $product->hero_headline_ar : $product->hero_headline_en) ?: ($isRtl ? $product->title_ar : $product->title_en) }}
                    </h1>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        {{ ($isRtl ? $product->hero_subheadline_ar : $product->hero_subheadline_en) ?: ($isRtl ? $product->short_description_ar : $product->short_description_en) }}
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="#demo" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white px-8 py-4 rounded-xl font-bold shadow-[0_0_15px_rgba(6,182,212,0.4)] transition-all transform hover:-translate-y-1 flex items-center gap-2">
                            <span class="material-icons-round">rocket_launch</span>
                            {{ $isRtl ? 'اطلب عرض توضيحي' : 'Request a Demo' }}
                        </a>
                        <a href="#features" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-4 rounded-xl font-bold transition-all backdrop-blur-sm">
                            {{ $isRtl ? 'اكتشف الميزات' : 'Explore Features' }}
                        </a>
                    </div>
                </div>
                
                <div class="hidden lg:block relative perspective-1000">
                    <div class="relative w-full h-[400px] bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md shadow-2xl p-2 transform-3d rotate-y-[-5deg] rotate-x-[5deg]">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/' . $product->featured_image) }}" alt="" class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#1e293b] to-[#0f172a] rounded-xl flex items-center justify-center">
                                <span class="material-icons-round text-8xl text-blue-500/50">{{ $product->icon ?? 'widgets' }}</span>
                            </div>
                        @endif
                        
                        <!-- Floating badges -->
                        <div class="absolute -left-6 top-10 bg-white p-3 rounded-lg shadow-xl animate-float flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                                <span class="material-icons-round">trending_up</span>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">{{ $isRtl ? 'الأداء' : 'Performance' }}</div>
                                <div class="font-bold text-gray-900">+45%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview & Description -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $isRtl ? 'نظرة عامة على النظام' : 'System Overview' }}</h2>
                    <div class="prose prose-lg prose-blue max-w-none text-gray-600 leading-loose prose-img:rounded-xl">
                        {!! $isRtl ? $product->description_ar : $product->description_en !!}
                    </div>
                </div>
                
                <div class="space-y-8">
                    @php
                        $target = $isRtl ? $product->target_audience_ar : $product->target_audience_en;
                        $benefits = $isRtl ? $product->benefits_ar : $product->benefits_en;
                    @endphp
                    
                    @if($target)
                    <div class="bg-slate-50 rounded-2xl p-6 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="material-icons-round text-blue-600">groups</span>
                            {{ $isRtl ? 'لمن هذا النظام؟' : 'Who is this for?' }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">{{ $target }}</p>
                    </div>
                    @endif

                    @if(is_array($benefits) && count($benefits) > 0)
                    <div class="bg-blue-600 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                        <h3 class="text-xl font-bold mb-6 flex items-center gap-2 relative z-10">
                            <span class="material-icons-round text-cyan-300">verified</span>
                            {{ $isRtl ? 'الفوائد الرئيسية' : 'Key Benefits' }}
                        </h3>
                        <ul class="space-y-4 relative z-10">
                            @foreach($benefits as $benefit)
                            <li class="flex items-start">
                                <span class="material-icons-round text-cyan-300 {{ $isRtl ? 'ml-3' : 'mr-3' }} shrink-0">check_circle</span>
                                <span>{{ is_array($benefit) ? ($benefit['benefit'] ?? '') : $benefit }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Modules / Components -->
    @php
        $modules = $isRtl ? $product->modules_ar : $product->modules_en;
    @endphp
    @if(is_array($modules) && count($modules) > 0)
    <section id="features" class="py-20 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $isRtl ? 'وحدات النظام' : 'System Modules' }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'تعرف على المكونات الرئيسية التي تجعل نظامنا متكاملاً' : 'Discover the core components that make our system comprehensive' }}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($modules as $module)
                <div class="bg-white rounded-xl p-6 border border-gray-200 hover:border-blue-300 hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <span class="material-icons-round">{{ $module['icon'] ?? 'extension' }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $module['title'] ?? '' }}</h3>
                    <p class="text-gray-600">{{ $module['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Features List -->
    @php
        $features = $isRtl ? $product->features_ar : $product->features_en;
    @endphp
    @if(is_array($features) && count($features) > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">{{ $isRtl ? 'جميع الميزات' : 'All Features' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-4">
                @foreach($features as $feature)
                <div class="flex items-center text-gray-700 bg-slate-50 rounded-lg p-3">
                    <span class="material-icons-round text-green-500 {{ $isRtl ? 'ml-3' : 'mr-3' }}">check</span>
                    <span class="font-medium">{{ is_array($feature) ? ($feature['feature'] ?? '') : $feature }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Implementation Steps -->
    @php
        $steps = $isRtl ? $product->implementation_steps_ar : $product->implementation_steps_en;
    @endphp
    @if(is_array($steps) && count($steps) > 0)
    <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIi8+PC9zdmc+')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $isRtl ? 'آلية التنفيذ' : 'Implementation Process' }}</h2>
                <p class="text-gray-400">{{ $isRtl ? 'خطوات واضحة ومدروسة لضمان نجاح تشغيل النظام' : 'Clear and structured steps to ensure successful system launch' }}</p>
            </div>
            
            @php
                $stepGridClass = match (min(count($steps), 4)) {
                    1       => 'md:grid-cols-1',
                    2       => 'md:grid-cols-2',
                    3       => 'md:grid-cols-3',
                    default => 'md:grid-cols-4',
                };
            @endphp
            <div class="grid grid-cols-1 {{ $stepGridClass }} gap-8 relative">
                <!-- Connecting line for desktop -->
                <div class="hidden md:block absolute top-8 left-0 w-full h-0.5 bg-gray-800 -z-10"></div>
                
                @foreach($steps as $index => $step)
                <div class="relative text-center">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full flex items-center justify-center text-xl font-bold text-white shadow-lg border-4 border-slate-900 mb-6">
                        {{ $index + 1 }}
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ $step['title'] ?? '' }}</h3>
                    <p class="text-gray-400 text-sm">{{ $step['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQs -->
    @if(count($faqs) > 0)
    <section class="py-20 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $isRtl ? 'الأسئلة الشائعة حول النظام' : 'Frequently Asked Questions' }}</h2>
            </div>
            
            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faqs as $index => $faq)
                <div class="border border-gray-200 rounded-xl bg-white overflow-hidden">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center justify-between p-5 text-start focus:outline-none hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-gray-900">{{ $isRtl ? $faq->question_ar : $faq->question_en }}</span>
                        <span class="material-icons-round text-gray-400 transition-transform duration-300" :class="active === {{ $index }} ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse x-cloak>
                        <div class="p-5 pt-0 text-gray-600 border-t border-gray-100 leading-relaxed">
                            {{ $isRtl ? $faq->answer_ar : $faq->answer_en }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Form Section -->
    <section id="demo" class="py-20 bg-blue-50 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                <div class="p-8 md:p-12 text-center border-b border-gray-100 bg-gradient-to-br from-blue-600 to-cyan-600 text-white">
                    <h2 class="text-3xl font-bold mb-4">{{ $isRtl ? 'اطلب عرضاً توضيحياً' : 'Request a Demo' }}</h2>
                    <p class="text-blue-100">{{ $isRtl ? 'املأ النموذج وسيتواصل معك فريقنا التقني في أقرب وقت' : 'Fill out the form and our technical team will contact you shortly' }}</p>
                </div>
                
                <div class="p-8 md:p-12">
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3">
                            <span class="material-icons-round">check_circle</span>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route($locale . '.contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="interested_product" value="{{ $isRtl ? $product->title_ar : $product->title_en }}">
                        
                        <!-- Honeypot -->
                        <div class="hidden">
                            <label>Leave this empty</label>
                            <input type="text" name="website_url" value="">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'الاسم الكريم' : 'Full Name' }} <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('name') }}">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'اسم الشركة / المطعم' : 'Company / Restaurant Name' }}</label>
                                <input type="text" name="company_name" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('company_name') }}">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'البريد الإلكتروني' : 'Email Address' }} <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('email') }}" dir="ltr">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'رقم الهاتف' : 'Phone Number' }}</label>
                                <input type="text" name="phone" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('phone') }}" dir="ltr">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'ملاحظات إضافية' : 'Additional Notes' }}</label>
                            <textarea name="message" rows="4" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">{{ old('message') }}</textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-4 rounded-xl shadow-lg transition-all transform hover:-translate-y-1">
                            {{ $isRtl ? 'إرسال الطلب' : 'Submit Request' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
