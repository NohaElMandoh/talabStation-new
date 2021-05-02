<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientsSettings extends Model {

	protected $table = 'clients_settings';
	public $timestamps = false;
	protected $fillable = array(
		'client_id','notifications'
		
	);

}