<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactAlert extends Model
{
    protected $fillable = [
        'variant',
        'title',
        'body',
        'sort_order',
    ];
}

