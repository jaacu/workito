<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
	protected $guarded = [];

	public $proyect = 0;

	public $type = 2;

	public function getType(){
		return $this->type;
	}

	public function encontrar(){
		// $table = $this->type($type);
		// $response = DB::table('proyects')->where([
		// 	['proyect_type', 0],
		// 	['proyect_id', $id],
		// ])->first();
		//Este metodo de arriba sobrescribe elquent y por lo tanto las relaciones
		//No usar cuando quiero usar relaciones
		// dd($this->type);
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
	
}
