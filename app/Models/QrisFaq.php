<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrisFaq extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'body',
        'sort_order',
    ];
}

