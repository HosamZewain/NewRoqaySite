<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Header
            ['label_ar' => 'الرئيسية', 'label_en' => 'Home', 'url_ar' => '/', 'url_en' => '/en', 'location' => 'header', 'sort_order' => 1],
            ['label_ar' => 'المنتجات', 'label_en' => 'Products', 'url_ar' => '/products', 'url_en' => '/en/products', 'location' => 'header', 'sort_order' => 2],
            ['label_ar' => 'الخدمات', 'label_en' => 'Services', 'url_ar' => '/services', 'url_en' => '/en/services', 'location' => 'header', 'sort_order' => 3],
            ['label_ar' => 'من نحن', 'label_en' => 'About Us', 'url_ar' => '/about', 'url_en' => '/en/about', 'location' => 'header', 'sort_order' => 4],
            ['label_ar' => 'المدونة', 'label_en' => 'Blog', 'url_ar' => '/blog', 'url_en' => '/en/blog', 'location' => 'header', 'sort_order' => 5],
            ['label_ar' => 'تواصل معنا', 'label_en' => 'Contact', 'url_ar' => '/contact', 'url_en' => '/en/contact', 'location' => 'header', 'sort_order' => 6],
            
            // Footer
            ['label_ar' => 'من نحن', 'label_en' => 'About Us', 'url_ar' => '/about', 'url_en' => '/en/about', 'location' => 'footer', 'sort_order' => 1],
            ['label_ar' => 'تواصل معنا', 'label_en' => 'Contact', 'url_ar' => '/contact', 'url_en' => '/en/contact', 'location' => 'footer', 'sort_order' => 2],
            ['label_ar' => 'المدونة', 'label_en' => 'Blog', 'url_ar' => '/blog', 'url_en' => '/en/blog', 'location' => 'footer', 'sort_order' => 3],
        ];

        foreach ($items as $item) {
            $item['is_active'] = true;
            MenuItem::create($item);
        }
    }
}
