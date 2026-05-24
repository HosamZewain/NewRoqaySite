<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name_ar' => 'أحمد محمد',
                'client_name_en' => 'Ahmed Mohamed',
                'company_ar' => 'شركة الأفق المتقدم',
                'company_en' => 'Advanced Horizon Co',
                'position_ar' => 'المدير العام',
                'position_en' => 'General Manager',
                'review_ar' => 'نظام إدارة الشركات من رقي ساعدنا بشكل كبير في تنظيم عملياتنا اليومية وزيادة كفاءة فريق العمل.',
                'review_en' => 'RoQay\'s SME management system greatly helped us organize our daily operations and increase our team\'s efficiency.',
                'rating' => 5,
                'sort_order' => 1,
            ],
            [
                'client_name_ar' => 'سارة عبدالله',
                'client_name_en' => 'Sarah Abdullah',
                'company_ar' => 'سلسلة مطاعم الذواقة',
                'company_en' => 'Gourmet Chain Restaurants',
                'position_ar' => 'مدير العمليات',
                'position_en' => 'Operations Manager',
                'review_ar' => 'نظام رقي للمطاعم من أفضل الأنظمة التي تعاملنا معها، الدعم الفني ممتاز وسرعة الاستجابة رائعة.',
                'review_en' => 'RoQay restaurant system is one of the best we have dealt with, technical support is excellent and response time is great.',
                'rating' => 5,
                'sort_order' => 2,
            ]
        ];

        foreach ($testimonials as $testimonial) {
            $testimonial['is_active'] = true;
            Testimonial::create($testimonial);
        }
    }
}
