<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProductSeeder::class,
            IresSystemSeeder::class,
            ServiceSeeder::class,
            BlogPostSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            HomepageSectionSeeder::class,
            SiteSettingSeeder::class,
            PageSeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}
