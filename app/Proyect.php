<?php

namespace App;

use App\Custom;
use App\Dossier;
use App\adminSocialNetwork;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proyect extends Model
{
	protected $guarded = [];
	
	public $proyectoTipo = 0;

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
		$devs = $this->devs;
		foreach( $devs as $dev){
			if($dev->user->id === Auth::user()->id){
				return $dev;// Si esta
				break;
			}
		}
		return null;
	}

	public function encontrarDossier(){
		return Dossier::findOrFail($this->proyect_id);
	}

	public function encontrarAdminSN(){
		return adminSocialNetwork::findOrFail($this->proyect_id);
	}

	public function encontrarCustom(){
		return Custom::findOrFail($this->proyect_id);
	}
	
	public function isCustom(){
		return ($this->proyect_type === 2);
	}

	public function encontrar(){
		if($this->proyectoTipo === 0){
			switch ($this->proyect_type) {
				case 0:
				$this->proyectoTipo = $this->encontrarDossier();
				break;
				case 1:
				$this->proyectoTipo = $this->encontrarAdminSN();
				break;
				case 2://Custom
				$this->proyectoTipo = $this->encontrarCustom();
				break;
				default:
				abort(500);
				return redirect('/home')->withErrors("El proyecto que intenta buscar no existe.");
				break;
			}
			if( ! is_null($this->proyectoTipo) and ! $this->isCustom() ){
				$this->proyectoTipo->load('user');
			}
		} 

		return $this->proyectoTipo;
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

	public function isTerminado(){
		return $this->terminado;
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
