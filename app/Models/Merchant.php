<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{

    protected $table = 'merchants';
    public $timestamps = true;

    protected $fillable = array(
        'region_id','type_id', 'name', 'email', 'password','lat','lang',
        'phone','whatsapp', 'photo','personal_photo', 'national_id_photo','availability', 'api_token','code','activated','address','selected'
    );
    protected $appends = ['photo_url','personal_url','has_items','national_id_url','rate','last_offer'];
   
    public function getHasItemsAttribute()
    {
      
        if (!empty($this->items()->get()->count())){
         
           return true;
        }
        
        else return false;
    }
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','category_merchant','merchant_id','category_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }


    public function orders()
    {
        return $this->belongsToMany('App\Models\Item','App\Models\ItemOrder','merchant_id');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer')->orderBy('created_at','DESC');
    }
    public function spacialItems()
    {
        return $this->hasMany('App\Models\SpacialItem')->orderBy('created_at','DESC');
    }
   
    public function getLastOfferAttribute()
    {
        $today = \Carbon\Carbon::today()->toDateString();

        return $this->offers()->whereDate('ending_at', '>=', $today)->latest()->orderBy('id', 'desc')->with('offerTitle')->first();
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'accountable');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }
    public function notificationCount()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->where('read_at', null)->count();
    }
    public function notifications_header()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable')->orderBy('created_at', 'DESC')->limit(5);
    }
    // public function getRestaurantDetailsAttribute()
    // {
    //     $cityName = count($this->city) ? $this->city->name.':' : '';
    //     return $cityName.$this->name.' : '.$this->phone;
    //     // return $this->city->name;
    // }

    public function getRateAttribute($value)
    {
        $sumRating = $this->reviews()->sum('rate');
        $countRating = $this->reviews()->count();
        $avgRating = 0;
        if ($countRating > 0)
        {
            $avgRating = round($sumRating/$countRating,1);
        }
        return $avgRating;
    }
  

    // public function scopeOrderByRating($query, $order = 'desc')
    // {
    //     return $query->leftJoin('reviews', 'reviews.restaurant_id', '=', 'restaurants.id')
    //         ->groupBy('restaurants.id')
    //         ->addSelect(['*', \DB::raw('sum(rate) as sumRating')])
    //         ->orderBy('sumRating', $order);
    // }

    public function scopeActivated($query)
    {
        return $query->where('activated',1);
    }

    public function getTotalOrdersAmountAttribute($value)
    {
        $commissions = $this->orders()->where('state','delivered')->sum('total');

        return $commissions;
    }

    // public function getTotalCommissionsAttribute($value)
    // {
    //     $commissions = $this->orders()->where('state','delivered')->sum('commission');

    //     return $commissions;
    // }

    public function getTotalPaymentsAttribute($value)
    {
        $payments = $this->transactions()->sum('amount');

        return $payments;
    }

    public function getPhotoUrlAttribute($value)
    {
       return !empty($this->photo)? url($this->photo):url('uploads/user.png');

      
    }
    public function getPersonalUrlAttribute($value)
    {
       return !empty($this->personal_photo)? url($this->personal_photo):url($this->type->photo);

    }
    public function getNationalIdUrlAttribute($value)
    {
       return !empty($this->national_id_photo)? url($this->national_id_photo):url('uploads/user.png');

        
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