<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'cover_image',
        'excerpt',
        'body',
        'published_at',
    ];

    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $event): void {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
}
