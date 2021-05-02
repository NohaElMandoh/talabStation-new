<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'starting_at', 'ending_at', 'photo', 'merchant_id','offer_title_id','notify');
    protected $dates = ['starting_at','ending_at'];
    protected $appends = ['available','photo_url','items_total','discount','type','starting_date','ending_date'];

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item','item_offer','offer_id','item_id');
    }
   
    public function offerTitle()
    {
        return $this->belongsTo('App\Models\OfferTitle');
    }
   
    public function getAvailableAttribute($value)
    {
        $today = Carbon::now()->startOfDay();
        if ($this->starting_at->startOfDay() <= $today && $this->ending_at->endOfDay() >= $today)
        {
            return true;
        }
        return false;
    }

    public function getPhotoUrlAttribute($value)
    {
    
        return !empty($this->photo) ? url($this->photo) : url('uploads/default.jpg');
    }
    public function getItemsTotalAttribute($value)
    {
    
        return !empty($this->items) ? $this->items->sum('price') :0.00;
    }
    
    public function getDiscountAttribute($value)
    {
    
        return !empty($this->items_total) ? ($this->items_total-$this->price) :0.00;
    }
    public function getTypeAttribute($value)
    {
        return "offer";
    }

    public function getStartingDateAttribute($value)
    {
        // return $this->starting_at->toDateString().' '.$this->created_at->format('g:i A');
        return $this->starting_at->toDateString();

    }
    public function getEndingDateAttribute($value)
    {
        return $this->ending_at->toDateString();
    }
    // public function getTitlesOfferAttribute($value)
    // {
    //     return $this->ending_at->toDateString();
    // }
    protected $hidden = [
        'notify'
    ];

}