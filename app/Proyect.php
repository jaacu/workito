<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\adminSocialNetwork;
use App\Dossier;

class Proyect extends Model
{
	protected $guarded = [];
	
	public function user(){//El administrador que lo creo
		return $this->belongsTo(User::class);
		// return $this->belongsTo('App\Post');
	}

	public function comments(){
        //Ordenado de una vez por los que les queda menos tiempo
		return $this->hasMany(Comment::class)->orderBy('updated_at','desc');
	}

	public function devs(){
        //Ordenado de una vez por los que les queda menos tiempo
		return $this->hasMany(Dev::class)->orderBy('created_at','desc');
	}

	public function hasDev($id){//id del USER
		$devs = $this->devs;
		foreach( $devs as $dev){
			if($dev->user->id == $id){
				return true;// Si esta
				break;
			}
		}
		return false;//No esta
	}

	public function actualDev(){
		// Auth::user()-> $this->devs;
		// if( )
	}

	public function encontrarDossier($id){
		return Dossier::findOrFail($id);
	}

	public function encontrarAdminSN($id){
		return adminSocialNetwork::findOrFail($id);
	}

	public function encontrar($type,$id){

		switch ($type) {
			case 0:
			return $this->encontrarDossier($id);
			break;
			case 1:
			return $this->encontrarAdminSN($id);
			default:
			return redirect('/home')->withErrors("El proyecto que intenta buscar no existe.");
			break;
		}
		// $table = $this->type($type);
		// $response = DB::table($type)->where([
		// 	// ['proyect_type ', $type],
		// 	['proyect_id ', $id],
		// ])->get();
		// return $response;
	}

	public function type($type){
		switch ($type) {
			case 0:
			return 'dossiers';
			break;
			case 1:
			return 'admin_social_networks';
			default:
			return 'dossiers';
			break;
		}
	}

	// public function actualizar($time){
	// 	$this->restante = $time;
	// 	$this->save();
	// }

	// public function dossiers()
	// {
	// 	return $this->morphedByMany('App\Dossier', 'type_proyect', 'proyects_relationship');
	// }

	// public function admin_social_networks()
	// {
	// 	return $this->morphedByMany('App\Blog', 'type_proyect', 'proyects_relationship');
	// }

	// public function videos()
	// {
	// 	return $this->morphedByMany('App\Video', 'type_proyect', 'proyects_relationship');
	// }
}
