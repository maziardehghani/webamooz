<?php

namespace Modules\Course\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\Category;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\Media\Models\Media;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use Carbon\Carbon;

class courses extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $table = 'courses';

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_CASH,self::TYPE_FREE];


    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCK = 'locked';

    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED , self::STATUS_LOCK ];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING , self::CONFIRMATION_STATUS_REJECTED ];


    public function banner()
    {
        return $this->belongsTo(Media::class , 'banner_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class , 'teacher_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
    public function season()
    {
        return $this->hasMany(Season::class , 'course_id');
    }
    public function lesson()
    {
        return $this->hasMany(lesson::class , 'lesson_id');
    }
    public function timeDuration()
    {
        return (new CourseRepository())->getDuration($this->id);

    }
    public function formattedTime()
    {
        $time = $this->timeDuration();
        return CarbonInterval::minutes($time)->cascade()->forHumans();
    }
    public function formattedPrice()
    {
        return number_format($this->price);
    }
    public function path()
    {
        return route('course.show' , $this->id . '-' . $this->slug) ;
    }
    public function lessonsCount()
    {
        return (new LessonRepository())->lessonCount($this->id);
    }
    public function shortUrl()
    {
        return route('course.show' , $this->id);
    }
}


