<?php

namespace Modules\Media\Services;

use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\Media;

class defaultFileService
{
    public static $media;
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

    public static function stream($media)
    {
        self::$media = $media;


        $stream = Storage::readStream(self::getFilename());

    }
    public static function getFilename()
    {
        dd(self::$media->files['video']);

        return (self::$media->is_private ? 'private/' : 'public/ ').self::$media->files['video'];

    }
}
