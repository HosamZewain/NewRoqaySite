{{-- ════════════════════════════════════════════════════════════════════
    Per-product pricing section.
    Renders only when $product->pricing_enabled is true AND at least one
    package exists. Drop into any product page via:

        @include('partials.pricing-section', ['product' => $product])

    Data shape: see App\Models\Product::$casts and the Pricing tab in
    ProductResource. $isRtl + $locale are shared globally by the view
    composer in AppServiceProvider.
═════════════════════════════════════════════════════════════════════ --}}
@php
    $packages = data_get($product->pricing, 'packages', []);
@endphp

@if($product->pricing_enabled && is_array($packages) && count($packages) > 0)
    @php
        $title    = data_get($product->pricing, $isRtl ? 'title_ar' : 'title_en')
                    ?: ($isRtl ? 'اختر الباقة المناسبة لك' : 'Choose the right plan');
        $subtitle = data_get($product->pricing, $isRtl ? 'subtitle_ar' : 'subtitle_en')
                    ?: ($isRtl ? 'باقات مرنة تناسب حجم عملك — ادفع سنويًا أو ربع سنوي.' : 'Flexible plans for any team size — pay yearly or quarterly.');
        $currency = data_get($product->pricing, $isRtl ? 'currency_ar' : 'currency_en') ?: ($isRtl ? 'ر.س' : 'SAR');
        $footnote = data_get($product->pricing, $isRtl ? 'footnote_ar' : 'footnote_en');

        // Encode the packages for Alpine so prices flip instantly when the user toggles billing.
        $alpinePackages = json_encode(array_map(function ($p) use ($isRtl, $currency) {
            $name        = $isRtl ? ($p['name_ar'] ?? '') : ($p['name_en'] ?? '');
            $description = $isRtl ? ($p['description_ar'] ?? '') : ($p['description_en'] ?? '');
            $features    = $isRtl ? ($p['features_ar'] ?? []) : ($p['features_en'] ?? []);
            // Repeater 'simple' stores ["string", "string"]; nested would be [{ feature: "..." }].
            $features = array_values(array_map(
                fn ($f) => is_array($f) ? ($f['feature'] ?? '') : (string) $f,
                $features ?? []
            ));
            $cta = $isRtl ? ($p['cta_text_ar'] ?? 'اطلب الباقة') : ($p['cta_text_en'] ?? 'Get started');
            $yearly    = (float) ($p['yearly_price'] ?? 0);
            $quarterly = (float) ($p['quarterly_price'] ?? 0);
            $savings   = ($quarterly > 0 && $yearly > 0 && ($quarterly * 4) > $yearly)
                ? (int) round((($quarterly * 4) - $yearly) / ($quarterly * 4) * 100)
                : 0;
            return [
                'name'        => $name,
                'description' => $description,
                'features'    => $features,
                'cta'         => $cta,
                'yearly'      => $yearly,
                'quarterly'   => $quarterly,
                'savings'     => $savings,
                'featured'    => (bool) ($p['is_featured'] ?? false),
                'currency'    => $currency,
            ];
        }, $packages), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $maxSavings = collect($packages)->map(function ($p) {
            $q = (float) ($p['quarterly_price'] ?? 0);
            $y = (float) ($p['yearly_price'] ?? 0);
            return ($q > 0 && $y > 0 && ($q * 4) > $y) ? round((($q * 4) - $y) / ($q * 4) * 100) : 0;
        })->max();
    @endphp

    <section id="pricing" class="py-20 bg-white relative overflow-hidden"
             x-data="{
                 billing: 'yearly',
                 packages: {{ $alpinePackages }},
                 price(p) { return this.billing === 'yearly' ? p.yearly : p.quarterly; },
                 period() { return this.billing === 'yearly'
                     ? '{{ $isRtl ? 'سنويًا' : '/ year' }}'
                     : '{{ $isRtl ? 'كل 3 أشهر' : '/ quarter' }}'; }
             }">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 left-1/3 w-96 h-96 bg-blue-50 rounded-full opacity-60 blur-3xl"></div>
            <div class="absolute -bottom-24 right-1/3 w-96 h-96 bg-cyan-50 rounded-full opacity-60 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">{{ $isRtl ? 'الأسعار' : 'Pricing' }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-3">{{ $title }}</h2>
                <p class="text-lg text-gray-600">{{ $subtitle }}</p>
            </div>

            {{-- Billing-cycle toggle --}}
            <div class="flex justify-center mb-12">
                <div class="inline-flex items-center bg-slate-100 rounded-full p-1 border border-slate-200 shadow-sm">
                    <button type="button"
                            @click="billing = 'yearly'"
                            :class="billing === 'yearly' ? 'bg-white text-blue-700 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                            class="px-5 py-2 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                        {{ $isRtl ? 'سنوي' : 'Yearly' }}
                        @if($maxSavings > 0)
                            <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full">
                                {{ $isRtl ? 'وفر حتى ' . $maxSavings . '%' : 'Save up to ' . $maxSavings . '%' }}
                            </span>
                        @endif
                    </button>
                    <button type="button"
                            @click="billing = 'quarterly'"
                            :class="billing === 'quarterly' ? 'bg-white text-blue-700 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                            class="px-5 py-2 rounded-full text-sm font-bold transition-all">
                        {{ $isRtl ? 'ربع سنوي' : 'Quarterly' }}
                    </button>
                </div>
            </div>

            {{-- Package cards --}}
            @php
                $pkgGridClass = match (min(count($packages), 4)) {
                    1       => 'lg:grid-cols-1 max-w-md',
                    2       => 'lg:grid-cols-2 max-w-4xl',
                    3       => 'lg:grid-cols-3 max-w-6xl',
                    default => 'lg:grid-cols-4 max-w-7xl',
                };
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 {{ $pkgGridClass }} gap-8 mx-auto">
                <template x-for="(p, idx) in packages" :key="idx">
                    <div :class="p.featured
                        ? 'relative bg-gradient-to-br from-blue-600 to-cyan-600 text-white shadow-2xl scale-[1.02] ring-4 ring-cyan-500/20'
                        : 'relative bg-white text-gray-900 shadow-lg border border-gray-200 hover:shadow-2xl hover:-translate-y-1'"
                         class="rounded-2xl p-8 transition-all duration-300">

                        {{-- "Most popular" ribbon --}}
                        <div x-show="p.featured" x-cloak
                             class="absolute -top-4 left-1/2 -translate-x-1/2 bg-amber-400 text-amber-900 text-xs font-bold uppercase tracking-wider px-4 py-1 rounded-full shadow-md">
                            {{ $isRtl ? 'الأكثر طلبًا' : 'Most popular' }}
                        </div>

                        {{-- Yearly savings badge (per-package) --}}
                        <div x-show="billing === 'yearly' && p.savings > 0" x-cloak
                             class="absolute top-6 {{ $isRtl ? 'left-6' : 'right-6' }} bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">
                            <span x-text="`{{ $isRtl ? 'وفر' : 'Save' }} ${p.savings}%`"></span>
                        </div>

                        <h3 class="text-2xl font-bold mb-2" x-text="p.name"></h3>
                        <p class="opacity-80 mb-6 text-sm leading-relaxed" x-text="p.description"></p>

                        {{-- Price block --}}
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="text-5xl font-extrabold" x-text="price(p).toLocaleString()"></span>
                            <span class="text-sm opacity-70 font-medium" x-text="p.currency"></span>
                        </div>
                        <div class="text-sm opacity-70 -mt-4 mb-8" x-text="period()"></div>

                        {{-- Features list --}}
                        <ul class="space-y-3 mb-8 text-sm">
                            <template x-for="(f, fIdx) in p.features" :key="fIdx">
                                <li class="flex items-start gap-3">
                                    <span class="material-icons-round shrink-0"
                                          :class="p.featured ? 'text-cyan-200' : 'text-blue-600'"
                                          style="font-size: 1.125rem;">check_circle</span>
                                    <span class="leading-relaxed" x-text="f"></span>
                                </li>
                            </template>
                        </ul>

                        {{-- CTA: jumps to the contact form on the same page --}}
                        <a href="#demo"
                           :class="p.featured
                               ? 'bg-white text-blue-700 hover:bg-gray-50'
                               : 'bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white'"
                           class="block w-full text-center px-6 py-3.5 rounded-xl font-bold transition-all transform hover:-translate-y-0.5 shadow-md">
                            <span x-text="p.cta"></span>
                        </a>
                    </div>
                </template>
            </div>

            @if($footnote)
                <p class="text-center text-sm text-gray-500 mt-10">{{ $footnote }}</p>
            @endif
        </div>
    </section>
@endif
