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

        $normalizedPath = ltrim($path, '/');

        if (Str::startsWith($normalizedPath, 'storage/')) {
            return asset($normalizedPath);
        }

        $lookupCandidates = collect([$normalizedPath])
            ->when(Str::startsWith($normalizedPath, 'resources/'), function ($paths) use ($normalizedPath) {
                return $paths->push(Str::after($normalizedPath, 'resources/'));
            })
            ->unique();

        foreach ($lookupCandidates as $candidate) {
            if (Storage::disk('public')->exists($candidate)) {
                return Storage::url($candidate);
            }

            $publicPath = public_path($candidate);

            if ($publicPath && file_exists($publicPath)) {
                return asset($candidate);
            }
        }

        return Vite::asset($normalizedPath);
    }
}
