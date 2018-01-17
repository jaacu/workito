<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
	protected $guarded = [];
	
	public $proyect = 0;
	
	public $type = 0;

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function encontrar(){
		// $table = $this->type($type);
		// $response = DB::table('proyects')->where([
		// 	['proyect_type', 0],
		// 	['proyect_id', $id],
		// ])->first();
		//Este metodo de arriba sobrescribe elquent y por lo tanto las relaciones
		//No usar cuando quiero usar relaciones

		if( $this->proyect === 0 ){
			$this->proyect = Proyect::where([
				['proyect_type', $this->type],
				['proyect_id', $this->id],
			])->first();
			if( ! is_null($this->proyect) ){
				$this->proyect->load('devs');
			}
		}
		return $this->proyect;
	}

	public function getType(){
		return $this->type;
	}

	public function getTypeString(){
		return 'Dossier';
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

	// public function proyects()
	// {
	// 	return $this->morphToMany('App\Proyect', 'type_proyect', 'proyects_relationship');
	// }
}
