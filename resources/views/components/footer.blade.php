<footer class="bg-[#0f172a] text-gray-300 border-t border-white/10 relative overflow-hidden">
    <!-- Background glow effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 md:gap-12">
            
            <!-- Company Info -->
            <div class="space-y-6">
                <a href="{{ route($locale . '.home') }}" class="flex items-center" aria-label="{{ $isRtl ? ($settings['site_name_ar'] ?? 'رقي') : ($settings['site_name_en'] ?? 'RoQay') }}">
                    <img src="{{ asset('images/logo.png') }}"
                         onerror="this.onerror=null;this.src='{{ asset('images/logo.svg') }}';"
                         alt="{{ $isRtl ? ($settings['site_name_ar'] ?? 'رقي') : ($settings['site_name_en'] ?? 'RoQay') }}"
                         class="h-16 w-auto bg-white rounded-lg p-2">
                </a>
                <p class="text-gray-400 leading-relaxed">
                    {{ $isRtl ? ($settings['footer_text_ar'] ?? '') : ($settings['footer_text_en'] ?? '') }}
                </p>
                <div class="flex space-x-4 {{ $isRtl ? 'space-x-reverse' : '' }}">
                    @if(!empty($settings['facebook']))
                    <a href="{{ $settings['facebook'] }}" target="_blank" class="text-gray-400 hover:text-cyan-400 transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.891h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
                    @if(!empty($settings['twitter']))
                    <a href="{{ $settings['twitter'] }}" target="_blank" class="text-gray-400 hover:text-cyan-400 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                    </a>
                    @endif
                    @if(!empty($settings['linkedin']))
                    <a href="{{ $settings['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-cyan-400 transition-colors">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-6">{{ $isRtl ? 'روابط سريعة' : 'Quick Links' }}</h3>
                <ul class="space-y-4">
                    @foreach($footerMenu as $item)
                        <li>
                            <a href="{{ $isRtl ? $item->url_ar : $item->url_en }}" class="text-gray-400 hover:text-cyan-400 transition-colors flex items-center">
                                <span class="material-icons-round text-sm {{ $isRtl ? 'ml-2' : 'mr-2' }}">{{ $isRtl ? 'chevron_left' : 'chevron_right' }}</span>
                                {{ $isRtl ? $item->label_ar : $item->label_en }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-6">{{ $isRtl ? 'تواصل معنا' : 'Contact Us' }}</h3>
                <ul class="space-y-4 text-gray-400">
                    @if(!empty($settings['email']))
                    <li class="flex items-start">
                        <span class="material-icons-round text-cyan-500 mt-1 {{ $isRtl ? 'ml-3' : 'mr-3' }}">email</span>
                        <span>{{ $settings['email'] }}</span>
                    </li>
                    @endif
                    @if(!empty($settings['phone']))
                    <li class="flex items-start">
                        <span class="material-icons-round text-cyan-500 mt-1 {{ $isRtl ? 'ml-3' : 'mr-3' }}">phone</span>
                        <span dir="ltr">{{ $settings['phone'] }}</span>
                    </li>
                    @endif
                    @if(!empty($settings['address_ar']) || !empty($settings['address_en']))
                    <li class="flex items-start">
                        <span class="material-icons-round text-cyan-500 mt-1 {{ $isRtl ? 'ml-3' : 'mr-3' }}">location_on</span>
                        <span>{{ $isRtl ? ($settings['address_ar'] ?? '') : ($settings['address_en'] ?? '') }}</span>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Newsletter (Visual) -->
            <div>
                <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-6">{{ $isRtl ? 'النشرة البريدية' : 'Newsletter' }}</h3>
                <p class="text-gray-400 mb-4">{{ $isRtl ? 'اشترك للحصول على آخر الأخبار والتحديثات التقنية.' : 'Subscribe to get the latest news and tech updates.' }}</p>
                <form class="flex" onsubmit="event.preventDefault(); alert('{{ $isRtl ? 'شكراً لاشتراكك!' : 'Thank you for subscribing!' }}')">
                    <input type="email" required placeholder="{{ $isRtl ? 'بريدك الإلكتروني' : 'Your email' }}" class="w-full bg-[#1e293b] border border-gray-700 rounded-l-lg {{ $isRtl ? 'rounded-r-lg rounded-l-none' : '' }} px-4 py-2 text-white focus:outline-none focus:border-cyan-500 transition-colors">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white px-4 py-2 rounded-r-lg {{ $isRtl ? 'rounded-l-lg rounded-r-none' : '' }} font-medium transition-all">
                        {{ $isRtl ? 'اشترك' : 'Subscribe' }}
                    </button>
                </form>
            </div>
            
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500">
                {{ $isRtl ? ($settings['copyright_ar'] ?? '') : ($settings['copyright_en'] ?? '') }}
            </p>
            <div class="flex space-x-6 {{ $isRtl ? 'space-x-reverse' : '' }}">
                <a href="{{ route($locale . '.home') }}" class="text-sm text-gray-500 hover:text-white transition-colors">{{ $isRtl ? 'الرئيسية' : 'Home' }}</a>
                <a href="{{ route('sitemap') }}" class="text-sm text-gray-500 hover:text-white transition-colors">{{ $isRtl ? 'خريطة الموقع' : 'Sitemap' }}</a>
            </div>
        </div>
    </div>
</footer>
