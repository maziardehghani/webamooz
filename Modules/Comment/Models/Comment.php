<?php

namespace Modules\Comment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'comment';


    const STATUS_NEW = 'new' ;
    const STATUS_ACCEPTED = 'accepted' ;
    const STATUS_REJECTED = 'rejected';

    public static $statuses =
        [
            self::STATUS_NEW,
            self::STATUS_ACCEPTED,
            self::STATUS_REJECTED,
        ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
       return $this->belongsTo(User::class , 'user_id');
    }
    public function answers()
    {
        return $this->hasMany(Comment::class , 'comment_id')
            ->orderByDesc('id');
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class , 'comment_id');
    }


}
