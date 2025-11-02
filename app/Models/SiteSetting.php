<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    protected static function booted(): void
    {
        static::saved(function (self $setting): void {
            Cache::forget(self::cacheKey($setting->key));
        });

        static::deleted(function (self $setting): void {
            Cache::forget(self::cacheKey($setting->key));
        });
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever(self::cacheKey($key), function () use ($key, $default) {
            $value = self::query()->where('key', $key)->value('value');

            return $value !== null ? $value : $default;
        });
    }

    public static function setValue(string $key, mixed $value): void
    {
        self::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    protected static function cacheKey(string $key): string
    {
        return "site_setting:{$key}";
    }
}
