<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Discount\Model\Discount;
use Modules\User\Models\User;

class Payment extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $table = 'payments';
    const STATUS_PENDING = 'pending';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FAILED = 'failed';
    const STATUS_SUCCESS = 'success';


    public static $statuses = [
        self::STATUS_CANCELED,
        self::STATUS_PENDING,
        self::STATUS_FAILED,
        self::STATUS_SUCCESS
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function buyer()
    {
        return $this->belongsTo(User::class , 'buyer_id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class , 'seller_id');
    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class , 'discount_payment')->withTimestamps();
    }
}
