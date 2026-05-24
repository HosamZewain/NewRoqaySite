<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question_ar' => 'ما هي الخدمات التي تقدمها رقي؟',
                'question_en' => 'What services does RoQay provide?',
                'answer_ar' => 'نقدم مجموعة متكاملة من الخدمات التقنية تشمل تطوير البرمجيات المخصصة، توفير الأنظمة الجاهزة كأنظمة إدارة المطاعم والشركات، وتطوير التطبيقات والمواقع الإلكترونية.',
                'answer_en' => 'We offer a comprehensive range of technical services including custom software development, providing ready-made systems like restaurant and SME management systems, and web/mobile app development.',
                'category' => 'عام',
                'sort_order' => 1,
            ],
            [
                'question_ar' => 'هل تقدمون دعماً فنياً بعد البيع؟',
                'question_en' => 'Do you provide after-sales technical support?',
                'answer_ar' => 'نعم، نحن نؤمن بأن نجاح عملائنا هو نجاحنا. لذا نقدم باقات دعم فني مستمر وصيانة دورية لجميع أنظمتنا لضمان استمرارية العمل بكفاءة.',
                'answer_en' => 'Yes, we believe our clients\' success is our success. Therefore, we offer continuous technical support and maintenance packages for all our systems to ensure efficient operation.',
                'category' => 'الدعم',
                'sort_order' => 2,
            ],
            [
                'question_ar' => 'هل يمكن ربط النظام مع أجهزة الكاشير القديمة لدي؟',
                'question_en' => 'Can the system be integrated with my old POS devices?',
                'answer_ar' => 'في معظم الحالات، نعم. أنظمتنا مصممة لتكون متوافقة مع مجموعة واسعة من الأجهزة. سيقوم فريقنا التقني بتقييم أجهزتك الحالية أثناء مرحلة الدراسة.',
                'answer_en' => 'In most cases, yes. Our systems are designed to be compatible with a wide range of devices. Our technical team will evaluate your existing hardware during the study phase.',
                'category' => 'المنتجات',
                'product_id' => 1, // Restaurant System
                'sort_order' => 3,
            ]
        ];

        foreach ($faqs as $faq) {
            $faq['is_active'] = true;
            Faq::create($faq);
        }
    }
}
