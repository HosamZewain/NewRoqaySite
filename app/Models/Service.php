<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasBilingualFields;

    /**
     * Fields that support bilingual resolution via the trait.
     *
     * @var array<int, string>
     */
    protected array $bilingualFields = [
        'title_ar',
        'slug_ar',
        'short_description_ar',
        'content_ar',
        'seo_title_ar',
        'seo_description_ar',
        'seo_keywords_ar',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title_ar',
        'title_en',
        'slug_ar',
        'slug_en',
        'short_description_ar',
        'short_description_en',
        'content_ar',
        'content_en',
        'icon',
        'featured_image',
        'seo_title_ar',
        'seo_title_en',
        'seo_description_ar',
        'seo_description_en',
        'seo_keywords_ar',
        'seo_keywords_en',
        'sort_order',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort_order ascending.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}
