<?php

namespace Modules\Media\Services;

use Modules\Media\contracts\fileServiceContracts;
use Modules\Media\Models\Media;
use Illuminate\Http\UploadedFile;


class MediaFileService
{
    private static $file;
    private static $dir;
    private static $is_private;
    public static function uploadPublic(UploadedFile $file)
    {
        self::$dir = 'public/';
        self::$file = $file;
        self::$is_private = false;
        return self::upload();
    }
    public static function uploadPrivate(UploadedFile $file)
    {
        self::$dir = 'private/';
        self::$file = $file;
        self::$is_private = true;
        return self::upload();
    }
    private static function upload()
    {

        foreach (config('media.MediaTypeServices') as $key => $service)
        {
            if (in_array(self::normalizeExtension(self::$file) , $service['extension']))
            {
                return self::uploadByHandler($key, new $service['handler']);
            }

        }
        dd('false');
    }
    public static function delete(Media $media)
    {

        foreach (config('media.MediaTypeServices') as $type => $service)
        {
            if ($media->type == $type)
            {
               (new $service['handler'])->delete($media);
            }
        }
    }
    public static function Stream($media)
    {
        foreach (config('media.MediaTypeServices') as $type => $service)
        {
            if ($media->type == $type)
            {
               return $service['handler']::stream($media);
            }
        }
    }
    private static function normalizeExtension($file)
    {
        return strtolower($file->getClientOriginalExtension());
    }
    private static function generateFilename()
    {
        return uniqid();
    }
    private static function uploadByHandler($key, fileServiceContracts $service)
    {
            $media = new Media();
            $media->files = $service::upload(self::$file ,self::generateFilename() , self::normalizeExtension(self::$file) , self::$dir);
            $media->type = $key;
            $media->user_id = auth()->id();
            $media->is_private = self::$is_private;
            $media->filename = self::$file->getClientOriginalName();
            $media->save();
            return $media;
    }
}
