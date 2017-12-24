<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminSocialNetwork extends Model
{
	protected $guarded = [];
	
	public function user(){
		return $this->belongsTo(User::class);
	}

	public function encontrar(){
		// $table = $this->type($type);
		// $response = DB::table('proyects')->where([
		// 	['proyect_type', 1],
		// 	['proyect_id', $id],
		// ])->first();

		$response = Proyect::where([
			['proyect_type', 1],
			['proyect_id', $this->id],
		])->first();
		return $response;
	}
}
