<?php

namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Modules\Comment\Models\Comment;
use Modules\Course\Models\courses;
use Modules\Course\Models\lesson;
use Modules\Course\Models\Season;
use Modules\Media\Models\Media;
use Modules\Payment\Models\Payment;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Events\UserRegisterEvent;
use Modules\User\Notifications\VerifyMailNotification;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable , HasRoles , HasPermissions;

    const ACTIVE = 'active' ;
    const INACTIVE = 'inactive' ;
    const BAN = 'ban' ;

    public static $statuses = [
        self::ACTIVE ,
        self::INACTIVE,
        self::BAN,
    ];

    public static $defaultUsers = [
     [   'name' => 'maziar',
         'email' => 'maziardehghani1380@gmail.com',
         'password' => '75640213' ,
         'username' => 'مازیار دهقانی' ,
         'permissions' => [Permission::PERMISSION_SUPER_ADMIN],
         ]
    ];
    public function getThumbAttribute()
    {
        if ($this->image)
        {
            return '/storage/'.$this->image->files[300];
        }else
        {
            return '/panel/img/profile.jpg';
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendEmailVerificationNotification()
    {
        event(new UserRegisterEvent($this));
    }
    public function image()
    {
        return $this->belongsTo(Media::class , 'image_id');
    }
    public function season()
    {
        return $this->hasMany(Season::class );
    }
    public function purchases()
    {
        return $this->belongsToMany(courses::class , 'course_student' , 'user_id' , 'course_id');
    }
    public function lesson()
    {
        return $this->hasMany(lesson::class );
    }
    public function hasAccessToCourse($course)
    {
        if ($this->can('seeCourse' , courses::class) ||
        $this->id === $course->teacher_id ||
            $course->student->contains($this->id)
        ){
            return true;

        }

        return false;
    }
    public function studentCount()
    {
        return DB::table('courses')
            ->select('id')
            ->where('teacher_id' , $this->id)
            ->join('course_student' ,'courses.id', '=' , 'course_student.course_id')->count();

    }
    public function course()
    {
        return $this->hasMany(courses::class , 'teacher_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class , 'buyer_id');
    }
    public function comments()
    {
       return $this->hasMany(Comment::class , 'user_id');
    }
    public function routeNotificationForSms()
    {
        return $this->mobile; // where `phone` is a field in your users table;
    }

}
