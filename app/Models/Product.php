<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
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
        'description_ar',
        'seo_title_ar',
        'seo_description_ar',
        'seo_keywords_ar',
        'hero_headline_ar',
        'hero_subheadline_ar',
        'target_audience_ar',
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
        'description_ar',
        'description_en',
        'features_ar',
        'features_en',
        'benefits_ar',
        'benefits_en',
        'modules_ar',
        'modules_en',
        'icon',
        'featured_image',
        'gallery_images',
        'og_image',
        'seo_title_ar',
        'seo_title_en',
        'seo_description_ar',
        'seo_description_en',
        'seo_keywords_ar',
        'seo_keywords_en',
        'hero_headline_ar',
        'hero_headline_en',
        'hero_subheadline_ar',
        'hero_subheadline_en',
        'target_audience_ar',
        'target_audience_en',
        'implementation_steps_ar',
        'implementation_steps_en',
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
            'features_ar' => 'array',
            'features_en' => 'array',
            'benefits_ar' => 'array',
            'benefits_en' => 'array',
            'modules_ar' => 'array',
            'modules_en' => 'array',
            'gallery_images' => 'array',
            'implementation_steps_ar' => 'array',
            'implementation_steps_en' => 'array',
            'is_active' => 'boolean',
        ];
    }

    // ──────────────────────────────────────────────
    // Relationships
    // ──────────────────────────────────────────────

    /**
     * Get the FAQs associated with this product.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope a query to only include active products.
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
