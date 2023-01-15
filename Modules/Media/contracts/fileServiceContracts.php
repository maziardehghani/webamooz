<?php

namespace Modules\Media\contracts;

use Illuminate\Http\UploadedFile;
use Modules\Media\Models\Media;

interface fileServiceContracts
{
    public static function upload(UploadedFile $file , string $filename , string $extension ,  string $dir) : array;

    public static function delete(Media $media);


    public static function stream(Media $media);
}
