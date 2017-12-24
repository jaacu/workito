<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Comment extends Model
{
	protected $guarded = [];
	

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function proyect(){
		return $this->belongsTo(Proyect::class);
	}

	public function isEditado(){
		return ($this->created_at != $this->updated_at);
	}

	public function forHumansCreado(){
		Carbon::setLocale('es');
		$now = new Carbon();
		$time = $this->carbonFormat($this->created_at);
		$creado = Carbon::create($time[0],$time[1],$time[2],$time[3],$time[4],$time[5]);
		return $creado->diffForHumans($now);
	}

	public function forHumansEditado(){
		// Carbon::setLocale('es');
		$now = new Carbon();
		$time = $this->carbonFormat($this->updated_at);
		$creado = Carbon::create($time[0],$time[1],$time[2],$time[3],$time[4],$time[5]);
		return $creado->diffForHumans($now);
	}

	public function carbonFormat($string){
		return preg_split("/[- :]/", $string);
	}
}
