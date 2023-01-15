<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Sattlement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'sattlement';
    const STATUS_PENDING = 'pending' ;
    const STATUS_SETTLED = 'settled';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELED = 'cancelled';

    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_SETTLED,
        self::STATUS_REJECTED,
        self::STATUS_CANCELED
        ];

    protected $casts = [
            'to' => 'json',
            'from' => 'json',
        ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
