<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeProcedure extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sort_order',
    ];
}
