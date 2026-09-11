<?php

namespace App\Providers;

use Awcodes\Curator\Concerns\UrlProvider;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Storage;

class CloudinaryUrlProvider implements UrlProvider
{
    protected static array $diskCache = [];

    protected static function resolve(string $path): string
    {
        if (! isset(static::$diskCache[$path])) {
            $disk = Media::where('path', $path)->value('disk');
            static::$diskCache[$path] = $disk ?: (Storage::disk('public')->exists($path) ? 'public' : 'cloudinary');
        }

        $disk = static::$diskCache[$path];

        try {
            return Storage::disk($disk)->url($path);
        } catch (\Throwable) {
            return Storage::disk('public')->url($path);
        }
    }

    public static function getThumbnailUrl(string $path): string
    {
        return static::resolve($path);
    }

    public static function getMediumUrl(string $path): string
    {
        return static::resolve($path);
    }

    public static function getLargeUrl(string $path): string
    {
        return static::resolve($path);
    }
}

