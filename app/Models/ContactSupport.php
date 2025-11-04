<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSupport extends Model
{
    protected $fillable = [
        'title',
        'description',
        'phone',
        'sort_order',
    ];
}

