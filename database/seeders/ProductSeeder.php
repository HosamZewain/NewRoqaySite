<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title_ar' => 'نظام إدارة المطاعم',
            'title_en' => 'Restaurant Management System',
            'slug_ar' => 'restaurant-management-system',
            'slug_en' => 'restaurant-management-system-en',
            'short_description_ar' => 'نظام متكامل لإدارة المطاعم والكافيهات يساعدك على التحكم في المبيعات، الكاشير، المطبخ، المخزون، الورديات، المصروفات، والتقارير من مكان واحد.',
            'short_description_en' => 'An integrated restaurant and café management system that helps control sales, POS, kitchen operations, inventory, shifts, expenses, and reports from one place.',
            'description_ar' => '<p>نظام إدارة المطاعم من رقي هو الحل الشامل الذي تحتاجه لتحويل عمليات مطعمك إلى تجربة سلسة وفعالة. يغطي النظام كافة الجوانب التشغيلية بدءًا من الكاشير ونقاط البيع السريعة، مرورًا بشاشات المطبخ الذكية التي تنظم الطلبات، وصولاً إلى إدارة المخزون والموردين بدقة متناهية.</p>
                                 <p>سواء كنت تدير مطعماً واحداً أو سلسلة مطاعم متعددة الفروع، يوفر لك النظام تقارير لحظية حول المبيعات والأرباح والمصروفات. بفضل واجهته السهلة، ستتمكن من تقليل الأخطاء البشرية وتسريع خدمة العملاء، مما ينعكس إيجابياً على رضا الزبائن وزيادة أرباحك.</p>',
            'description_en' => '<p>The RoQay Restaurant Management System is the comprehensive solution you need to transform your restaurant operations into a seamless and efficient experience. The system covers all operational aspects, from fast POS and smart kitchen displays that organize orders, to highly accurate inventory and supplier management.</p>
                                 <p>Whether you manage a single restaurant or a multi-branch chain, the system provides real-time reports on sales, profits, and expenses. With its user-friendly interface, you can reduce human errors and speed up customer service, positively impacting customer satisfaction and increasing your profits.</p>',
            'features_ar' => ["نقاط البيع POS", "شاشة المطبخ", "إدارة المخزون والوصفات", "الورديات والصندوق", "الطلبات الخارجية والتوصيل", "طلبات الموقع الإلكتروني", "تقارير المبيعات والتكاليف", "صلاحيات المستخدمين", "إدارة المصروفات والمشتريات"],
            'features_en' => ["POS", "Kitchen Display", "Inventory and Recipes", "Shifts and Cashiers", "Delivery and Takeaway", "Website Orders", "Sales and Cost Reports", "User Roles and Permissions", "Expenses and Purchases"],
            'benefits_ar' => ["تقليل الأخطاء البشرية", "تسريع خدمة العملاء", "تحكم كامل في المخزون", "تقارير دقيقة ولحظية", "إدارة الورديات بسهولة"],
            'benefits_en' => ["Reduce human errors", "Speed up customer service", "Full inventory control", "Accurate real-time reports", "Easy shift management"],
            'modules_ar' => [
                ["title" => "نقاط البيع", "description" => "واجهة سريعة وسهلة الاستخدام لإدارة الطلبات والمدفوعات.", "icon" => "point-of-sale"],
                ["title" => "إدارة المخزون", "description" => "تتبع دقيق للمكونات والوصفات وتنبيهات عند انخفاض المخزون.", "icon" => "inventory"],
                ["title" => "التقارير التحليلية", "description" => "لوحات تحكم شاملة توفر رؤى عميقة حول أداء المبيعات والمصروفات.", "icon" => "bar-chart"]
            ],
            'modules_en' => [
                ["title" => "POS", "description" => "Fast and easy-to-use interface for managing orders and payments.", "icon" => "point-of-sale"],
                ["title" => "Inventory Management", "description" => "Accurate tracking of ingredients and recipes with low stock alerts.", "icon" => "inventory"],
                ["title" => "Analytics & Reports", "description" => "Comprehensive dashboards providing deep insights into sales and expenses.", "icon" => "bar-chart"]
            ],
            'hero_headline_ar' => 'نظام إدارة مطاعم مصمم للتشغيل الحقيقي وليس مجرد كاشير',
            'hero_headline_en' => 'A Restaurant Management System Built for Real Operations, Not Just POS',
            'hero_subheadline_ar' => 'تحكم في كل تفاصيل مطعمك من الطلب حتى التقرير النهائي: الكاشير، المطبخ، المخزون، الورديات، المصروفات، والتقارير.',
            'hero_subheadline_en' => 'Control every detail of your restaurant from order to final report: POS, kitchen, inventory, shifts, expenses, and analytics.',
            'target_audience_ar' => 'المطاعم، الكافيهات، سلاسل المطاعم، المطابخ السحابية',
            'target_audience_en' => 'Restaurants, Cafés, Restaurant chains, Cloud kitchens',
            'implementation_steps_ar' => [
                ["title" => "دراسة الاحتياج", "description" => "نقوم بفهم عمليات مطعمك لتخصيص النظام بشكل مثالي."],
                ["title" => "تجهيز النظام والمعدات", "description" => "إعداد البرمجيات وربطها بأجهزة الكاشير والطابعات."],
                ["title" => "التدريب والتشغيل", "description" => "تدريب طاقم العمل وتجربة النظام قبل الإطلاق الفعلي."]
            ],
            'implementation_steps_en' => [
                ["title" => "Requirements Study", "description" => "We understand your restaurant operations to customize the system perfectly."],
                ["title" => "System & Hardware Setup", "description" => "Setting up software and connecting it to POS machines and printers."],
                ["title" => "Training & Launch", "description" => "Training the staff and testing the system before the actual launch."]
            ],
            'icon' => 'restaurant',
            'sort_order' => 1,
            'is_active' => true,
            'seo_title_ar' => 'نظام إدارة المطاعم | رقي',
            'seo_title_en' => 'Restaurant Management System | RoQay',
            'seo_description_ar' => 'نظام متكامل لإدارة المطاعم والكافيهات - كاشير، مطبخ، مخزون، ورديات، تقارير | رقي',
            'seo_description_en' => 'Integrated restaurant management system - POS, kitchen, inventory, shifts, reports | RoQay'
        ]);

        Product::create([
            'title_ar' => 'نظام إدارة الشركات (SME)',
            'title_en' => 'SME Business Management System',
            'slug_ar' => 'sme-business-management-system',
            'slug_en' => 'sme-business-management-system-en',
            'short_description_ar' => 'نظام يساعد الشركات على إدارة العملاء، المبيعات، الفواتير، المخزون، التقارير، والعمليات اليومية بشكل منظم وسهل.',
            'short_description_en' => 'A practical system that helps SMEs manage customers, sales, invoices, inventory, reports, and daily operations in a simple and organized way.',
            'description_ar' => '<p>إدارة شركتك أصبحت أسهل مع نظام رقي المتكامل للشركات الصغيرة والمتوسطة. من خلال منصة واحدة، يمكنك متابعة عملائك، إصدار عروض الأسعار والفواتير، وإدارة العقود والمهام بكفاءة.</p>',
            'description_en' => '<p>Managing your company just got easier with RoQay\'s integrated system for SMEs. Through a single platform, you can track your customers, issue quotes and invoices, and manage contracts and tasks efficiently.</p>',
            'features_ar' => ["إدارة علاقات العملاء CRM", "الفواتير وعروض الأسعار", "إدارة المشتريات", "إدارة المهام", "التقارير المالية"],
            'features_en' => ["CRM", "Invoicing and Quotations", "Purchases Management", "Task Management", "Financial Reports"],
            'icon' => 'business',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Product::create([
            'title_ar' => 'نظام إدارة المخزون والمبيعات',
            'title_en' => 'Inventory and Sales Management System',
            'slug_ar' => 'inventory-sales-management-system',
            'slug_en' => 'inventory-sales-management-system-en',
            'short_description_ar' => 'حل عملي لمتابعة المنتجات، المخزون، المشتريات، المبيعات، وحركة الأصناف بدقة.',
            'short_description_en' => 'A practical solution for tracking products, inventory, purchases, sales, and stock movement accurately.',
            'description_ar' => '<p>تحكم كامل في حركات المخزون والمبيعات لضمان توفر المنتجات وتقليل الهدر.</p>',
            'description_en' => '<p>Full control over inventory and sales movements to ensure product availability and minimize waste.</p>',
            'features_ar' => ["تتبع المخزون", "إدارة الموردين", "نقاط البيع", "الجرد", "تقارير الأصناف"],
            'features_en' => ["Stock Tracking", "Supplier Management", "POS", "Stocktaking", "Item Reports"],
            'icon' => 'inventory_2',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        Product::create([
            'title_ar' => 'حلول برمجية مخصصة',
            'title_en' => 'Custom Software Solutions',
            'slug_ar' => 'custom-software-solutions',
            'slug_en' => 'custom-software-solutions-en',
            'short_description_ar' => 'نصمم ونطور أنظمة مخصصة حسب طبيعة عملك، بداية من تحليل الاحتياج وحتى التشغيل والدعم.',
            'short_description_en' => 'We design and develop custom systems based on your business needs, from requirements analysis to deployment and support.',
            'description_ar' => '<p>نحول أفكارك إلى حلول برمجية مخصصة تلبي احتياجاتك الفريدة.</p>',
            'description_en' => '<p>We turn your ideas into custom software solutions that meet your unique needs.</p>',
            'icon' => 'code',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        Product::create([
            'title_ar' => 'بوابات إلكترونية ولوحات تحكم',
            'title_en' => 'Web Portals and Dashboards',
            'slug_ar' => 'web-portals-dashboards',
            'slug_en' => 'web-portals-dashboards-en',
            'short_description_ar' => 'نطور بوابات إلكترونية ولوحات تحكم احترافية تساعدك على إدارة البيانات والعمليات واتخاذ القرار.',
            'short_description_en' => 'We build professional web portals and dashboards that help you manage data, operations, and decisions.',
            'description_ar' => '<p>احصل على بوابات إلكترونية ذكية ولوحات تحكم تمنحك السيطرة الكاملة على عملياتك.</p>',
            'description_en' => '<p>Get smart web portals and dashboards that give you full control over your operations.</p>',
            'icon' => 'dashboard',
            'sort_order' => 5,
            'is_active' => true,
        ]);
    }
}
