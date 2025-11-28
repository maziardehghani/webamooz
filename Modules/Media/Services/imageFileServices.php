<?php

namespace Modules\Media\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Media\contracts\fileServiceContracts;

class imageFileServices extends defaultFileService implements fileServiceContracts
{
    protected static $sizes = ['300' , '600' , '700'];

    public static function upload($file , $filename , $extension , $dir) : array
    {

        Storage::putFileAs($dir , $file , $filename.'.'. $extension);
        $path = $dir . $filename . '.' . $extension;
        return self::resize(Storage::path($path) , $dir , $filename , $extension);
    }
    public static function getFilename()
    {
        return (static::$media->is_private ? 'private/' : 'public/') . static::$media->files['original'];
    }


    public static function thumb($media)
    {
        return "/storage/" . $media->files['300'];
    }

    private static function resize($img , $dir , $filename , $extension)
    {
        $image = Image::make($img);
        $imgs['original'] =$filename.'.'.$extension;

        foreach (self::$sizes as $size)
        {
            $imgs[$size] = $filename . '_' . $size . '.' .$extension;
            $image->resize($size , null , function ($aspect)
            {
                $aspect->aspectRatio();
            })->save(Storage::path($dir).$filename.'_'.$size. '.' . $extension);
        }
        return $imgs;

    }


}
