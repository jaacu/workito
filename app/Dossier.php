<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
	protected $guarded = [];
	
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

		$response = Proyect::where([
			['proyect_type', 0],
			['proyect_id', $this->id],
		])->first();
		//dd($response->user);
		return $response;
	}

	// public function proyects()
	// {
	// 	return $this->morphToMany('App\Proyect', 'type_proyect', 'proyects_relationship');
	// }
}
