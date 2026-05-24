<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Product;
use Illuminate\Database\Seeder;

class IresSystemSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::updateOrCreate(
            ['slug_ar' => 'ires-system'],
            [
                'title_ar' => 'نظام إدارة المطاعم iRes System',
                'title_en' => 'iRes System — Restaurant Management',
                'slug_en' => 'ires-system',
                'short_description_ar' => 'منصة تشغيل متكاملة تربط بين الكاشير، المطبخ، التسليم، المخزون، المشتريات، المالية، والتقارير في نظام واحد سهل وسريع — من تسجيل الطلب وحتى صافي الأرباح.',
                'short_description_en' => 'An integrated operations platform that connects POS, kitchen, dispatch, inventory, purchasing, finance, and reports in one fast system — from order entry to net profit visibility.',
                'description_ar' => '<p>نظام إدارة المطاعم <strong>iRes System</strong> من <strong>رُقي</strong> هو منصة تشغيل متكاملة مصممة خصيصًا للمطاعم التي تحتاج إلى إدارة دقيقة وسريعة لكل مراحل العمل اليومية، بداية من تسجيل الطلبات على الكاشير، مرورًا بالمطبخ والتسليم، وحتى إدارة المخزون، المشتريات، العهد، السلف، التقارير المالية، وتكاليف التشغيل.</p><p>النظام لا يركز فقط على البيع، بل يغطي دورة التشغيل الكاملة للمطعم، مما يساعد الإدارة على تقليل الأخطاء، تسريع الخدمة، مراقبة المخزون، معرفة تكلفة الأصناف، وتحليل الأداء اليومي والشهري بدقة.</p>',
                'description_en' => '<p><strong>iRes System</strong> by <strong>RoQay</strong> is a full operations platform built specifically for restaurants that need precise, fast control over every stage of daily work — from POS order entry, through kitchen and dispatch, to inventory, purchasing, custody, advances, financial reports, and operating costs.</p><p>The system covers the full restaurant operating cycle — not just sales — so management can reduce errors, speed up service, monitor stock, understand item cost, and analyze daily and monthly performance accurately.</p>',
                'features_ar' => [
                    'نقطة بيع POS سريعة وعملية',
                    'إدارة أنواع الطلبات والقنوات (تيك أواي، دليفري، بيك أب، موقع)',
                    'شاشة المطبخ بطلبات مؤكدة فقط',
                    'شاشات تسليم وكاونتر متعددة',
                    'لوحة Dispatch لمراجعة طلبات الموقع والكول سنتر',
                    'إدارة العملاء والعناوين',
                    'مخزون متعدد المواقع',
                    'فواتير المشتريات والاستلام',
                    'متوسط تكلفة المخزون',
                    'وصفات الأصناف Recipes',
                    'التشغيلة / الإنتاج الداخلي',
                    'طلبات صرف المخزون باعتمادات',
                    'قوالب طلبات الصرف المتكررة',
                    'الجرد اليومي الجماعي',
                    'الهالك المعتمد',
                    'الصندوق والبنك',
                    'العهد والسلف وحسابات الشركاء',
                    'تقرير اليومية الشامل',
                    'تقارير المبيعات والمشتريات والفود كوست',
                    'تقرير الأرباح والخسائر التشغيلي',
                    'نظام صلاحيات مرن لكل دور',
                    'موقع طلبات للعملاء',
                    'Release Notes وإشعارات داخلية',
                ],
                'features_en' => [
                    'Fast, focused POS',
                    'Multiple order types & channels (Takeaway, Delivery, Pickup, Web)',
                    'Kitchen Display with confirmed orders only',
                    'Multiple delivery & counter screens',
                    'Dispatch board for website and call-center orders',
                    'Customer & address management',
                    'Multi-location inventory',
                    'Purchase invoices & goods receipt',
                    'Weighted-average inventory cost',
                    'Item recipes',
                    'Internal production / prep batches',
                    'Stock issue requests with approvals',
                    'Reusable issue-request templates',
                    'Bulk daily stocktake',
                    'Approved waste tracking',
                    'Cash & bank registers',
                    'Custody, advances & partner accounts',
                    'Full daily operations report',
                    'Sales, purchasing, food-cost reports',
                    'Operational P&L report',
                    'Flexible role-based permissions',
                    'Customer-facing online ordering site',
                    'In-app release notes & notifications',
                ],
                'benefits_ar' => [
                    'تقليل أخطاء الكاشير وتسريع الطلب',
                    'تنظيم عمل المطبخ ومتابعة التسليم',
                    'ضبط المخزون ومعرفة تكلفة كل صنف',
                    'مراقبة الهالك والعهد والسلف',
                    'متابعة الفود كوست والأرباح اليومية',
                    'قرارات تشغيلية أفضل ببيانات لحظية',
                ],
                'benefits_en' => [
                    'Fewer cashier errors, faster order taking',
                    'Organized kitchen and tracked delivery',
                    'Stock control with true per-item cost',
                    'Visibility into waste, custody, advances',
                    'Daily food-cost and profit tracking',
                    'Better operational decisions with live data',
                ],
                'icon' => 'restaurant_menu',
                'hero_headline_ar' => 'نظام متكامل لإدارة وتشغيل المطاعم',
                'hero_headline_en' => 'A complete operations platform for restaurants',
                'hero_subheadline_ar' => 'من تسجيل الطلب وحتى معرفة تكلفة الصنف وصافي الأرباح — رؤية كاملة على تشغيل مطعمك لحظة بلحظة.',
                'hero_subheadline_en' => 'From order entry to per-item cost and net profit — full real-time visibility into your restaurant operations.',
                'target_audience_ar' => 'مطاعم الفول والطعمية، الوجبات السريعة، مطاعم التيك أواي والدليفري، المطاعم التي تحتاج ربط الكاشير بالمطبخ والمخزون والحسابات.',
                'target_audience_en' => 'Quick-service restaurants, takeaway and delivery brands, kitchens that need POS connected to inventory, recipes, and accounting.',
                'seo_title_ar' => 'نظام إدارة المطاعم iRes System | رُقي',
                'seo_title_en' => 'iRes System — Restaurant Management Platform | RoQay',
                'seo_description_ar' => 'iRes System من رُقي: نظام إدارة مطاعم متكامل — POS، شاشة مطبخ، دليفري، مخزون متعدد المواقع، وصفات، فود كوست، تقارير، وصلاحيات.',
                'seo_description_en' => 'iRes System by RoQay: full restaurant operations — POS, kitchen display, dispatch, multi-location inventory, recipes, food-cost, reports, role-based permissions.',
                'seo_keywords_ar' => 'iRes, نظام مطاعم, POS مطاعم, شاشة مطبخ, إدارة مخزون مطاعم, فود كوست, رُقي',
                'seo_keywords_en' => 'iRes System, restaurant POS, kitchen display, restaurant inventory, food cost, RoQay',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // Bump pre-existing products' sort_order so iRes is first
        Product::where('id', '!=', $product->id)->where('sort_order', '<', 2)->increment('sort_order', 2);

        $faqs = [
            ['q_ar' => 'هل النظام مناسب للمطاعم متعددة الفروع؟', 'q_en' => 'Does iRes support multi-branch restaurants?',
             'a_ar' => 'نعم. النظام يدعم مخزونًا متعدد المواقع وقابل للتوسع بإضافة فروع وقنوات بيع جديدة وتقارير مخصصة حسب الحاجة.',
             'a_en' => 'Yes. iRes supports multi-location inventory and scales to additional branches, sales channels, and custom reports.'],
            ['q_ar' => 'هل يمكن تخصيص النظام حسب احتياج مطعمي؟', 'q_en' => 'Can the system be customized for my restaurant?',
             'a_ar' => 'النظام مبني على Laravel ويسمح بإضافة قنوات بيع، تقارير، تكامل مع تطبيقات التوصيل، بوابة عملاء، وإشعارات متقدمة.',
             'a_en' => 'iRes is built on Laravel and can be extended with new sales channels, custom reports, delivery-app integrations, customer portals, and richer notifications.'],
            ['q_ar' => 'كيف يحسب النظام تكلفة الصنف؟', 'q_en' => 'How does iRes calculate item cost?',
             'a_ar' => 'يعتمد النظام على متوسط تكلفة الصنف من فواتير الشراء، وعند بيع الصنف يخصم مكونات الوصفة من المخزون لحساب تكلفة دقيقة وفود كوست فعلي.',
             'a_en' => 'iRes uses weighted-average cost from purchase invoices, and deducts recipe components from stock on each sale to give true per-item cost and actual food-cost.'],
            ['q_ar' => 'هل طلبات الموقع الإلكتروني تدخل المطبخ مباشرة؟', 'q_en' => 'Do website orders go straight to the kitchen?',
             'a_ar' => 'لا. تمر طلبات الموقع والكول سنتر عبر لوحة Dispatch لمراجعتها وتأكيدها أولًا، ثم تظهر في شاشة المطبخ — لمنع الطلبات الوهمية أو غير المؤكدة.',
             'a_en' => 'No — website and call-center orders go through a Dispatch board for review and confirmation before reaching the kitchen, preventing fake or unverified orders.'],
            ['q_ar' => 'هل النظام يدعم اللغة العربية واتجاه RTL؟', 'q_en' => 'Does iRes support Arabic and RTL?',
             'a_ar' => 'نعم، النظام بُني أصلًا بدعم كامل للغة العربية واتجاه RTL في الكاشير ولوحة الإدارة وكل التقارير.',
             'a_en' => 'Yes. iRes was built with first-class Arabic and RTL support across POS, admin panel, and all reports.'],
        ];

        foreach ($faqs as $i => $faq) {
            Faq::updateOrCreate(
                ['product_id' => $product->id, 'question_ar' => $faq['q_ar']],
                [
                    'question_en' => $faq['q_en'],
                    'answer_ar' => $faq['a_ar'],
                    'answer_en' => $faq['a_en'],
                    'category' => 'iRes',
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
