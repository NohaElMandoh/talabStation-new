<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ItemOffer extends Model
{
    

    protected $table = 'item_offer';
    public $timestamps = true;


    protected $fillable = array(
        'price','offer_id','item_id'
    );
   
}
