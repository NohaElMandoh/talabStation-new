<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model {

	protected $table = 'items_images';
	public $timestamps = true;
	protected $fillable = array( 'photo','item_id');
    protected $appends = ['photo_url'];


    public function category()
    {
        return $this->belongsTo('App\Models\Item');
    }
  
    public function getPhotoUrlAttribute($value)
    {
        return !empty($this->photo) ? url($this->photo) : url('uploads/default.jpg');
    }
}