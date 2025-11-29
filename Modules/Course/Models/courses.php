<?php

namespace Modules\Course\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\Category;
use Modules\Comment\Models\Comment;
use Modules\Comment\Traits\HasComment;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\Discount\Model\Discount;
use Modules\Discount\Repository\DiscountRepository;
use Modules\Media\Models\Media;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;

class courses extends Model
{
    use HasFactory , HasComment;


    protected $perPage = 20;
    protected $guarded = [];
    protected $table = 'courses';

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_CASH, self::TYPE_FREE];


    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCK = 'locked';

    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCK];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];


    static $code;

    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }
    public function getThumbAttribute()
    {
        return '/storage/'.$this->banner->files[300];
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function season()
    {
        return $this->hasMany(Season::class, 'course_id');
    }
    public function lesson()
    {
        return $this->hasMany(lesson::class, 'lesson_id');
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
    public function path()
    {
        return route('courses.show', $this->id . '-' . $this->slug);
    }
    public function student()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id');
    }
    public function lessonsCount()
    {
        return (new LessonRepository())->lessonCount($this->id);
    }
    public function shortUrl()
    {
        return route('courses.show', $this->id);
    }
    public function hasStudent($user)
    {
        return (new CourseRepository())->hasStudent($this, $user);
    }
    public function checkCode($code)
    {
        self::$code = $code;

        if (!is_null($this->special_discount()))
            return $this->special_discount();

        return false;
    }
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function discounts()
    {
        return $this->morphOne(Discount::class, 'discountable');
    }
    public function getPrice()
    {
        return $this->price;
    }

    public function FinalPrice()
    {
        return $this->getPrice() - $this->discountAmount();
    }

    public function discountPercent()
    {
        if ($this->special_discount()) {
            return $this->special_discount()->percent;

        } elseif ($this->global_discount()) {
            return $this->global_discount()->percent;
        } else
            return 0;
    }

    public function discountAmount()
    {
        return ($this->discountPercent() / 100) * $this->getPrice();
    }

    private function checkCourseHasDiscount()
    {
        return $this->discounts ? true : false;
    }

    public function global_discount()
    {
        if ($this->checkCourseHasDiscount()) {
            if (is_null($this->discounts->code)) {
                return (new DiscountRepository())->getGlobalDiscount($this->id);
            }
            return false;
        }
        return false;
    }
    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
    public function special_discount()
    {
        if ($this->checkCourseHasDiscount()) {
            if (!is_null($this->discounts->code)) {
                return (new DiscountRepository())->getSpecialDiscount($this->id, self::$code);
            }
            return false;
        }
        return false;
    }
}


