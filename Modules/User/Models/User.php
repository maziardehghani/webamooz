<?php

namespace Modules\User\Models;

use Modules\Course\Models\lesson;
use Modules\Course\Models\Season;
use Modules\Media\Models\Media;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\RolePermissions\Models\Permission;
use Modules\RolePermissions\Models\Role;
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
        $this->notify(new VerifyMailNotification());
    }
    public function image()
    {
        return $this->belongsTo(Media::class , 'image_id');
    }
//    public function profilePath()
//    {
//        return $this->username ? route('dashboard.users.profile');
//    }
    public function season()
    {
        $this->hasMany(Season::class );
    }
    public function lesson()
    {
        $this->hasMany(lesson::class );
    }
    public function hasAccessToCourse()
    {
        return false;
    }

}
