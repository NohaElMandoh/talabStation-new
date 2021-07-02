<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OfferTitle extends Model
{

    protected $table = 'offers_titles';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'photo','type_id');
  
    protected $appends = ['photo_url'];


    public function offers()
    {
        return $this->hasMany('App\Models\Offer','offer_title_id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type','type_id');
    }
    
    
    public function getPhotoUrlAttribute($value)
    {
        return !empty($this->photo) ? url($this->photo) : url('uploads/default.jpg');
    }
    

}