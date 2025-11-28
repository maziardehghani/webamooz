<?php

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Models\lesson;
use Modules\Media\Services\MediaFileService;

class Media extends Model
{
    use HasFactory;



    const IMAGE_TYPE = 'image' ;
    const VIDEO_TYPE = 'video' ;
    const AUDIO_TYPE = 'audio' ;

    public static $types = [
        self::IMAGE_TYPE,
        self::AUDIO_TYPE,
        self::VIDEO_TYPE
    ];




    protected $casts = [
        'files' => 'json'
    ];

    protected static function booted()
    {
        static::deleting(function ($media)
        {
            MediaFileService::delete($media);
        });
    }
    public function getThumbAttribute()
    {
        return '/storage/'.$this->files[300];
    }
    public function getOriginalAttribute()
    {
        return '/storage/'.$this->files['original'];
    }
    public static function getExtensions()
    {
        $extensions = [];
        foreach (config('media.MediaTypeServices') as $service)
        {
            foreach ($service['extension'] as $extension)
            {
                $extensions[] =$extension;
            }
        }
        return implode(',' , $extensions);

    }
    public function lesson()
    {
        $this->hasOne(lesson::class , 'media_id');
    }
}
