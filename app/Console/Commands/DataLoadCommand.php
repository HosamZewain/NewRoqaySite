<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Loads JSON dumps written by `data:dump` into the current DB.
 * Truncates each target table first, then inserts with explicit primary keys
 * so foreign-key relationships from the dump remain intact.
 *
 * Refuses to run without --force (this is destructive on content tables).
 *
 * Does NOT touch users / leads / cache / sessions / jobs.
 */
class DataLoadCommand extends Command
{
    protected $signature = 'data:load {--force : Skip the confirmation prompt}';
    protected $description = 'Load CMS content from database/dumps/*.json into the current DB (destructive)';

    /** Truncate in reverse FK order; insert in forward order. */
    private array $tables = [
        'site_settings',
        'menu_items',
        'homepage_sections',
        'pages',
        'services',
        'blog_posts',
        'testimonials',
        'products',     // before faqs
        'faqs',
    ];

    public function handle(): int
    {
        if (! $this->option('force')) {
            if (! $this->confirm('This will REPLACE all CMS content tables in the current DB. Continue?')) {
                $this->warn('Aborted.');
                return self::SUCCESS;
            }
        }

        $dir = database_path('dumps');
        if (! is_dir($dir)) {
            $this->error("No dumps directory at {$dir}");
            return self::FAILURE;
        }

        Schema::disableForeignKeyConstraints();

        try {
            // Truncate children first
            foreach (array_reverse($this->tables) as $table) {
                if (Schema::hasTable($table)) {
                    DB::table($table)->truncate();
                }
            }

            // Then load in forward order
            foreach ($this->tables as $table) {
                $path = "{$dir}/{$table}.json";
                if (! file_exists($path)) {
                    $this->warn(sprintf('  %-22s skipped (no dump file)', $table));
                    continue;
                }

                $rows = json_decode(file_get_contents($path), true);
                if (! is_array($rows)) {
                    $this->warn(sprintf('  %-22s skipped (invalid JSON)', $table));
                    continue;
                }

                // Re-encode any nested arrays back to JSON strings for DB storage
                foreach ($rows as &$row) {
                    foreach ($row as $col => $val) {
                        if (is_array($val)) {
                            $row[$col] = json_encode($val, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        }
                    }
                }
                unset($row);

                if (! empty($rows)) {
                    foreach (array_chunk($rows, 100) as $chunk) {
                        DB::table($table)->insert($chunk);
                    }
                }

                $this->info(sprintf('  %-22s %d rows loaded', $table, count($rows)));
            }
        } finally {
            Schema::enableForeignKeyConstraints();
        }

        // On MySQL, reset AUTO_INCREMENT so the next insert continues past the loaded IDs.
        if (DB::connection()->getDriverName() === 'mysql') {
            foreach ($this->tables as $table) {
                if (! Schema::hasTable($table)) {
                    continue;
                }
                $max = DB::table($table)->max('id');
                if ($max) {
                    DB::statement("ALTER TABLE `{$table}` AUTO_INCREMENT = " . ($max + 1));
                }
            }
        }

        $this->newLine();
        $this->info('Load complete. Recommended next step:');
        $this->line('  php artisan cache:clear && php artisan view:clear');

        return self::SUCCESS;
    }
}
