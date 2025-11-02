<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;

class Media
{
    public static function url(?string $path, ?string $fallback = null): ?string
    {
        if (! $path) {
            return $fallback;
        }

        if (Str::startsWith($path, ['http://', 'https://', 'data:'])) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        return Vite::asset($path);
    }
}
