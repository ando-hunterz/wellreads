<?php

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class Canvas
{

    /**
     * Check that the public assets are published and up-to-date.
     *
     * @return bool
     */
    public static function assetsUpToDate(): bool
    {
        $path = public_path('vendor/canvas/mix-manifest.json');

        if (! File::exists($path)) {
            throw new RuntimeException(__('canvas::app.assets_are_not_up_to_date').__('canvas::app.to_update_run').' php artisan canvas:publish');
        }

        return File::get($path) === File::get(__DIR__.'/../public/mix-manifest.json');
    }

    /**
     * Return the available locales.
     *
     * @return array
     */
    public static function getAvailableLanguageCodes()
    {
        $locales = preg_grep('/^([^.])/', scandir(dirname(__DIR__, 1).'/resources/lang'));
        $translations = collect();

        foreach ($locales as $locale) {
            $translations->put($locale, Str::upper($locale));
        }

        return $translations->toArray();
    }
}
