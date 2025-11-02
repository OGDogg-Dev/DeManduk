<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'sort_order',
    ];
}
