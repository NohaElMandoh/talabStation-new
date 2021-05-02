<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('comment', 'rate', 'merchant_id', 'client_id');
    protected $with = ['client', 'merchant'];
   

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}