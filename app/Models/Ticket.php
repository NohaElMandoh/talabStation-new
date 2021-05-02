<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

	protected $table = 'tickets';
	public $timestamps = true;
	protected $fillable = array('merchant_id', 'content', 'type');
	protected $appends = ['type_text'];

    public function getTypeTextAttribute()
    {
        $types = [
            'complaint' => 'شكوى',
            'suggestion' => 'اقتراح',
            'inquiry' => 'استعلام',
        ];

        if (isset($types[$this->type])) {
            return $types[$this->type];
        }
        return "";
    }
    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }

}