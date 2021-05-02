<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'address', 'password', 'region_id', 'home_phone', 'api_token', 
    'code', 'photo', 'lat', 'lang','verified','provider','provider_id','provider_token');
    protected $appends = ['photo_url','register_state'];
    

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function additionalMerchant()
    {
        return $this->hasMany('App\Models\AdditionalMerchant');
    }

    public function spacialItem ()
    {
        return $this->hasMany('App\Models\SpacialItem');
    }
    
    public function cart ()
    {
        return $this->belongsToMany('App\Models\Item', 'carts')->withPivot('price', 'quantity', 'note', 'id')->withTimestamps();
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'accountable');
    }

    public function getPhotoUrlAttribute($value)
    {
        return !empty($this->photo) ? url($this->photo) : url('uploads/user.png');
    }
    public function getRegisterStateAttribute($value)
    {
        if($this->provider !=null)
        return "social";
        elseif($this->provider ==null && $this->email==null && $this->phone!=null)
        return "phone";
        else return "normal";
    }
   
    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->orderBy('created_at', 'DESC');
    }

    public function notificationCount()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->where('read_at', null)->count();
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
