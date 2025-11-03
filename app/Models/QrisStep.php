<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrisStep extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sort_order',
    ];
}

