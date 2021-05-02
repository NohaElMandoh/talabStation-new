<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SpacialItem extends Model
{

    protected $table = 'spacial_items';
    public $timestamps = true;
    protected $fillable = ['price', 'name', 'quantity', 'note', 'client_id','merchant_id'];

    protected $appends = ['type', 'photo_url'];
    
    public function orders()
	{
        return $this->belongsToMany('App\Models\Order');
        
	}
   
    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'item_offer', 'offer_id', 'item_id');
    }


    public function getTypeAttribute($value)
    {
        return "spacialItem";
    }
    
    
    public function getPhotoUrlAttribute($value)
    {
       return !empty($this->photo)? url($this->photo):url('uploads/user.png'); 
    }
}
