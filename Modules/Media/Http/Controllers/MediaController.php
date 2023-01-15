<?php

namespace Modules\Media\Http\Controllers;

use App\Models\Media;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Media\Services\MediaFileService;

class MediaController extends Controller
{
    public function download(Request $request , Media $media)
    {
        if (!$request->hasValidSignature()){
            abort(401);
        }
        return MediaFileService::Stream($media);
    }
}
