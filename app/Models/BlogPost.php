<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasBilingualFields;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * Fields that support bilingual resolution via the trait.
     *
     * @var array<int, string>
     */
    protected array $bilingualFields = [
        'title_ar',
        'slug_ar',
        'excerpt_ar',
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
        'excerpt_ar',
        'excerpt_en',
        'content_ar',
        'content_en',
        'featured_image',
        'og_image',
        'author_name',
        'category',
        'status',
        'published_at',
        'seo_title_ar',
        'seo_title_en',
        'seo_description_ar',
        'seo_description_en',
        'seo_keywords_ar',
        'seo_keywords_en',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
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
