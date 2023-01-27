<?php

namespace Modules\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Models\Media;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'slider';

    const STATIC_BANNER ='static';
    const DYNAMIC_BANNER ='dynamic';

    public static $types =
        [
          self::STATIC_BANNER,
          self::DYNAMIC_BANNER
        ];

    public function banner()
    {
        return $this->belongsTo(Media::class , 'banner_id');
    }
}
