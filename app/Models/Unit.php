<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

	protected $table = 'units';
	public $timestamps = true;
	protected $fillable = array('name_ar', 'name_en');

	public function items()
	{
		return $this->hasMany('App\Models\Item');
	}
}