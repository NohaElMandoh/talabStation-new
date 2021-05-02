<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    

    protected $table = 'item_order';
    public $timestamps = true;


    protected $fillable = array(
        'price', 'quantity', 'note','item_id','item_type','merchant_state'
    );
   

   
    public function item()
    {
        return $this->morphTo();
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order');

    }
    public function offers()
    {
        return $this->morphedByMany(Offer::class, 'item');
    }

    protected $hidden = [
        'merchant_state'
    ];
  
}
