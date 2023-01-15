<?php

namespace Modules\Discount\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discount';

    protected $guarded = [];



    const TYPE_ALL = 'all';
    const TYPE_SPECIAL = 'special';

    public static $types = [
      self::TYPE_ALL,
      self::TYPE_SPECIAL
    ];

    public function discountable()
    {
        return $this->morphTo();
    }
}
