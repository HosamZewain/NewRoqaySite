<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomepageSection::create([
            'section_key' => 'hero',
            'title_ar' => 'رقي لأنظمة برمجية أذكى ونمو أسرع',
            'title_en' => 'RoQay for Smarter Software and Faster Growth',
            'subtitle_ar' => 'نطور ونوفر أنظمة برمجية تساعد الشركات على إدارة عملياتها، تحسين الأداء، تقليل الأخطاء، واتخاذ قرارات أفضل من خلال حلول عملية قابلة للتطوير.',
            'subtitle_en' => 'We develop and deliver scalable software systems that help companies manage operations, improve performance, reduce errors, and make better business decisions.',
            'extra_data' => [
                'buttons' => [
                    ['text_ar' => 'استكشف منتجات رقي', 'text_en' => 'Explore RoQay Products', 'url' => '/products', 'style' => 'primary'],
                    ['text_ar' => 'اطلب عرض توضيحي', 'text_en' => 'Request a Demo', 'url' => '/contact', 'style' => 'secondary'],
                    ['text_ar' => 'تواصل عبر واتساب', 'text_en' => 'Contact via WhatsApp', 'url' => 'https://wa.me/966500000000', 'style' => 'whatsapp']
                ]
            ],
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HomepageSection::create([
            'section_key' => 'why_roqay',
            'title_ar' => 'لماذا تختار رقي؟',
            'title_en' => 'Why Choose RoQay?',
            'subtitle_ar' => 'نحن لسنا مجرد مزود تقني، بل شريك لنجاحك',
            'subtitle_en' => 'We are not just a technical provider, but a partner in your success',
            'extra_data' => [
                'cards' => [
                    ['title_ar' => 'خبرة واسعة', 'title_en' => 'Extensive Experience', 'icon' => 'workspace_premium', 'desc_ar' => 'نمتلك فريق محترف بخبرة تمتد لسنوات في السوق.', 'desc_en' => 'We have a professional team with years of market experience.'],
                    ['title_ar' => 'حلول متكاملة', 'title_en' => 'Integrated Solutions', 'icon' => 'extension', 'desc_ar' => 'نقدم لك كل ما تحتاجه في مكان واحد.', 'desc_en' => 'We provide everything you need in one place.'],
                    ['title_ar' => 'دعم فني متميز', 'title_en' => 'Premium Support', 'icon' => 'support_agent', 'desc_ar' => 'نحن معك دائماً لضمان استمرارية عملك.', 'desc_en' => 'We are always with you to ensure your business continuity.']
                ]
            ],
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HomepageSection::create([
            'section_key' => 'stats',
            'title_ar' => 'أرقام نفخر بها',
            'title_en' => 'Numbers We Are Proud Of',
            'extra_data' => [
                'counters' => [
                    ['value' => 150, 'suffix_ar' => '+', 'suffix_en' => '+', 'label_ar' => 'عميل', 'label_en' => 'Clients'],
                    ['value' => 200, 'suffix_ar' => '+', 'suffix_en' => '+', 'label_ar' => 'مشروع', 'label_en' => 'Projects'],
                    ['value' => 15, 'suffix_ar' => '+', 'suffix_en' => '+', 'label_ar' => 'سنة خبرة', 'label_en' => 'Years Experience'],
                    ['value' => 99, 'suffix_ar' => '%', 'suffix_en' => '%', 'label_ar' => 'رضا العملاء', 'label_en' => 'Client Satisfaction']
                ]
            ],
            'sort_order' => 3,
            'is_active' => true,
        ]);

        HomepageSection::create([
            'section_key' => 'how_it_works',
            'title_ar' => 'كيف نعمل',
            'title_en' => 'How We Work',
            'extra_data' => [
                'steps' => [
                    ['number' => 1, 'title_ar' => 'تحليل الاحتياجات', 'title_en' => 'Requirements Analysis', 'desc_ar' => 'نفهم طبيعة عملك واحتياجاتك الفعلية', 'desc_en' => 'We understand your business and actual needs'],
                    ['number' => 2, 'title_ar' => 'تصميم الحل', 'title_en' => 'Solution Design', 'desc_ar' => 'نصمم الحل الأنسب لعملك', 'desc_en' => 'We design the best solution for your business'],
                    ['number' => 3, 'title_ar' => 'التنفيذ والتدريب', 'title_en' => 'Implementation & Training', 'desc_ar' => 'ننفذ النظام وندرب فريقك', 'desc_en' => 'We implement the system and train your team'],
                    ['number' => 4, 'title_ar' => 'الدعم المستمر', 'title_en' => 'Ongoing Support', 'desc_ar' => 'نوفر دعم فني مستمر بعد التشغيل', 'desc_en' => 'We provide continuous technical support']
                ]
            ],
            'sort_order' => 4,
            'is_active' => true,
        ]);
        
        // Visibility-only placeholders. Their content is hardcoded in the home view;
        // these rows exist purely so admins can toggle the section on/off.
        $otherSections = ['trust_strip', 'products_preview', 'ai_software', 'industries', 'testimonials', 'blog_preview', 'faq', 'final_cta'];
        $order = 5;
        foreach($otherSections as $key) {
            HomepageSection::updateOrCreate(
                ['section_key' => $key],
                ['title_ar' => $key, 'title_en' => $key, 'is_active' => true, 'sort_order' => $order++]
            );
        }
    }
}
