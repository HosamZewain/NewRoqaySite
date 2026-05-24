<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasBilingualFields;

    /**
     * Fields that support bilingual resolution via the trait.
     *
     * @var array<int, string>
     */
    protected array $bilingualFields = [
        'client_name_ar',
        'company_ar',
        'position_ar',
        'review_ar',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_name_ar',
        'client_name_en',
        'company_ar',
        'company_en',
        'position_ar',
        'position_en',
        'review_ar',
        'review_en',
        'client_photo',
        'rating',
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
            'rating' => 'integer',
        ];
    }

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope a query to only include active testimonials.
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
