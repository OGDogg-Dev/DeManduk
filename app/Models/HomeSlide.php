<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'description',
        'image_path',
        'cta_label',
        'cta_url',
        'sort_order',
    ];
}
