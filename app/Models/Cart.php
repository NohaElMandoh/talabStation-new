<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    

    protected $table = 'carts';
    public $timestamps = true;
    protected $dates = ['need_delivery_at'];


    protected $fillable = array(
          'client_id', 'state','quantity','note'
    );
   

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    
    public function item()
    {
        // return $this->belongsTo('App\Models\Item');
        return $this->morphTo();

    }

    // public function user()
    // {
    //     return $this->morphTo();
    // }

  
}
