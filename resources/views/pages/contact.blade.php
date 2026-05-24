@extends('layouts.app')

@section('seo')
    @include('partials.seo', [
        'seoTitle' => ($isRtl ? 'تواصل معنا' : 'Contact Us') . ' | ' . ($settings['site_name_'.$locale] ?? 'RoQay'),
        'seoDescription' => $isRtl ? 'تواصل مع فريق رقي للاستفسار عن منتجاتنا وخدماتنا.' : 'Contact RoQay team to inquire about our products and services.'
    ])
@endsection

@section('content')
    <section class="bg-[#0a1628] pt-32 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 to-cyan-900/20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            @include('partials.breadcrumbs', ['items' => [['label' => $isRtl ? 'تواصل معنا' : 'Contact Us']]])
            <h1 class="text-4xl md:text-5xl font-bold text-white mt-6 mb-4">{{ $isRtl ? 'تواصل معنا' : 'Contact Us' }}</h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">{{ $isRtl ? 'نحن هنا لمساعدتك. فريقنا التقني جاهز للإجابة على جميع استفساراتك.' : 'We are here to help. Our technical team is ready to answer all your inquiries.' }}</p>
        </div>
    </section>

    <section class="py-20 bg-slate-50 relative -mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row">
                
                <!-- Contact Info -->
                <div class="lg:w-1/3 bg-gradient-to-br from-blue-600 to-cyan-600 p-10 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -ml-10 -mb-10"></div>
                    
                    <div class="relative z-10 h-full flex flex-col">
                        <h2 class="text-2xl font-bold mb-8">{{ $isRtl ? 'معلومات التواصل' : 'Contact Information' }}</h2>
                        
                        <div class="space-y-8 flex-1">
                            @if(!empty($settings['address_ar']) || !empty($settings['address_en']))
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center shrink-0 {{ $isRtl ? 'ml-4' : 'mr-4' }}">
                                    <span class="material-icons-round text-cyan-300">location_on</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-blue-100 mb-1">{{ $isRtl ? 'العنوان' : 'Address' }}</h3>
                                    <p>{{ $isRtl ? ($settings['address_ar'] ?? '') : ($settings['address_en'] ?? '') }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!empty($settings['phone']))
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center shrink-0 {{ $isRtl ? 'ml-4' : 'mr-4' }}">
                                    <span class="material-icons-round text-cyan-300">phone</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-blue-100 mb-1">{{ $isRtl ? 'الهاتف' : 'Phone' }}</h3>
                                    <p dir="ltr" class="text-end {{ $isRtl ? 'text-start' : '' }}">{{ $settings['phone'] }}</p>
                                </div>
                            </div>
                            @endif

                            @if(!empty($settings['email']))
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center shrink-0 {{ $isRtl ? 'ml-4' : 'mr-4' }}">
                                    <span class="material-icons-round text-cyan-300">email</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-blue-100 mb-1">{{ $isRtl ? 'البريد الإلكتروني' : 'Email' }}</h3>
                                    <p>{{ $settings['email'] }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Social -->
                        <div class="mt-8 pt-8 border-t border-white/20">
                            <h3 class="font-semibold text-blue-100 mb-4">{{ $isRtl ? 'تابعنا على' : 'Follow Us' }}</h3>
                            <div class="flex space-x-4 {{ $isRtl ? 'space-x-reverse' : '' }}">
                                @if(!empty($settings['facebook']))
                                <a href="{{ $settings['facebook'] }}" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.891h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                </a>
                                @endif
                                @if(!empty($settings['twitter']))
                                <a href="{{ $settings['twitter'] }}" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="lg:w-2/3 p-10 lg:p-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ $isRtl ? 'أرسل لنا رسالة' : 'Send us a message' }}</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-8 flex items-center gap-3">
                            <span class="material-icons-round">check_circle</span>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route($locale . '.contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'البريد الإلكتروني' : 'Email Address' }} <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('email') }}" dir="ltr">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'رقم الهاتف' : 'Phone Number' }}</label>
                                <input type="text" name="phone" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('phone') }}" dir="ltr">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'المنتج المهتم به' : 'Interested Product' }}</label>
                                <select name="interested_product" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
                                    <option value="">{{ $isRtl ? 'اختر المنتج...' : 'Select product...' }}</option>
                                    @foreach(\App\Models\Product::active()->get() as $prod)
                                        <option value="{{ $isRtl ? $prod->title_ar : $prod->title_en }}">{{ $isRtl ? $prod->title_ar : $prod->title_en }}</option>
                                    @endforeach
                                    <option value="other">{{ $isRtl ? 'أخرى' : 'Other' }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'الرسالة' : 'Message' }}</label>
                            <textarea name="message" rows="5" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">{{ old('message') }}</textarea>
                        </div>
                        
                        <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all transform hover:-translate-y-1">
                            {{ $isRtl ? 'إرسال الرسالة' : 'Send Message' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
