<?php

namespace App\Models;

use App\Traits\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasBilingualFields;

    /**
     * Fields that support bilingual resolution via the trait.
     *
     * @var array<int, string>
     */
    protected array $bilingualFields = [
        'label_ar',
        'url_ar',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label_ar',
        'label_en',
        'url_ar',
        'url_en',
        'location',
        'parent_id',
        'open_in_new_tab',
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
            'open_in_new_tab' => 'boolean',
        ];
    }

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope a query to only include active menu items.
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

    /**
     * Scope a query to only include header menu items.
     */
    public function scopeHeader(Builder $query): Builder
    {
        return $query->where('location', 'header');
    }

    /**
     * Scope a query to only include footer menu items.
     */
    public function scopeFooter(Builder $query): Builder
    {
        return $query->where('location', 'footer');
    }
}
