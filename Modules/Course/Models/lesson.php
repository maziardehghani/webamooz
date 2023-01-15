<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Modules\Media\Models\Media;
use Modules\User\Models\User;

class lesson extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table = 'lessons';




    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCK = 'locked';

    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED , self::STATUS_LOCK ];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING , self::CONFIRMATION_STATUS_REJECTED ];


    public function season()
    {
        return $this->belongsTo(Season::class , 'season_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function course()
    {
        return $this->belongsTo(courses::class , 'course_id');
    }
    public function media()
    {
        return $this->belongsTo(Media::class , 'media_id');
    }
    public function path()
    {
        return $this->course->path().'?lesson=Eps-'.$this->number.'-'.$this->slug;
    }
    public function is_free()
    {
        return $this->free ? 'رایگان' : '';
    }
    public function downloadLink()
    {
        if ($this->media_id)
        return URL::temporarySignedRoute('media.download' ,now()->addDay(), ['media' => $this->media_id]);
    }
}
