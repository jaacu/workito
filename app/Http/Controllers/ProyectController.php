<?php

namespace App\Http\Controllers;

use App\User;
use App\Dev;
use App\Proyect;
use App\Comment;
use App\adminSocialNetwork;
use App\Dossier;
Use Auth;
use App\Http\Requests\CreateProyectRequest;
use App\Http\Requests\CreateAdmSocialNetworkRequest;
use App\Http\Requests\CreateDossierRequest;
use Illuminate\Http\Request;

class ProyectController extends Controller
{

	public function all(){
		return view('proyecto.all');
	}

	public function show(Proyect $id){
		// $variable = Proyect::findOrFail($id);
		//dd($proyecto);
		return view('proyecto.show',[
			'proyecto' => $id
		]);
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
			default:
			abort(404);
			break;
		}
		$view = 'proyecto.'.$name;
		return view('proyecto.show',[
			'proyecto' => $proyecto,
			'type' => $type,
			'view' =>$view,
		]);
	}

	public function Crear(){
		return view('proyecto.Crear');
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
			'Nombre' => $request->input('Nombre'),
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
		return redirect('/home')->withSuccess('Proyecto Creado Con Exito!');
	}

	public function editarDossier($id)
	{
		if(Dossier::findOrFail($id)->user_id != Auth::user()->id && !Auth::user()->isAdmin())
			{
				return redirect('/home')->withErrors(['Acceso Denegado, no se ha encontrado esta pagina en su registro.']); 
			}
			return view('proyecto.EditarDossier',[
				'proyecto' => Dossier::findOrFail($id),
			]);
		}

		public function editDossier($id, CreateDossierRequest $request){
			$proyecto = Dossier::findOrFail($id);
			
			$proyecto->Nombre = $request->input('Nombre');
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
			return redirect('/home')->withSuccess('Proyecto Actualizado con exito.');
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
			return redirect('/home')->withSuccess('Proyecto Creado Con Exito!');
		}

		public function editarAdmSN($id)
		{
			if(adminSocialNetwork::findOrFail($id)->user_id != Auth::user()->id && !Auth::user()->isAdmin())
				{
					return redirect('/home')->withErrors(['Acceso Denegado, no se ha encontrado esta pagina en su registro.']); 
				}
				return view('proyecto.EditarAdmSN',[
					'proyecto' => adminSocialNetwork::findOrFail($id),
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
				return redirect('/home')->withSuccess('Proyecto Actualizado con exito.');
			}
			// Social Admin Network
			
			public function create(CreateProyectRequest $request){
		//Que va a validar (Una request) , un array de reglas, con cada parametro
				if(Auth::user()->isAdmin()){
					$id = Auth::user()->id;
				} else {
					return redirect('/home')->withErrors('No tienes los permisos necesarios para realizar esta accion');
				}

				$proyecto = Proyect::create([
					'nombre' => $request->input('name'),
					'fecha_limite' => $request->input('fecha_limite',null),
					// 'restante' => $request->input('tiempo',null),
					// 'user_id' => $request->input('dev'),
					'proyect_id' => $request->input('id'),
					'proyect_type' => $request->input('type'),
					'user_id' => $id,
				]);
				//dd($request->input('dev'));
				foreach ($request->input('dev') as $id ) {
					Dev::create([
						'user_id' => $id,
						'proyect_id' => $proyecto->id,
					]);
				}
				return redirect('/home')->withSuccess('Proyecto asignado con exito.');
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

						Dev::create([
							'user_id' => $dev,
							'proyect_id' => $proyecto->id,
						]);

					}
				}

				$proyecto->save();
				return redirect('/home')->withSuccess('Proyecto editado con exito.');
			}

			public function eliminar($id){
				$proyect = Proyect::findOrFail($id);
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

					// $proyect->devs->delete();
					// $proyect->comments->delete();
					$proyect->delete();
					return redirect('/home')->withSuccess('Proyecto eliminado con exito.');
				} else {
					return redirect()->back()->withErrors('Hubo un error, intentelo de nuevo.');
				}
			}

			public function comentar( $id , Request $request){
				$this->validate($request,[
					'texto' => 'required|max:300',
				]);

				$proyecto = Comment::create([
					'texto' => $request->input('texto'),
					'proyect_id' => $id,
					'user_id' => Auth::user()->id,
				]);
				return redirect("/dev/proyecto/$id");
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
