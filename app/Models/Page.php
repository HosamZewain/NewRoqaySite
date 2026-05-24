<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
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
        'content_ar',
        'content_en',
        'featured_image',
        'seo_title_ar',
        'seo_title_en',
        'seo_description_ar',
        'seo_description_en',
        'seo_keywords_ar',
        'seo_keywords_en',
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
     * Scope a query to only include active pages.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // ──────────────────────────────────────────────
    // Route Model Binding
    // ──────────────────────────────────────────────

    /**
     * Get the route key for the model (locale-aware slug).
     */
    public function getRouteKeyName(): string
    {
        return 'slug_' . app()->getLocale();
    }
}
