<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Dumps the content tables of the local DB to versioned JSON files
 * under database/dumps/. Designed to be committed and replayed on the
 * production DB via `php artisan data:load --force`.
 *
 * Does NOT touch:
 *   - leads      (real form submissions live there)
 *   - users      (admin password / accounts should stay independent)
 *   - cache, sessions, jobs, failed_jobs, password_reset_tokens
 *
 * Preserves: primary keys, JSON columns, timestamps.
 */
class DataDumpCommand extends Command
{
    protected $signature = 'data:dump';
    protected $description = 'Dump CMS content tables to database/dumps/*.json';

    /** Tables to export, in load-safe order (parents before children). */
    private array $tables = [
        'site_settings',
        'menu_items',
        'homepage_sections',
        'pages',
        'services',
        'blog_posts',
        'testimonials',
        'products',     // FAQs reference this
        'faqs',
    ];

    /** Columns that hold JSON. Decoded on dump so the file is human-readable. */
    private array $jsonColumns = [
        'homepage_sections' => ['extra_data'],
        'products' => [
            'features_ar', 'features_en',
            'benefits_ar', 'benefits_en',
            'modules_ar', 'modules_en',
            'gallery_images',
            'screenshots',
            'pricing',
            'implementation_steps_ar', 'implementation_steps_en',
        ],
    ];

    public function handle(): int
    {
        $dir = database_path('dumps');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($this->tables as $table) {
            $rows = DB::table($table)->orderBy('id')->get()
                ->map(fn ($row) => (array) $row)
                ->all();

            // Decode JSON columns from string → array for readability
            $jsonCols = $this->jsonColumns[$table] ?? [];
            foreach ($rows as &$row) {
                foreach ($jsonCols as $col) {
                    if (isset($row[$col]) && is_string($row[$col])) {
                        $decoded = json_decode($row[$col], true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $row[$col] = $decoded;
                        }
                    }
                }
            }
            unset($row);

            $path = "{$dir}/{$table}.json";
            file_put_contents(
                $path,
                json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n"
            );

            $this->info(sprintf('  %-22s %d rows → %s', $table, count($rows), 'database/dumps/' . $table . '.json'));
        }

        $this->newLine();
        $this->info('Dump complete. Review the JSON, then:');
        $this->line('  git add database/dumps && git commit -m "Sync content" && git push');
        $this->line('  ssh ... cd ~/.../laravel && ./deploy.sh && php artisan data:load --force');

        return self::SUCCESS;
    }
}
