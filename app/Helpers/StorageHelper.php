<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Get storage URL with proper handling for Docker environment
     *
     * @param string $path
     * @return string
     */
    public static function getStorageUrl($path)
    {
        // Check if running in Docker environment
        if (env('APP_ENV') === 'docker' || env('LARAVEL_SAIL')) {
            return env('APP_URL') . '/storage/' . $path;
        }

        // Default Laravel storage URL
        return asset('storage/' . $path);
    }

    /**
     * Get image URL for barang (items)
     *
     * @param string|null $filename
     * @return string
     */
    public static function getBarangImageUrl($filename)
    {
        if (!$filename) {
            return null;
        }

        return self::getStorageUrl('barang/' . $filename);
    }
}
