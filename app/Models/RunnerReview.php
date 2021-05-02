<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RunnerReview extends Model
{

    protected $table = 'runners_reviews';
    public $timestamps = true;
    protected $fillable = array('note', 'rate', 'runner_id', 'client_id','order_id');
    protected $with = ['client', 'runner'];
   

    public function runner()
    {
        return $this->belongsTo('App\Models\Runner');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

}