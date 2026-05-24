<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Cache key prefix for site settings.
     */
    private const CACHE_PREFIX = 'site_setting_';

    /**
     * Cache TTL in seconds (1 hour).
     */
    private const CACHE_TTL = 3600;

    // ──────────────────────────────────────────────
    // Static Helpers
    // ──────────────────────────────────────────────

    /**
     * Retrieve a setting value by key with caching.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember(
            self::CACHE_PREFIX . $key,
            self::CACHE_TTL,
            function () use ($key, $default) {
                $setting = static::where('key', $key)->first();

                return $setting?->value ?? $default;
            }
        );
    }

    /**
     * Set a setting value by key (creates or updates).
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(self::CACHE_PREFIX . $key);
    }

    /**
     * Get all settings within a group.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public static function getGroup(string $group): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('group', $group)->get();
    }
}
