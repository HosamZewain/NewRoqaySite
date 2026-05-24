<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title_ar' => 'من نحن',
            'title_en' => 'About Us',
            'slug_ar' => 'about',
            'slug_en' => 'about',
            'content_ar' => '<h2>عن رقي</h2><p>رقي هي شركة تقنية رائدة في مجال تطوير البرمجيات وأنظمة الإدارة.</p>',
            'content_en' => '<h2>About RoQay</h2><p>RoQay is a leading tech company in software development and management systems.</p>',
            'is_active' => true,
        ]);
    }
}
