<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'api_token', 'date_of_birth', 'gender', 'region_id'
    ];

    protected $appends = ['is_admin'];


    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function getRolesListAttribute()
    {
        return $this->roles()->pluck('id')->toArray();
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function getIsAdminAttribute($value)
    {
        return $this->hasRole('admin');
    }

    // public function notifications()
    // {
    //     return $this->hasMany('App\Models\Notification');
    // }
    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->orderBy('created_at', 'DESC');
    }
    public function notifications_header()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->orderBy('created_at', 'DESC')->limit(5);
    }
    public function notificationCount()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->where('read_at', null)->count();
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }
    // public function notificationCount()
    // {
    //     return  $this->hasMany('App\Models\Notification')->count();
    // }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
