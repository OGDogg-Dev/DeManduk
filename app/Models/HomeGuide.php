<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeGuide extends Model
{
    protected $fillable = [
        'title',
        'items',
        'sort_order',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
