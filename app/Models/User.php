<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable =
    [
         'title',
         'name',
         'email',
         'status',
         'password'
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends = [
        'profile_photo_url',
    ];

    public function departments(){
        return $this->belongsTo(Department::class,'department_id')->withDefault();
    }

    public function positions(){
        return $this->belongsTo(Position::class,'position_id')->withDefault();
    }
    // public function roles(){
    //     return $this->belongsTo(Role::class,'roles')->withDefault();
    // }
    public function user_categories()
    {
        return $this->hasMany(UserCategory::class,'user_id','id');
    }

    public function user_branches()
    {
        return $this->hasMany(UserBranch::class,'user_id','id');
    }
    public function from_branches()
    {
        return $this->belongsTo(Branch::class,'from_branch_id')->withDefault();
    }
}
