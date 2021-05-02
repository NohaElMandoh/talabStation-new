<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model {

	protected $table = 'guests';
	public $timestamps = true;
	// protected $fillable = array('name', 'phone', 'city_id', 'address');
	protected $fillable = array('lat', 'lang', 'city', 'address');

	// public function orders()
	// {
	// 	return $this->morphMany('App\Models\Order','orderable');
	// }

}