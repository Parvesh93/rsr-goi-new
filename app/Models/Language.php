<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Language extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'direction', 'default', 'status',
    ];

    // Static in-memory cache (per request)
    protected static $cachedVersion = [];

    public static function version()
    {
        $locale = Session::get('locale', 'default');

        // Return from static memory if already loaded in this request
        if (isset(self::$cachedVersion[$locale])) {
            return self::$cachedVersion[$locale];
        }

        // Try retrieving from persistent cache
        $result = Cache::get('active_language_' . $locale);

        // If not cached, fallback to default mock object (NO QUERY)
        if (!$result) {
            // ❌ DO NOT run query here. Just return null or default stub
            $result = (object)[
                'id' => 1, // fallback ID (safe dummy)
                'code' => 'en',
                'name' => 'English',
                'status' => 1,
                'default' => 1,
                'direction' => 'ltr',
            ];

            // Save fallback (or skip if not appropriate for your use case)
            Cache::forever('active_language_' . $locale, $result);
        }

        // Store in static memory
        self::$cachedVersion[$locale] = $result;

        return $result;
    }
}
