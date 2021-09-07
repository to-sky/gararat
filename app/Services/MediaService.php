<?php

namespace App\Services;

class MediaService
{
    const BLANK_IMAGE_PATH = '/images/blank.png';
    const WATERMARK_PATH = '/images/watermark.png';

    /**
     * Store and update media
     *
     * @param $model | Instance on model
     * @param $inputNames | string|array | Name(s) from form input fields
    *         String for single image, array for multiple images
     * @return bool|null |null $model
     */
    public static function store($model, $inputNames)
    {
        if (! $inputNames) return null;

        is_array($inputNames)
            ? self::storeMultiple($model, $inputNames)
            : self::storeSingle($model, $inputNames);

        return true;
    }

    /**
     * Store single media
     *
     * @param $model
     * @param $name
     * @return bool|null
     */
    protected static function storeSingle($model, $name)
    {
        if (! $name) return null;

        if (request()->hasFile($name)) {
            $model->addMediaFromRequest($name)
                ->toMediaCollection($name);
        }

        return true;
    }

    /**
     * Store multiple media
     *
     * @param $model
     * @param $names
     * @return bool|null
     */
    protected static function storeMultiple($model, $names)
    {
        if (! is_array($names)) return null;

        foreach ($names as $name) {
            if (request()->hasFile($name)) {
                $model->addMultipleMediaFromRequest([$name])
                    ->each->toMediaCollection($name);
            }
        }

        return true;
    }

    /**
     * Destroy media
     *
     * @param $model
     * @param array $collections
     * @return bool
     */
    public static function destroy($model, array $collections)
    {
        foreach($collections as $collection) {
            $model->clearMediaCollection($collection);
        }

        return true;
    }
}
