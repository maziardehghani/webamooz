<?php

namespace Modules\Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Media\contracts\fileServiceContracts;

class videoFileServices extends defaultFileService implements fileServiceContracts
{
    public static function upload(UploadedFile $file , $filename , $extension , $dir) : array
    {

        Storage::PutFileAs($dir , $file , $filename.'.'. $extension);

        return ['video' => $filename.'.' .$extension];
    }



}
