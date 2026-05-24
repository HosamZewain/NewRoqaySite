<?php

namespace App\Console\Commands;

use App\Models\HomepageSection;
use Illuminate\Console\Command;

/**
 * Idempotently ensures every visibility-toggle homepage_sections row
 * the public view expects actually exists in the database.
 *
 * Safe to run on any environment — uses updateOrCreate keyed by section_key,
 * so it never duplicates and never overwrites existing content.
 */
class SyncHomepageSectionsCommand extends Command
{
    protected $signature = 'sections:sync';
    protected $description = 'Backfill any missing homepage_sections placeholder rows (trust_strip, industries, final_cta, etc.)';

    public function handle(): int
    {
        $sections = [
            'trust_strip'      => 'Industry trust strip (marquee)',
            'industries'       => 'Industries grid',
            'products_preview' => 'Products preview',
            'testimonials'     => 'Testimonials carousel',
            'blog_preview'     => 'Latest blog posts',
            'faq'              => 'FAQ accordion',
            'final_cta'        => 'Final call-to-action',
        ];

        $created = 0;
        foreach ($sections as $key => $label) {
            $row = HomepageSection::firstOrCreate(
                ['section_key' => $key],
                [
                    'title_ar'   => $label,
                    'title_en'   => $label,
                    'is_active'  => true,
                    'sort_order' => 99,
                ]
            );
            if ($row->wasRecentlyCreated) {
                $this->info("  + created '{$key}'");
                $created++;
            } else {
                $this->line("  · '{$key}' already exists (active=" . ($row->is_active ? 'yes' : 'no') . ')');
            }
        }

        $this->newLine();
        $this->info($created === 0
            ? 'All placeholder sections already present.'
            : "Created {$created} missing section(s).");

        return self::SUCCESS;
    }
}
