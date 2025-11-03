<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class GalleryItem extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'title',
        'caption',
        'image_path',
        'status',
        'sort_order',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function markPublished(): void
    {
        $this->status = self::STATUS_PUBLISHED;
        $this->published_at = Carbon::now();
    }

    public function markDraft(): void
    {
        $this->status = self::STATUS_DRAFT;
        $this->published_at = null;
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', self::STATUS_PUBLISHED)
            ->whereNotNull('published_at');
    }
}

