<?php

namespace Modules\Discount\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Models\Payment;

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
    public function payments()
    {
        return $this->belongsToMany(Payment::class , 'discount_payment')->withTimestamps();
    }

}
