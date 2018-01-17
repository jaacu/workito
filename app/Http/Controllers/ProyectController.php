<?php

namespace App\Http\Controllers;

use App\User;
use App\Dev;
use App\Proyect;
use App\Comment;
use App\adminSocialNetwork;
use App\Dossier;
use App\Custom;
Use Auth;
use App\Http\Requests\CreateProyectRequest;
use App\Http\Requests\CreateAdmSocialNetworkRequest;
use App\Http\Requests\CreateDossierRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Notifications\DeveloperAssign;
use App\Notifications\NuevoComentario;
use App\Notifications\ProyectoEditado;

class ProyectController extends Controller
{

	public function all(){
		return view('proyecto.all');
	}

	public function show(Proyect $id){
		// $variable = Proyect::findOrFail($id);
		//dd($proyecto);
		if( Auth::user()->isAdmin() or $id->hasDev( Auth::user()->id ) ){
			return view('proyecto.show',[
				'proyecto' => $id
			]);
		}  else {
			abort(403);
		}
	}

	public function showType($type, $id){
		switch ($type) {
			case 0:
			$proyecto = Dossier::findOrFail($id);
			$name ='proyectoDossier';
			break;
			case 1:
			$proyecto = adminSocialNetwork::findOrFail($id);
			$name = 'proyectoAdmSN';			
			break;
			case 2:
			$proyecto = custom::findOrFail($id);
			// dd($proyecto->encontrar());
			// $proyecto
			return $this->show($proyecto->encontrar());
			break;
			default:
			abort(404);
			break;
		}
		if( Auth::user()->isAdmin() or Auth::user()->id === $proyecto->user->id){
			$view = 'proyecto.'.$name;
			return view('proyecto.show',[
				'proyecto' => $proyecto,
				'type' => $type,
				'view' =>$view,
			]);
		} else{
			abort(403);
		}

	}

	public function getProyectos($query){
		$dossiers = Dossier::where('nombre', 'LIKE' , "%$query%")->get();
		$adsn = adminSocialNetwork::where('nombre', 'LIKE' , "%$query%")->get();
		$proyectos = Proyect::where('nombre', 'LIKE' , "%$query%")->get();
		$all = $dossiers->concat( $adsn );
		$filtro = $all->filter(function ($value, $key) {
			return is_null( $value->encontrar() );
		});
		$proyectos = $proyectos->concat($filtro);
		return $proyectos;
	}

	public function buscarProyectos(Request $request){
		$query = $request->input('query');
		if( Auth::user()->isAdmin() ){
			$url = route('admin.proyectos');
			$proyectos = $this->getProyectos($query);
		} else {
			$todos = Proyect::where('nombre', 'LIKE' , "%$query%")->get();
			$proyectos = collect();
			foreach ($todos as $one) {
				if( $one->hasDev(Auth::user()->id) ){
					$dev = Auth::user()->devs->where('proyect_id' , $one->id )->first();
					$proyectos->push($dev);
				}
			}

			$url= route('dev.proyectos');
		}
		return view('searchIndex',[
			'data' =>$proyectos,
			'url' =>$url,
		]);
	}

	public function Crear(){
		$devs = User::where('role', '=', 1)->get();
		return view('proyecto.Crear',[
			'devs' => $devs,
		]);
	}

	public function createCustom(CreateProyectRequest $request){
		if(Auth::user()->isAdmin()){
			$id = Auth::user()->id;
		} else {
			return redirect(route('home'))->withErrors('No tienes los permisos necesarios para realizar esta accion');
		}
		$custom = Custom::create([
			'descripcion' => $request->input('descripcion'),
		]);

		$proyecto = Proyect::create([
			'nombre' => $request->input('name'),
			'fecha_limite' => $request->input('fecha_limite'),
			'proyect_id' => $custom->id,
			'proyect_type' => 2,
			'user_id' => $id,
		]);

		foreach ($request->input('dev') as $idDev) {
			$developer = Dev::create([
				'user_id' => $idDev,
				'proyect_id' => $proyecto->id,
			]);
			$developer->user->notify( new DeveloperAssign($proyecto) );
		}
		$ruta = route('proyecto.show',[$proyecto->id]);
		return redirect($ruta)->withSuccess('Proyecto asignado con exito.');
	}

	//Dossier
	public function Creardossier(){
		return view('proyecto.CrearDossier');
	}

	public function createdossier(CreateDossierRequest $request){
		//Que va a validar (Una request) , un array de reglas, con cada parametro
		$user = $request->user();

		$proyecto = Dossier::create([
			'user_id' => $user->id,
			'nombre' => $request->input('nombre'),
			'queEs' => $request->input('queEs'),
			'publico' => $request->input('publico'),
			'mision' => $request->input('mision'),
			'vision' => $request->input('vision'),
			'valores' => $request->input('valores'),
			'servicios' => $request->input('servicios'),
			'crecimiento' => $request->input('crecimiento'),
			'que_se_puede_encontrar' => $request->input('que_se_puede_encontrar'),
			'cualidades' => $request->input('cualidades'),
			'comentarios' => $request->input('comentarios',null),
		]);
		//dd($proyecto);
		return redirect(route('home'))->withSuccess('Proyecto '.$proyecto->nombre.' Creado Con Exito!');
	}

	public function editarDossier($id)
	{
		$dossier = Dossier::findOrFail($id);
		if($dossier->user_id != Auth::user()->id && !Auth::user()->isAdmin()){
			return redirect(route('home'))->withErrors(['Acceso Denegado, no se ha encontrado esta pagina en su registro.']); 
		}
		return view('proyecto.EditarDossier',[
			'proyecto' => $dossier,
		]);
	}

	public function editDossier($id, CreateDossierRequest $request){
		$proyecto = Dossier::findOrFail($id);

		$proyecto->nombre = $request->input('nombre');
		$proyecto->queEs = $request->input('queEs');
		$proyecto->publico = $request->input('publico');
		$proyecto->mision = $request->input('mision');
		$proyecto->vision = $request->input('vision');
		$proyecto->valores = $request->input('valores');
		$proyecto->servicios = $request->input('servicios');
		$proyecto->crecimiento = $request->input('crecimiento');
		$proyecto->que_se_puede_encontrar = $request->input('que_se_puede_encontrar');
		$proyecto->cualidades = $request->input('cualidades');
		$proyecto->comentarios = $request->input('comentarios',null);

		$proyecto->save();
		return redirect(route('home'))->withSuccess('Proyecto '.$proyecto->nombre.' Actualizado con exito.');
	}
		// Fin Dossier
	// Social Admin Network
	public function CrearAdmSN(){
		return view('proyecto.CrearAdmSN');
	}

	public function createAdmSN(CreateAdmSocialNetworkRequest $request){
		//Que va a validar (Una request) , un array de reglas, con cada parametro
		$user = $request->user();
		$facebook=false;
		$twitter=false;
		$instagram=false;
		if ($request->input('facebook'))
			$facebook=true;
		if ($request->input('twitter'))
			$twitter=true;
		if ($request->input('instagram'))
			$instagram=true;
		$proyecto = adminSocialNetwork::create([
			'user_id' => $user->id,
			'nombre' => $request->input('nombre'),
			'facebook' =>$facebook,
			'fbPermisosCompra' => $request->input('fbPermisosCompra',null),
			'twitter' => $twitter,
			'twEmail' => $request->input('twEmail',null),
			'twPassword' => $request->input('twPassword',null),
			'instagram' => $instagram,
			'instEmail' => $request->input('instEmail',null),
			'instPassword' => $request->input('instPassword',null),
		]);
		//dd($proyecto);
		return redirect(route('home'))->withSuccess('Proyecto '.$proyecto->nombre.' Creado Con Exito!');
	}

	public function editarAdmSN($id)
	{
		$proyecto = adminSocialNetwork::findOrFail($id); 
		if($proyecto->user_id != Auth::user()->id && !Auth::user()->isAdmin())
			{
				return redirect(route('home'))->withErrors(['Acceso Denegado, no se ha encontrado esta pagina en su registro.']); 
			}
			return view('proyecto.EditarAdmSN',[
				'proyecto' => $proyecto,
			]);
		}

		public function editAdmSN($id, CreateAdmSocialNetworkRequest $request){
			$proyecto = adminSocialNetwork::findOrFail($id);

			$facebook=false;
			$twitter=false;
			$instagram=false;
			if ($request->input('facebook'))
				$facebook=true;
			if ($request->input('twitter'))
				$twitter=true;
			if ($request->input('instagram'))
				$instagram=true;

			$proyecto->nombre = $request->input('nombre');
			$proyecto->facebook =$facebook;
			$proyecto->fbPermisosCompra = $request->input('fbPermisosCompra',null);
			$proyecto->twitter = $twitter;
			$proyecto->twEmail = $request->input('twEmail',null);
			$proyecto->twPassword = $request->input('twPassword',null);
			$proyecto->instagram = $instagram;
			$proyecto->instEmail = $request->input('instEmail',null);
			$proyecto->instPassword = $request->input('instPassword',null);

			$proyecto->save();
			return redirect(route('home'))->withSuccess('Proyecto '.$proyecto->nombre.' Actualizado con exito.');
		}
			// Social Admin Network

		public function create(CreateProyectRequest $request){
		//Que va a validar (Una request) , un array de reglas, con cada parametro
			if(Auth::user()->isAdmin()){
				$id = Auth::user()->id;
			} else {
				return redirect(route('home'))->withErrors('No tienes los permisos necesarios para realizar esta accion');
			}

			$proyecto = Proyect::create([
				'nombre' => $request->input('name'),
				'fecha_limite' => $request->input('fecha_limite'),
				'proyect_id' => $request->input('id'),
				'proyect_type' => $request->input('type'),
				'user_id' => $id,
			]);
				//dd($request->input('dev'));
			foreach ($request->input('dev') as $id ) {
				$developer = Dev::create([
					'user_id' => $id,
					'proyect_id' => $proyecto->id,
				]);
				$developer->user->notify( new DeveloperAssign($proyecto) );
			}
			return redirect(route('proyecto.show',[$proyecto->id]))->withSuccess('Proyecto asignado con exito.');
		}

		public function edit($id, CreateProyectRequest $request){
		//Que va a validar (Una request) , un array de reglas, con cada parametro
			$proyecto = Proyect::findOrFail($id);

			$proyecto->nombre = $request->input('name'); 
			$proyecto->fecha_limite = $request->input('fecha_limite',null); 
				// $proyecto->restante = $request->input('tiempo',null); 
				// $proyecto->user_id = $request->input('dev'); 
			$actualDevs = $proyecto->devs;

			$newDevs = $request->input('dev');

			foreach( $actualDevs as $dev){
					if( ! in_array($dev->user->id, $newDevs)){// Elimina los desarrolladores que ya no forman parte de este proyecto
						$del = Dev::findOrFail($dev->id);
						$del->delete();	
					}
				}

				$actualDevs = $proyecto->devs;//Los devs actuales luego de borrar los que no van
				
				foreach ( $newDevs as $dev) {
					if( ! $proyecto->hasDev($dev) ){// Agrega a los desarrolladores Nuevos

						$developer = Dev::create([
							'user_id' => $dev,
							'proyect_id' => $proyecto->id,
						]);

						$developer->user->notify( new DeveloperAssign($proyecto) );
					}
				}
				if($proyecto->isCustom()){
					$custom = $proyecto->encontrar();
					$custom->descripcion = $request->input('descripcion');
					$custom->save();
				}
				$proyecto->save();
				return redirect(route('home'))->withSuccess('Proyecto editado con exito.');
			}

			public function terminate($id){
				$proyecto = Proyect::findOrFail($id);

				$proyecto->terminado = !($proyecto->terminado);

				$proyecto->save();

				foreach ($proyecto->devs as $dev) {
					$dev->user->notify( new ProyectoEditado($proyecto) );
				}
				return redirect()->back()->withSuccess('Proyecto '.$proyecto->nombre.' actualizado con exito.');
			}

			public function eliminar($id){
				$proyect = Proyect::findOrFail($id);

				// session()->flash('Hola',$proyect);
				return view('proyecto.eliminar',[
					'proyecto' => $proyect,
				]);
			}

			public function delete($id, Request $request){
				
				$this->validate($request,[
					'aceptar' => 'required',
				]);
				if($request->input('aceptar')){
					$proyect = Proyect::findOrFail($id);

					if($proyect->isCustom() or $proyect->isTerminado()){
						$deleteado = $proyect->encontrar();
						$deleteado->delete();
					}
					//Los devs y comentarios se borran solos por la relacion que tienen
					$proyect->delete();
					return redirect(route('home'))->withSuccess('Proyecto eliminado con exito.');
				} else {
					return redirect()->back()->withErrors('Hubo un error, intentelo de nuevo.');
				}
			}

			public function comentar( $id , Request $request){
				$this->validate($request,[
					'texto' => 'required|max:300',
				]);
				$user = Auth::user();
				$comentario = Comment::create([
					'texto' => $request->input('texto'),
					'proyect_id' => $id,
					'user_id' => $user->id,
				]);
				foreach ($comentario->proyect->devs as $dev ) {
					if($dev->user_id != $user->id){
						$dev->user->notify( new NuevoComentario($comentario->proyect,$user) );
					}
				}	
				if($user->id != $comentario->proyect->user->id){
					$comentario->proyect->user->notify( new NuevoComentario($comentario->proyect,$user) );						
				}
				return redirect( route('dev.proyecto', $id) );
			}

			public function editarComentario($id){//Id del comentario
				$comment = Comment::findOrFail($id);
				// dd($comment);
				if(Auth::user()->id == $comment->user->id){
					return view('comments.edit',[
						'comment' => $comment,
					]);
				} else {
					return redirect()->back()->withErrors('No puedes editar este comentario');
				}
			}

			public function editComentario($id, Request $request){
				$this->validate($request,[
					'texto' => 'required|max:300',
				]);
				$comment = Comment::findOrFail($id);
				if(Auth::user()->id == $comment->user->id){
					$comment->texto = $request->input('texto');
					$comment->save();
					return redirect("/dev/proyecto/".$comment->proyect->id);
				} else {
					return redirect()->back()->withErrors('No puedes editar este comentario');
				}
			}

			public function eliminarComentario($id){
				
				$comment = Comment::findOrFail($id);
				if($comment->user->id == Auth::user()->id or Auth::user()->isAdmin() ){
					$comment->delete();
					return redirect()->back()->withSuccess('Comentario eliminado con exito.');
				} else {
					return redirect()->back()->withErrors('No puedes borrar este comentario.');
				}
			}

		}
