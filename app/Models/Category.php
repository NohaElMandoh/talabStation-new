<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'categories';
	public $timestamps = true;
	protected $fillable = array('name','photo','type_id');
    protected $appends = ['photo_url'];


	public function merchants()
	{
		return $this->belongsToMany('App\Models\Merchant');
	}
	public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
	public function items_merchant(int $x)
    {
        return $this->items->where('merchant_id',$x);
    }


	public function getPhotoUrlAttribute($value)
    {
        return url($this->photo);
	}
	// public function getItemsAttribute($value)
    // {
    //     return $this->merchants;
    // }
}