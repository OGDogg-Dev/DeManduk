<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'file_size' => 'integer',
    ];

    public function getDownloadUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    public function getPublicUrlAttribute(): string
    {
        return route('sop.pdf.viewer', $this);
    }
}