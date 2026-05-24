<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title_ar' => 'كيف تختار نظام إدارة مناسب لمطعمك؟',
                'title_en' => 'How to Choose the Right Management System for Your Restaurant',
                'slug_ar' => 'how-to-choose-restaurant-system',
                'slug_en' => 'how-to-choose-restaurant-system-en',
                'excerpt_ar' => 'تعرف على أهم المعايير التي يجب مراعاتها عند اختيار نظام إدارة المطاعم لضمان نجاح استثمارك.',
                'excerpt_en' => 'Learn the most important criteria to consider when choosing a restaurant management system to ensure the success of your investment.',
                'content_ar' => '<p>اختيار النظام المناسب لمطعمك يعتبر خطوة حاسمة في طريق النجاح.</p>',
                'content_en' => '<p>Choosing the right system for your restaurant is a crucial step towards success.</p>',
                'author_name' => 'فريق رقي',
                'category' => 'المطاعم',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title_ar' => 'أهمية التحول الرقمي للشركات الصغيرة والمتوسطة',
                'title_en' => 'The Importance of Digital Transformation for SMEs',
                'slug_ar' => 'digital-transformation-sme',
                'slug_en' => 'digital-transformation-sme-en',
                'excerpt_ar' => 'كيف يمكن للتحول الرقمي أن يضاعف من أرباح شركتك ويزيد من كفاءتها التشغيلية.',
                'excerpt_en' => 'How digital transformation can double your company\'s profits and increase its operational efficiency.',
                'content_ar' => '<p>التحول الرقمي لم يعد خياراً بل ضرورة للاستمرار في السوق التنافسي اليوم.</p>',
                'content_en' => '<p>Digital transformation is no longer an option but a necessity to survive in today\'s competitive market.</p>',
                'author_name' => 'فريق رقي',
                'category' => 'الشركات',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ]
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
