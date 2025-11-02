<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePricingRow extends Model
{
    protected $fillable = [
        'category',
        'label',
        'price',
        'description',
        'sort_order',
    ];
}
