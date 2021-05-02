<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array(
        'title', 'content', 'title_en', 'content_en', 'order_id', 'notifiable_type',
        'notifiable_id', 'order_url', 'user_id', 'photo'
    );
    protected $appends = ['photo_url'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
    public function getPhotoUrlAttribute($value)
    {
        return !empty($this->photo) ? url($this->photo) : url('uploads/logo.png');
    }
}
