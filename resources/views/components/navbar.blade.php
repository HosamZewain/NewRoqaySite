<nav x-data="{ open: false, scrolled: false }" 
    @scroll.window="scrolled = (window.pageYOffset > 20)" 
    :class="{'bg-[#0a1628]/90 backdrop-blur-md shadow-lg': scrolled, 'bg-[#0a1628]': !scrolled}" 
    class="fixed w-full z-50 transition-all duration-300 border-b border-white/10">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo + bilingual wordmark -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route($locale . '.home') }}" class="flex items-center gap-3" aria-label="RoQay — رقي">
                    {{-- Prefer the brand PNG; falls back to SVG approximation if missing --}}
                    <img src="{{ asset('images/logo.png') }}"
                         onerror="this.onerror=null;this.src='{{ asset('images/logo.svg') }}';"
                         alt="RoQay"
                         class="h-12 sm:h-14 w-auto bg-white rounded-lg p-1.5 shadow-sm">
                    <span class="flex flex-col leading-none" aria-hidden="true">
                        <span lang="ar" dir="rtl" class="font-cairo font-semibold text-xl sm:text-2xl text-white">رقي</span>
                        <span lang="en" dir="ltr" class="font-cairo font-semibold text-[0.7rem] sm:text-xs text-cyan-300 tracking-[0.25em] mt-1">RoQay</span>
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1 {{ $isRtl ? 'space-x-reverse' : '' }}">
                @foreach($headerMenu as $item)
                    <a href="{{ $isRtl ? $item->url_ar : $item->url_en }}" 
                       target="{{ $item->open_in_new_tab ? '_blank' : '_self' }}"
                       class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-white/5">
                        {{ $isRtl ? $item->label_ar : $item->label_en }}
                    </a>
                @endforeach
                
                <!-- Language Switcher -->
                <div class="{{ $isRtl ? 'mr-4 pr-4 border-r' : 'ml-4 pl-4 border-l' }} border-white/20">
                    @if($locale === 'ar')
                        <a href="{{ str_replace(url('/'), url('/en'), request()->url()) }}" class="text-sm font-bold text-cyan-400 hover:text-cyan-300 transition-colors">EN</a>
                    @else
                        <a href="{{ str_replace(url('/en'), url('/'), request()->url()) }}" class="text-sm font-bold text-cyan-400 hover:text-cyan-300 transition-colors font-tajawal">عربي</a>
                    @endif
                </div>

                <!-- CTA Button -->
                <a href="{{ route($locale . '.contact') }}" class="{{ $isRtl ? 'mr-4' : 'ml-4' }} bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-all transform hover:scale-105 hover:shadow-[0_0_15px_rgba(6,182,212,0.5)] whitespace-nowrap">
                    {{ $isRtl ? 'اطلب عرض توضيحي' : 'Request Demo' }}
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-white/10 focus:outline-none">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-[#0a1628] border-b border-white/10" x-cloak>
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            @foreach($headerMenu as $item)
                <a href="{{ $isRtl ? $item->url_ar : $item->url_en }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-white/5">
                    {{ $isRtl ? $item->label_ar : $item->label_en }}
                </a>
            @endforeach
            
            <div class="mt-4 pt-4 border-t border-white/10 flex justify-between items-center px-3">
                @if($locale === 'ar')
                    <a href="{{ str_replace(url('/'), url('/en'), request()->url()) }}" class="text-cyan-400 font-bold">English Version</a>
                @else
                    <a href="{{ str_replace(url('/en'), url('/'), request()->url()) }}" class="text-cyan-400 font-bold font-tajawal">النسخة العربية</a>
                @endif
                
                <a href="{{ route($locale . '.contact') }}" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    {{ $isRtl ? 'اطلب عرض' : 'Get Demo' }}
                </a>
            </div>
        </div>
    </div>
</nav>
