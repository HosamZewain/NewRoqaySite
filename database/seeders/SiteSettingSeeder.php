<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name_ar', 'value' => 'رقي', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_name_en', 'value' => 'RoQay', 'group' => 'general', 'type' => 'text'],
            
            // Contact
            ['key' => 'phone', 'value' => '+966500000000', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'whatsapp', 'value' => '+966500000000', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'email', 'value' => 'info@roqay.com', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'address_ar', 'value' => 'المملكة العربية السعودية', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'address_en', 'value' => 'Saudi Arabia', 'group' => 'contact', 'type' => 'text'],
            
            // Social
            ['key' => 'facebook', 'value' => 'https://facebook.com/roqay', 'group' => 'social', 'type' => 'text'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/roqay', 'group' => 'social', 'type' => 'text'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/roqay', 'group' => 'social', 'type' => 'text'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/roqay', 'group' => 'social', 'type' => 'text'],
            
            // SEO
            ['key' => 'default_seo_title_ar', 'value' => 'رقي - أنظمة برمجية أذكى لنمو أسرع', 'group' => 'seo', 'type' => 'text'],
            ['key' => 'default_seo_title_en', 'value' => 'RoQay - Smarter Software for Faster Growth', 'group' => 'seo', 'type' => 'text'],
            ['key' => 'default_seo_description_ar', 'value' => 'رقي شركة برمجيات متخصصة في تطوير وبيع وتنفيذ الأنظمة البرمجية وحلول الأعمال', 'group' => 'seo', 'type' => 'textarea'],
            ['key' => 'default_seo_description_en', 'value' => 'RoQay is a software company specializing in developing, selling, and implementing software systems and business solutions', 'group' => 'seo', 'type' => 'textarea'],
            ['key' => 'default_seo_keywords_ar', 'value' => 'رقي، برمجيات، أنظمة إدارة، نظام مطاعم، حلول برمجية', 'group' => 'seo', 'type' => 'text'],
            ['key' => 'default_seo_keywords_en', 'value' => 'RoQay, software, management systems, restaurant system, software solutions', 'group' => 'seo', 'type' => 'text'],
            
            // Footer
            ['key' => 'copyright_ar', 'value' => '© 2024 رقي. جميع الحقوق محفوظة.', 'group' => 'footer', 'type' => 'text'],
            ['key' => 'copyright_en', 'value' => '© 2024 RoQay. All rights reserved.', 'group' => 'footer', 'type' => 'text'],
            ['key' => 'footer_text_ar', 'value' => 'رقي - شريكك التقني لبناء أنظمة عملية', 'group' => 'footer', 'type' => 'text'],
            ['key' => 'footer_text_en', 'value' => 'RoQay - Your technology partner for practical systems', 'group' => 'footer', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
