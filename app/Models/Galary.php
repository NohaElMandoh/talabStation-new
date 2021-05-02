<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galary extends Model {

	protected $table = 'galaries';
	public $timestamps = true;
	protected $fillable = array('name','photo','position','display');
    protected $appends = ['photo_url'];

	public function getPhotoUrlAttribute($value)
    {
        return url($this->photo);
	}
	
}