<?php

namespace Modules\Media\Services;

use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\Media;

abstract class defaultFileService
{
    public static $media;
    abstract public static function getFilename();

    public static function delete($media)
    {
        foreach ($media->files as $file)
        {
            if ($media->is_private)
            {
                Storage::delete('private\\' . $file);
            }else
            {
                Storage::delete('public\\' . $file);
            }
        }
    }

    public static function jsonDecoder($array)
    {
        return json_decode($array);
    }
    public static function stream($media)
    {
        self::$media = $media;
        $stream = Storage::readStream(static::getFilename());

        return response()->stream(function () use ($stream)
        {
            while (ob_get_level() > 0) ob_get_flush();
           fpassthru($stream);
        },
        200 ,
            [
                "Content-type" => Storage::mimeType(static::getFilename()),
                "Content-disposition" => "attachment; filename ='" . static::$media->filename . "'"
                ]
        );
    }
}
