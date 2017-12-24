<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dev extends Model
{
	protected $guarded = [];
	
	public function user(){
		return $this->belongsTo(User::class);
		// return $this->belongsTo('App\Post');
	}

	public function proyect(){
		return $this->belongsTo(Proyect::class);
		// return $this->belongsTo('App\Post');
	}
}
