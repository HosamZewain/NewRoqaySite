@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => $isRtl ? ($settings['default_seo_title_ar'] ?? 'رقي') : ($settings['default_seo_title_en'] ?? 'RoQay'),
        'seoDescription' => $isRtl ? ($settings['default_seo_description_ar'] ?? '') : ($settings['default_seo_description_en'] ?? ''),
        'seoKeywords' => $isRtl ? ($settings['default_seo_keywords_ar'] ?? '') : ($settings['default_seo_keywords_en'] ?? '')
    ])

    @php
        // Organization JSON-LD schema for the home page
        $orgSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $isRtl ? ($settings['site_name_ar'] ?? 'رقي') : ($settings['site_name_en'] ?? 'RoQay'),
            'url' => route($locale . '.home'),
            'description' => $isRtl ? ($settings['default_seo_description_ar'] ?? '') : ($settings['default_seo_description_en'] ?? ''),
            'sameAs' => array_values(array_filter([
                $settings['facebook'] ?? null,
                $settings['twitter'] ?? null,
                $settings['linkedin'] ?? null,
                $settings['instagram'] ?? null,
            ])),
        ];
    @endphp
    @include('partials.schemas', ['schemas' => [$orgSchema]])
@endsection

@php
    // ──────────────────────────────────────────────────────────────
    // Static visuals + copy
    // ──────────────────────────────────────────────────────────────
    $industries = [
        [
            'icon'  => 'restaurant',
            'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=900&q=80',
            'ar'    => 'المطاعم والكافيهات',
            'en'    => 'Restaurants & Cafés',
            'desc_ar' => 'كاشير، مطبخ، تسليم، مخزون، فود كوست — في منصة واحدة.',
            'desc_en' => 'POS, kitchen, delivery, inventory and food cost — one platform.',
        ],
        [
            'icon'  => 'storefront',
            'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=900&q=80',
            'ar'    => 'المتاجر والريتيل',
            'en'    => 'Retail & Stores',
            'desc_ar' => 'نقاط بيع، مخزون متعدد المواقع، تقارير مبيعات وأرباح.',
            'desc_en' => 'POS, multi-location inventory, sales and profit reporting.',
        ],
        [
            'icon'  => 'business_center',
            'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=900&q=80',
            'ar'    => 'الشركات الصغيرة والمتوسطة',
            'en'    => 'SMEs & Companies',
            'desc_ar' => 'CRM، فواتير، عروض أسعار، مهام وتقارير مالية.',
            'desc_en' => 'CRM, invoicing, quotes, tasks and financial reports.',
        ],
        [
            'icon'  => 'code',
            'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=900&q=80',
            'ar'    => 'حلول برمجية مخصصة',
            'en'    => 'Custom Software',
            'desc_ar' => 'أنظمة مخصصة على Laravel — من التحليل حتى الإطلاق والدعم.',
            'desc_en' => 'Custom Laravel systems — analysis, build, launch and support.',
        ],
        [
            'icon'  => 'local_cafe',
            'image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80',
            'ar'    => 'سلاسل المطاعم',
            'en'    => 'Restaurant Chains',
            'desc_ar' => 'إدارة فروع متعددة، مخزون مركزي، تقارير موحدة.',
            'desc_en' => 'Multi-branch management, central inventory, unified reports.',
        ],
        [
            'icon'  => 'dashboard',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80',
            'ar'    => 'البوابات ولوحات التحكم',
            'en'    => 'Portals & Dashboards',
            'desc_ar' => 'بوابات إدارة بيانات وعمليات وتقارير قرارات ذكية.',
            'desc_en' => 'Portals for managing data, operations and decision dashboards.',
        ],
    ];

    $trustIcons = ['restaurant', 'storefront', 'local_cafe', 'business_center', 'shopping_bag', 'point_of_sale', 'inventory_2', 'menu_book', 'dashboard', 'code', 'analytics', 'delivery_dining'];

    // Avatar helper — uses ui-avatars.com so testimonial cards always show a clean avatar
    $avatarFor = function ($name) {
        $clean = trim($name) ?: 'RoQay';
        return 'https://ui-avatars.com/api/?name=' . urlencode($clean)
            . '&background=0EA5E9&color=fff&size=128&rounded=true&bold=true';
    };
@endphp

@section('content')

    {{-- ════════════════════════════════════════════════════════════
         HERO
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['hero']))
    <section class="relative bg-[#0a1628] overflow-hidden lg:min-h-screen flex items-center pt-24 lg:pt-20">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-25"></div>
            <div class="absolute top-10 left-1/4 w-[28rem] h-[28rem] bg-blue-600/30 rounded-full blur-[120px] animate-blob"></div>
            <div class="absolute bottom-10 right-1/4 w-[24rem] h-[24rem] bg-cyan-600/25 rounded-full blur-[120px] animate-blob" style="animation-delay:-4s"></div>
            <div class="absolute top-1/3 right-1/3 w-72 h-72 bg-purple-600/15 rounded-full blur-[100px] animate-blob" style="animation-delay:-8s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-14 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-7 text-center lg:text-start animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 text-cyan-300 text-sm backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-400"></span>
                        </span>
                        {{ $isRtl ? 'حلول برمجية تشغيلية متكاملة' : 'Integrated operations software' }}
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight text-shadow-soft">
                        {{ $isRtl ? $sections['hero']->title_ar : $sections['hero']->title_en }}
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-gray-300 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        {{ $isRtl ? $sections['hero']->subtitle_ar : $sections['hero']->subtitle_en }}
                    </p>

                    @if(!empty($sections['hero']->extra_data['buttons']))
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        @foreach($sections['hero']->extra_data['buttons'] as $btn)
                            @if($btn['style'] === 'primary')
                                <a href="{{ $btn['url'] }}" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all shadow-[0_0_25px_rgba(6,182,212,0.35)] hover:shadow-[0_0_40px_rgba(6,182,212,0.6)] transform hover:-translate-y-1 animate-gradient-shift">
                                    {{ $isRtl ? $btn['text_ar'] : $btn['text_en'] }}
                                </a>
                            @elseif($btn['style'] === 'secondary')
                                <a href="{{ $btn['url'] }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all transform hover:-translate-y-1">
                                    {{ $isRtl ? $btn['text_ar'] : $btn['text_en'] }}
                                </a>
                            @else
                                <a href="{{ $btn['url'] }}" class="bg-[#25D366] hover:bg-[#128C7E] text-white px-8 py-4 rounded-xl text-lg font-bold transition-all flex items-center gap-2 transform hover:-translate-y-1 shadow-[0_0_20px_rgba(37,211,102,0.3)]">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                    {{ $isRtl ? $btn['text_ar'] : $btn['text_en'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    @endif

                    {{-- Hero trust pills --}}
                    <div class="flex flex-wrap gap-3 justify-center lg:justify-start pt-4">
                        @foreach([
                            ['icon' => 'verified', 'ar' => '15+ سنة خبرة', 'en' => '15+ years of experience'],
                            ['icon' => 'support_agent', 'ar' => 'دعم فني مستمر', 'en' => 'Ongoing support'],
                            ['icon' => 'security', 'ar' => 'حماية وأمان', 'en' => 'Secure by design'],
                        ] as $t)
                            <div class="flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1.5 rounded-full text-sm text-gray-200 backdrop-blur-sm">
                                <span class="material-icons-round text-cyan-400 text-sm">{{ $t['icon'] }}</span>
                                {{ $isRtl ? $t['ar'] : $t['en'] }}
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Hero: animated dashboard mockup --}}
                <div class="hidden lg:block relative perspective-1000 animate-fade-in delay-200">
                    <div class="relative w-full h-[520px] transform-3d rotate-y-[-10deg] rotate-x-[5deg] hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-[#0f172a] rounded-2xl border border-white/10 shadow-[0_30px_80px_rgba(2,6,23,0.6)] overflow-hidden">
                            {{-- Window header --}}
                            <div class="h-10 bg-[#0b1224] flex items-center px-4 gap-2 border-b border-white/5">
                                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                <div class="flex-1 text-center">
                                    <span class="text-xs text-gray-500 font-mono">roqay.app/dashboard</span>
                                </div>
                            </div>

                            <div class="flex h-[calc(100%-2.5rem)]">
                                {{-- Sidebar --}}
                                <div class="w-16 bg-[#0b1224] border-r border-white/5 flex flex-col items-center py-4 gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center">
                                        <span class="material-icons-round text-white text-sm">apps</span>
                                    </div>
                                    @foreach(['dashboard', 'point_of_sale', 'inventory_2', 'bar_chart', 'people', 'settings'] as $i => $ic)
                                        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $i === 1 ? 'bg-cyan-500/15 text-cyan-300' : 'text-gray-500 hover:bg-white/5' }} transition-colors">
                                            <span class="material-icons-round text-sm">{{ $ic }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Main panel --}}
                                <div class="flex-1 p-5 flex flex-col gap-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-gray-400 text-xs uppercase tracking-wider">{{ $isRtl ? 'لوحة التحكم' : 'Dashboard' }}</div>
                                            <div class="text-white font-bold text-base">{{ $isRtl ? 'مبيعات اليوم' : 'Today’s sales' }}</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-blue-500 to-purple-500"></div>
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-emerald-400 to-teal-500"></div>
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-amber-400 to-orange-500"></div>
                                        </div>
                                    </div>

                                    {{-- Stat cards --}}
                                    <div class="grid grid-cols-3 gap-3">
                                        @foreach([
                                            ['label' => $isRtl ? 'مبيعات' : 'Sales',      'value' => '24,580', 'change' => '+12%', 'color' => 'cyan'],
                                            ['label' => $isRtl ? 'طلبات' : 'Orders',     'value' => '312',    'change' => '+8%',  'color' => 'emerald'],
                                            ['label' => $isRtl ? 'متوسط' : 'Avg ticket', 'value' => '78.7',   'change' => '+3%',  'color' => 'amber'],
                                        ] as $c)
                                            <div class="bg-white/5 border border-white/5 rounded-lg p-3">
                                                <div class="text-[10px] text-gray-400 uppercase tracking-wider">{{ $c['label'] }}</div>
                                                <div class="text-white font-bold text-lg mt-0.5">{{ $c['value'] }}</div>
                                                <div class="text-[10px] text-{{ $c['color'] }}-400 mt-0.5">▲ {{ $c['change'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Chart area (animated SVG bars) --}}
                                    <div class="flex-1 bg-white/5 border border-white/5 rounded-lg p-3 flex items-end gap-1.5 min-h-[120px]">
                                        @php $heights = [38, 55, 42, 68, 50, 80, 62, 90, 72, 95, 85, 100]; @endphp
                                        @foreach($heights as $i => $h)
                                            <div class="flex-1 bg-gradient-to-t from-cyan-500/40 to-cyan-400 rounded-t origin-bottom" style="height: {{ $h }}%; animation: fadeIn .6s ease-out {{ 0.1 + $i * 0.05 }}s forwards; opacity: 0;"></div>
                                        @endforeach
                                    </div>

                                    {{-- Recent orders mini-list --}}
                                    <div class="bg-white/5 border border-white/5 rounded-lg p-3 space-y-2">
                                        @foreach([
                                            ['n' => '#10242', 'i' => 'Burger Combo',  'p' => '85.00', 'c' => 'emerald'],
                                            ['n' => '#10241', 'i' => 'Pasta Special', 'p' => '62.50', 'c' => 'cyan'],
                                            ['n' => '#10240', 'i' => 'Veg Wrap',      'p' => '38.00', 'c' => 'amber'],
                                        ] as $o)
                                            <div class="flex items-center justify-between text-[11px]">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-{{ $o['c'] }}-400 animate-pulse"></div>
                                                    <span class="font-mono text-gray-400">{{ $o['n'] }}</span>
                                                    <span class="text-gray-200">{{ $o['i'] }}</span>
                                                </div>
                                                <span class="text-white font-bold">${{ $o['p'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating cards --}}
                        <div class="absolute -right-8 top-1/4 w-52 h-28 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl p-4 animate-float">
                            <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center mb-2">
                                <span class="material-icons-round text-green-400 text-sm">trending_up</span>
                            </div>
                            <div class="text-[10px] text-gray-300 uppercase tracking-wider">{{ $isRtl ? 'النمو الشهري' : 'Monthly growth' }}</div>
                            <div class="text-white font-extrabold text-lg">+34.8%</div>
                        </div>

                        <div class="absolute -left-8 bottom-1/4 w-56 h-24 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl p-4 animate-float" style="animation-delay:2s;">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-blue-500/20 flex items-center justify-center">
                                    <span class="material-icons-round text-blue-400">group</span>
                                </div>
                                <div>
                                    <div class="text-[10px] text-gray-300 uppercase tracking-wider">{{ $isRtl ? 'عملاء راضون' : 'Happy clients' }}</div>
                                    <div class="text-white font-extrabold text-lg">150+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wave divider --}}
        <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px] md:h-[120px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,121.22,194.2,110.6,238.33,103.11,280.24,80.7,321.39,56.44Z" class="fill-slate-50"></path>
            </svg>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         TRUST / INDUSTRY STRIP — marquee of industry icons
         Toggle via homepage_sections.trust_strip in admin.
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['trust_strip']))
    <section class="bg-slate-50 py-10 border-b border-slate-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest">
                {{ $isRtl ? 'يعمل في مختلف القطاعات' : 'Powering operations across industries' }}
            </p>
        </div>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>
            <div class="flex gap-12 animate-marquee w-max">
                @for($i = 0; $i < 2; $i++)
                    @foreach($trustIcons as $ic)
                        <div class="flex items-center gap-2 sm:gap-3 px-4 sm:px-6 py-2 text-gray-400 hover:text-blue-600 transition-colors shrink-0">
                            <span class="material-icons-round text-2xl sm:text-3xl">{{ $ic }}</span>
                            <span class="text-xs sm:text-sm font-bold uppercase tracking-wider whitespace-nowrap">{{ str_replace('_', ' ', $ic) }}</span>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         WHY ROQAY
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['why_roqay']))
    <section class="py-24 bg-slate-50 relative" x-data x-intersect.once="$el.querySelectorAll('.reveal').forEach((el, i) => setTimeout(() => el.classList.add('is-visible'), i * 100))">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-100 rounded-full opacity-50 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-100 rounded-full opacity-50 blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'لماذا رقي' : 'Why RoQay' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-4">{{ $isRtl ? $sections['why_roqay']->title_ar : $sections['why_roqay']->title_en }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? $sections['why_roqay']->subtitle_ar : $sections['why_roqay']->subtitle_en }}</p>
            </div>

            @if(!empty($sections['why_roqay']->extra_data['cards']))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($sections['why_roqay']->extra_data['cards'] as $card)
                <div class="reveal bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all hover:-translate-y-2 duration-300 border border-gray-100 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-bl-full -z-0 transition-transform group-hover:scale-150"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-cyan-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:from-blue-600 group-hover:to-cyan-500 group-hover:text-white transition-all duration-300 group-hover:rotate-6">
                            <span class="material-icons-round text-3xl">{{ $card['icon'] }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $isRtl ? $card['title_ar'] : $card['title_en'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $isRtl ? $card['desc_ar'] : $card['desc_en'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         INDUSTRIES SERVED — toggle via homepage_sections.industries
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['industries']))
    <section class="py-24 bg-white" x-data x-intersect.once="$el.querySelectorAll('.reveal').forEach((el, i) => setTimeout(() => el.classList.add('is-visible'), i * 80))">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14 reveal">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'القطاعات' : 'Industries' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-4">{{ $isRtl ? 'حلول مصممة لكل قطاع' : 'Solutions designed for every industry' }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'من المطاعم والكافيهات إلى الشركات والمتاجر — حلول عملية تعمل في الميدان.' : 'From restaurants and cafés to companies and retail — practical solutions built for the field.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($industries as $ind)
                <div class="reveal group bg-white rounded-2xl overflow-hidden border border-gray-200 hover:border-blue-300 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $ind['image'] }}" alt="{{ $isRtl ? $ind['ar'] : $ind['en'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1628] via-[#0a1628]/40 to-transparent"></div>
                        <div class="absolute top-4 {{ $isRtl ? 'right-4' : 'left-4' }} w-12 h-12 bg-white/95 backdrop-blur-sm text-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="material-icons-round">{{ $ind['icon'] }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $isRtl ? $ind['ar'] : $ind['en'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $isRtl ? $ind['desc_ar'] : $ind['desc_en'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         PRODUCTS PREVIEW
    ═══════════════════════════════════════════════════════════════ --}}
    @if(count($products) > 0)
    <section class="py-24 bg-slate-50 relative" x-data x-intersect.once="$el.querySelectorAll('.reveal').forEach((el, i) => setTimeout(() => el.classList.add('is-visible'), i * 80))">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6 reveal">
                <div>
                    <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'منتجاتنا' : 'Our products' }}</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-3">{{ $isRtl ? 'منتجات رقي' : 'RoQay Products' }}</h2>
                    <p class="text-lg text-gray-600 max-w-2xl">{{ $isRtl ? 'أنظمة برمجية متكاملة تناسب طموح شركتك' : 'Integrated software systems that fit your company\'s ambition' }}</p>
                </div>
                <a href="{{ route($locale . '.products') }}" class="hidden md:inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-800 transition-colors group">
                    {{ $isRtl ? 'عرض كل المنتجات' : 'View all products' }}
                    <span class="material-icons-round {{ $isRtl ? 'rotate-180' : '' }} group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                <div class="reveal bg-white rounded-2xl border border-gray-200 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:border-blue-200">
                    <div class="h-48 bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-100 relative flex items-center justify-center overflow-hidden">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $isRtl ? $product->title_ar : $product->title_en }}" loading="lazy" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-700">
                        @else
                            {{-- Decorative gradient mockup --}}
                            <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(59,130,246,0.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(59,130,246,0.08)_1px,transparent_1px)] bg-[size:24px_24px]"></div>
                            <span class="material-icons-round text-7xl text-blue-300 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 relative z-10">{{ $product->icon ?? 'apps' }}</span>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1628]/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-white shadow-md rounded-xl flex items-center justify-center -mt-12 relative z-10 mb-4 border border-gray-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <span class="material-icons-round">{{ $product->icon ?? 'apps' }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route($locale . '.product.show', $isRtl ? $product->slug_ar : $product->slug_en) }}">
                                {{ $isRtl ? $product->title_ar : $product->title_en }}
                            </a>
                        </h3>
                        <p class="text-gray-600 mb-6 line-clamp-3 text-sm leading-relaxed">{{ $isRtl ? $product->short_description_ar : $product->short_description_en }}</p>
                        <a href="{{ route($locale . '.product.show', $isRtl ? $product->slug_ar : $product->slug_en) }}" class="inline-flex items-center text-blue-600 font-semibold group-hover:text-cyan-600 transition-colors">
                            {{ $isRtl ? 'اكتشف المزيد' : 'Discover more' }}
                            <span class="material-icons-round text-sm ml-1 {{ $isRtl ? 'rotate-180' : '' }} transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-10 text-center md:hidden">
                <a href="{{ route($locale . '.products') }}" class="inline-block bg-blue-50 text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-blue-100 transition-colors">
                    {{ $isRtl ? 'عرض كل المنتجات' : 'View all products' }}
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         HOW IT WORKS (uses the seeded `how_it_works` section data)
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['how_it_works']) && !empty($sections['how_it_works']->extra_data['steps']))
    <section class="py-24 bg-white relative" x-data x-intersect.once="$el.querySelectorAll('.reveal').forEach((el, i) => setTimeout(() => el.classList.add('is-visible'), i * 120))">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'كيف نعمل' : 'How we work' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-4">{{ $isRtl ? $sections['how_it_works']->title_ar : $sections['how_it_works']->title_en }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'منهجية واضحة من تحليل الاحتياج وحتى التشغيل والدعم.' : 'A clear methodology from requirements analysis through launch and ongoing support.' }}</p>
            </div>

            @php
                $steps = $sections['how_it_works']->extra_data['steps'];
                $stepCount = count($steps);
                // Static class names so Tailwind JIT can compile them
                $stepGridClass = match (min($stepCount, 4)) {
                    1       => 'md:grid-cols-1',
                    2       => 'md:grid-cols-2',
                    3       => 'md:grid-cols-3',
                    default => 'md:grid-cols-4',
                };
            @endphp
            <div class="relative">
                {{-- Connecting line (desktop) --}}
                <div class="hidden md:block absolute top-10 left-[8%] right-[8%] h-0.5 bg-gradient-to-r from-blue-200 via-cyan-300 to-blue-200"></div>

                <div class="grid grid-cols-1 {{ $stepGridClass }} gap-8 md:gap-4 relative">
                    @foreach($steps as $idx => $step)
                        <div class="reveal text-center relative px-4">
                            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-600 to-cyan-500 text-white flex items-center justify-center text-2xl font-extrabold shadow-[0_0_25px_rgba(6,182,212,0.45)] border-4 border-white relative z-10 animate-pulse-glow" style="animation-delay: {{ $idx * 0.5 }}s">
                                {{ $idx + 1 }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $isRtl ? ($step['title_ar'] ?? '') : ($step['title_en'] ?? '') }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $isRtl ? ($step['desc_ar'] ?? '') : ($step['desc_en'] ?? '') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         STATS
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['stats']) && !empty($sections['stats']->extra_data['counters']))
    <section class="py-24 bg-gradient-to-br from-[#0a1628] via-[#0f1c34] to-[#1e293b] relative overflow-hidden" x-data="{ shown: false }" x-intersect="shown = true">
        <div class="absolute inset-0 opacity-25 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:3rem_3rem] [mask-image:radial-gradient(ellipse_70%_60%_at_50%_50%,#000_50%,transparent_100%)]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[40rem] h-[40rem] bg-blue-600/20 rounded-full blur-[140px] animate-blob"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if(!empty($sections['stats']->title_ar) && $isRtl || !empty($sections['stats']->title_en) && !$isRtl)
            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-white">{{ $isRtl ? $sections['stats']->title_ar : $sections['stats']->title_en }}</h2>
            </div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach($sections['stats']->extra_data['counters'] as $counter)
                <div class="p-6 group">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-3 flex items-center justify-center gap-1 bg-gradient-to-r from-white to-cyan-200 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-300">
                        <span x-data="{ current: 0, target: {{ $counter['value'] }} }"
                              x-init="$watch('shown', val => { if(val) { let step = Math.max(1, target/40); let i = setInterval(() => { current += step; if(current >= target) { current = target; clearInterval(i); } }, 50); } })"
                              x-text="Math.round(current)">0</span>
                        <span class="text-cyan-400">{{ $isRtl ? $counter['suffix_ar'] : $counter['suffix_en'] }}</span>
                    </div>
                    <p class="text-gray-400 font-medium tracking-wide uppercase text-sm md:text-base">{{ $isRtl ? $counter['label_ar'] : $counter['label_en'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         TESTIMONIALS
    ═══════════════════════════════════════════════════════════════ --}}
    @if(count($testimonials) > 0)
    <section class="py-24 bg-slate-50 relative" x-data="{
        active: 0,
        total: {{ count($testimonials) }},
        timer: null,
        start() { this.stop(); this.timer = setInterval(() => this.next(), 7000); },
        stop() { if (this.timer) clearInterval(this.timer); },
        next() { this.active = (this.active + 1) % this.total; },
        prev() { this.active = (this.active - 1 + this.total) % this.total; }
    }" x-init="start()" @mouseenter="stop()" @mouseleave="start()">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'آراء العملاء' : 'Testimonials' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-3">{{ $isRtl ? 'ماذا يقول عملاؤنا' : 'What our clients say' }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'قصص نجاح حقيقية من شركاء استخدموا أنظمتنا.' : 'Real success stories from partners using our systems.' }}</p>
            </div>

            <div class="relative">
                {{-- Decorative quote --}}
                <div class="absolute -top-6 {{ $isRtl ? 'right-8' : 'left-8' }} text-9xl text-blue-100 font-serif leading-none select-none pointer-events-none">"</div>

                <div class="relative min-h-[280px]">
                    @foreach($testimonials as $i => $t)
                    <div x-show="active === {{ $i }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200 absolute inset-0"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 relative">
                        @if($t->rating)
                        <div class="flex gap-1 mb-6 {{ $isRtl ? 'justify-end' : '' }}">
                            @for($s = 0; $s < (int) $t->rating; $s++)
                                <span class="material-icons-round text-amber-400">star</span>
                            @endfor
                        </div>
                        @endif
                        <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-8 {{ $isRtl ? 'text-right' : '' }}">
                            "{{ $isRtl ? $t->review_ar : $t->review_en }}"
                        </p>
                        <div class="flex items-center gap-4 {{ $isRtl ? 'flex-row-reverse text-right' : '' }}">
                            <img src="{{ $t->client_photo ? asset('storage/' . $t->client_photo) : $avatarFor($isRtl ? $t->client_name_ar : $t->client_name_en) }}"
                                 alt="{{ $isRtl ? $t->client_name_ar : $t->client_name_en }}"
                                 loading="lazy"
                                 class="w-14 h-14 rounded-full object-cover ring-4 ring-blue-100">
                            <div>
                                <div class="font-bold text-gray-900">{{ $isRtl ? $t->client_name_ar : $t->client_name_en }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ $isRtl ? $t->position_ar : $t->position_en }}@if(($isRtl ? $t->position_ar : $t->position_en) && ($isRtl ? $t->company_ar : $t->company_en)) — @endif{{ $isRtl ? $t->company_ar : $t->company_en }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Controls --}}
                <div class="flex items-center justify-center gap-3 mt-8">
                    <button @click="prev()" class="w-10 h-10 rounded-full bg-white border border-gray-200 hover:border-blue-300 hover:bg-blue-50 text-gray-600 hover:text-blue-600 flex items-center justify-center transition-colors shadow-sm">
                        <span class="material-icons-round">{{ $isRtl ? 'chevron_right' : 'chevron_left' }}</span>
                    </button>
                    <div class="flex gap-2">
                        @foreach($testimonials as $i => $t)
                            <button @click="active = {{ $i }}"
                                    :class="active === {{ $i }} ? 'bg-blue-600 w-8' : 'bg-gray-300 hover:bg-gray-400 w-2'"
                                    class="h-2 rounded-full transition-all duration-300"
                                    aria-label="{{ $isRtl ? 'الانتقال إلى الرأي' : 'Go to testimonial' }} {{ $i + 1 }}"></button>
                        @endforeach
                    </div>
                    <button @click="next()" class="w-10 h-10 rounded-full bg-white border border-gray-200 hover:border-blue-300 hover:bg-blue-50 text-gray-600 hover:text-blue-600 flex items-center justify-center transition-colors shadow-sm">
                        <span class="material-icons-round">{{ $isRtl ? 'chevron_left' : 'chevron_right' }}</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         BLOG PREVIEW
    ═══════════════════════════════════════════════════════════════ --}}
    @if(count($posts) > 0)
    <section class="py-24 bg-white" x-data x-intersect.once="$el.querySelectorAll('.reveal').forEach((el, i) => setTimeout(() => el.classList.add('is-visible'), i * 100))">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6 reveal">
                <div>
                    <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'المدونة' : 'Insights' }}</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-3">{{ $isRtl ? 'مقالات وأفكار من فريق رقي' : 'Articles and ideas from the RoQay team' }}</h2>
                    <p class="text-lg text-gray-600 max-w-2xl">{{ $isRtl ? 'محتوى عملي يساعدك على فهم تشغيل أعمالك واتخاذ قرارات أفضل.' : 'Practical content to help you understand your operations and make better decisions.' }}</p>
                </div>
                <a href="{{ route($locale . '.blog') }}" class="hidden md:inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-800 transition-colors group">
                    {{ $isRtl ? 'كل المقالات' : 'All articles' }}
                    <span class="material-icons-round {{ $isRtl ? 'rotate-180' : '' }} group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="reveal bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
                    <a href="{{ route($locale . '.blog.show', $isRtl ? $post->slug_ar : $post->slug_en) }}" class="block relative h-52 overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $isRtl ? $post->title_ar : $post->title_en }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-100 via-cyan-100 to-blue-200 flex items-center justify-center relative">
                                <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(59,130,246,0.08)_1px,transparent_1px),linear-gradient(to_bottom,rgba(59,130,246,0.08)_1px,transparent_1px)] bg-[size:24px_24px]"></div>
                                <span class="material-icons-round text-6xl text-blue-400 relative z-10 group-hover:scale-110 transition-transform duration-500">article</span>
                            </div>
                        @endif
                        @if($post->category)
                        <span class="absolute top-4 {{ $isRtl ? 'right-4' : 'left-4' }} bg-blue-600 text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">{{ $post->category }}</span>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                            <span class="material-icons-round text-sm">calendar_today</span>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}
                            @if($post->author_name)
                                <span class="text-gray-300">·</span>
                                <span class="material-icons-round text-sm">person</span>
                                {{ $post->author_name }}
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route($locale . '.blog.show', $isRtl ? $post->slug_ar : $post->slug_en) }}">
                                {{ $isRtl ? $post->title_ar : $post->title_en }}
                            </a>
                        </h3>
                        <p class="text-gray-600 line-clamp-3 text-sm leading-relaxed mb-4">{{ $isRtl ? $post->excerpt_ar : $post->excerpt_en }}</p>
                        <a href="{{ route($locale . '.blog.show', $isRtl ? $post->slug_ar : $post->slug_en) }}" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:text-cyan-600 transition-colors">
                            {{ $isRtl ? 'اقرأ المقال' : 'Read article' }}
                            <span class="material-icons-round text-sm ml-1 {{ $isRtl ? 'rotate-180' : '' }} transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-10 text-center md:hidden">
                <a href="{{ route($locale . '.blog') }}" class="inline-block bg-blue-50 text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-blue-100 transition-colors">
                    {{ $isRtl ? 'كل المقالات' : 'All articles' }}
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         FAQ
    ═══════════════════════════════════════════════════════════════ --}}
    @if(count($faqs) > 0)
    <section class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'الأسئلة الشائعة' : 'FAQ' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-3">{{ $isRtl ? 'إجابات على الأسئلة الشائعة' : 'Answers to common questions' }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'إذا لم تجد ما تبحث عنه، تواصل معنا مباشرة.' : 'Can\'t find what you\'re looking for? Reach out anytime.' }}</p>
            </div>

            <div class="space-y-3" x-data="{ active: 0 }">
                @foreach($faqs as $index => $faq)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center justify-between gap-4 p-5 text-start focus:outline-none hover:bg-blue-50/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0"
                                 :class="active === {{ $index }} ? 'bg-blue-600 text-white' : ''">
                                <span class="material-icons-round text-sm">help_outline</span>
                            </div>
                            <span class="font-bold text-gray-900">{{ $isRtl ? $faq->question_ar : $faq->question_en }}</span>
                        </div>
                        <span class="material-icons-round text-gray-400 transition-transform duration-300 shrink-0" :class="active === {{ $index }} ? 'rotate-180 text-blue-600' : ''">expand_more</span>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse x-cloak>
                        <div class="px-5 pb-5 pt-0 text-gray-600 leading-relaxed {{ $isRtl ? 'pr-[3.25rem]' : 'pl-[3.25rem]' }}">
                            {{ $isRtl ? $faq->answer_ar : $faq->answer_en }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         FINAL CTA — toggle via homepage_sections.final_cta
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($sections['final_cta']))
    <section class="py-24 relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-600 animate-gradient-shift">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 animate-blob"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-300/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 animate-blob" style="animation-delay:-6s"></div>
            <div class="absolute inset-0 opacity-15 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCI+PGNpcmNsZSBjeD0iNDAiIGN5PSI0MCIgcj0iMSIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==')]"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-1.5 text-cyan-200 text-sm mb-6 backdrop-blur-sm">
                <span class="material-icons-round text-sm">rocket_launch</span>
                {{ $isRtl ? 'ابدأ التحول الرقمي اليوم' : 'Start your digital transformation' }}
            </div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 text-shadow-soft">
                {{ $isRtl ? 'هل أنت مستعد لتطوير أعمالك؟' : 'Ready to grow your business?' }}
            </h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
                {{ $isRtl ? 'انضم إلى مئات الشركات التي تعتمد على أنظمة رقي لتحقيق النجاح.' : 'Join hundreds of companies relying on RoQay systems to achieve success.' }}
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route($locale . '.contact') }}" class="inline-flex items-center gap-2 bg-white text-blue-700 px-8 py-4 rounded-xl text-lg font-bold hover:bg-gray-50 transition-all shadow-2xl hover:shadow-[0_20px_50px_rgba(0,0,0,0.25)] transform hover:-translate-y-1">
                    <span class="material-icons-round">contact_mail</span>
                    {{ $isRtl ? 'تواصل معنا الآن' : 'Contact us now' }}
                </a>
                <a href="{{ route($locale . '.products') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all transform hover:-translate-y-1">
                    {{ $isRtl ? 'تصفح المنتجات' : 'Browse products' }}
                    <span class="material-icons-round {{ $isRtl ? 'rotate-180' : '' }}">arrow_forward</span>
                </a>
            </div>

            <div class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-blue-100 text-sm">
                @foreach([
                    ['icon' => 'check_circle', 'ar' => 'بدون التزامات', 'en' => 'No commitments'],
                    ['icon' => 'check_circle', 'ar' => 'استشارة مجانية',  'en' => 'Free consultation'],
                    ['icon' => 'check_circle', 'ar' => 'دعم باللغة العربية', 'en' => 'Arabic-language support'],
                ] as $b)
                    <div class="flex items-center gap-2">
                        <span class="material-icons-round text-cyan-300">{{ $b['icon'] }}</span>
                        {{ $isRtl ? $b['ar'] : $b['en'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
