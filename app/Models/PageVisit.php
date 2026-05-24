<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = [
        'page_key',
        'locale',
        'label',
        'url',
        'visit_count',
        'last_visited_at',
    ];

    protected function casts(): array
    {
        return [
            'visit_count'      => 'integer',
            'last_visited_at'  => 'datetime',
        ];
    }
}
