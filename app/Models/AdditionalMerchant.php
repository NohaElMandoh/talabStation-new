<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalMerchant extends Model {

 

	protected $table = 'additional_merchant';
	public $timestamps = true;
	protected $fillable = array('merchant_name', 'merchant_address', 'phone', 'service_describe','client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }


}