<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Season extends Model
{
    use HasFactory;


    protected $guarded = [];



    protected $table = 'seasons';



    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING , self::CONFIRMATION_STATUS_REJECTED ];





    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function course()
    {
        return $this->belongsTo(courses::class , 'course_id');
    }
}
