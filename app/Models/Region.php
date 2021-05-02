<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en','city_id','delivery_cost');
	protected $with = ['city'];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function merchants()
    {
        return $this->hasMany('App\Models\Merchant');
    }

}