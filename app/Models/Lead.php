<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'business_type',
        'interested_product',
        'message',
        'source',
        'status',
        'admin_notes',
    ];

    // ──────────────────────────────────────────────
    // Scopes
    // ──────────────────────────────────────────────

    /**
     * Scope a query to only include new (unprocessed) leads.
     */
    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }
}
