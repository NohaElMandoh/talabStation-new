<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {

	protected $table = 'types';
	public $timestamps = true;
	protected $fillable = array('name_ar','name_en','photo');
    protected $appends = ['photo_url'];


	public function merchants()
	{
		return $this->hasMany('App\Models\Merchant');
	}
	public function getPhotoUrlAttribute($value)
    {
        return url($this->photo);
	}
	
}