<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Runner extends Authenticatable
{
// use SoftDeletes;


    protected $table = 'runners';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'address', 'password', 'region_id', 'api_token', 'code','photo','created_at','updated_at','deleted_at');
    protected $appends = ['photo_url'];



    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('state','photo');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'accountable');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }
    public function getPhotoUrlAttribute($value)
    {

       return !empty($this->photo)? url($this->photo):url('uploads/user.png');

        // return url($this->photo);
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\RunnerReview','runner_id','id');
    }
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token', 'code'
    ];

}