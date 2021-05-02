<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'items';
	public $timestamps = true;
	protected $fillable = array('name', 'description', 'price', 'discount', 'photo','disabled','category_id','unit_id');
    protected $appends = ['photo_url','type'];

	public function orders()
	{
        return $this->belongsToMany('App\Models\Order');
        
	}
    public function images()
    {
        return $this->hasMany('App\Models\ItemImage');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
    
    public function cart()
    {
        return $this->morphMany('App\Models\Cart', 'item');
    }

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
	}

    public function scopeEnabled($q)
    {
        return $q->where('disabled',0);
	}

    public function getPhotoUrlAttribute($value)
    {
        
        return !empty($this->photo) ? url($this->photo) : url('uploads/default.jpg');
    }

    public function getTypeAttribute($value)
    {
        return 'item';
    }

	protected $hidden = ['disabled'];

}