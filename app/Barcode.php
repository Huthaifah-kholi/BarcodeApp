<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
	public $timestamps = false;
	
    public function Users()	
    {
    	return $this->belongsTo('App\User');
    }
}
