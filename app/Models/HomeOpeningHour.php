<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeOpeningHour extends Model
{
    protected $fillable = [
        'label',
        'hours',
        'note',
        'sort_order',
    ];
}
