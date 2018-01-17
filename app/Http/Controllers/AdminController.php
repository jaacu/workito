<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Dossier;
use App\adminSocialNetwork;
use App\Custom;
use App\Proyect;
use Faker;

class AdminController extends Controller
{
	public function users(){
		// abort(403);
		$users = User::all()->except(['id' => Auth::user()->id])->sortBy('created_at')->sortBy('role');
		return view('admin.users',[
			'users' => $users,
		]);
	}

	public function buscarUsuario(Request $request){
		$query = $request->input('query');

		$usuarios = User::where('name', 'LIKE' , "%$query%")->get()->sortBy('created_at')->sortBy('role');
		$url = '/admin/users';
		return view('searchIndex',[
			'data' =>$usuarios,
			'url' =>$url,
		]);
	}
	public function user($id){
		$user = User::findOrFail($id);
		if($user->id == Auth::user()->id){
			return redirect('/user/perfil');
		} else {
			if( !Auth::user()->isAdmin() ){
				abort(403);
				return redirect('/home')->withErrors('NO TIENES LOS PERMISOS NECESARIOS PARA REALIZAR ESA ACCION.');
			}
			$user->load('proyects','devs');
			return view('user.show',[
				'user' => $user,
			]);
		}
	}

	public function crearUser(){
		return view('admin.crearUser');
	}

	public function createUser(Request $request){
		$this->validate($request, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
			'NIF' => 'required|max:255',
			'contacto' => 'required|max:255',
			'cuentaSkype' => 'required|max:255',
			'role' => 'required|numeric'
		]);

		$nuevoUsuario = User::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password')),
			'NIF' => $request->input('NIF'),
			'contacto' => $request->input('contacto'),
			'cuentaSkype' => $request->input('cuentaSkype'),
			'digital_sign' => $this->generateUuid(),
			'confirmed' => true,
			'role' => $request->input('role'),
		]);
		return redirect(route('user',$nuevoUsuario->id))->withSuccess('Nuevo usuario creado con exito!');
	}

	public function generateUuid(){
		$faker = Faker\Factory::create();
		return $faker->unique()->uuid;
	}

	public function editar($id){
		$user = User::findOrFail($id);
		if($user->id == Auth::user()->id or $user->isAdmin()){
			return redirect()->back();
		} else {
			return view('user.upgrade',[
				'user' => $user,
			]);
		}
	}

	public function edit(Request $request,$id){
		$rules = array();
		$rules = [
			'name' => 'required|string|max:255',
			// 'email' => 'required|string|email|max:255|unique:users',
			// 'password' => 'required|string|min:6',
			'NIF' => 'required|max:255',
			'contacto' => 'required|max:255',
			'cuentaSkype' => 'required|max:255',
			'role' => 'required|numeric'
		];

		if(!  is_null( $request->input('password') ) ){
			$rules['password']='string|min:6';
		}

		$user = User::findOrFail($id);

		if( $user->email != $request->input('email') ){
			$rules['email']='required|string|email|max:255|unique:users';
		} else {
			$rules['email']='required|string|email|max:255';
		}

		// dd( $rules );
		$this->validate($request, $rules);
		if( $user->id == Auth::user()->id){
			return redirect('/home')->withErrors('No puedes hacer eso.');
		}

		if($user->role == $request->input('role') and is_null( $request->input('password') ) ){	
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->NIF = $request->input('NIF');
			$user->contacto = $request->input('contacto');
			$user->cuentaSkype = $request->input('cuentaSkype');
			$user->save();
			return redirect('/home')->withSuccess('Cambios realizados en el usuario '.$user->name.' realizados con exito.');
		} else {
			$name = $request->input('name');
			$email = $request->input('email');
			$NIF = $request->input('NIF');
			$contacto = $request->input('contacto');
			$cuentaSkype = $request->input('cuentaSkype');
			$digital_sign = $user->digital_sign;
			if( $user->role != $request->input('role') ){
				$role = $request->input('role');
			} else {
				$role = $user->role;
			}

			if ( ! is_null( $request->input('password') ) ) {
				$password = bcrypt($request->input('password'));			
			} else {
				$password = $user->password;
			}
			$user->delete();

			$nuevoUsuario = User::create([
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'NIF' => $NIF,
				'contacto' => $contacto,
				'cuentaSkype' => $cuentaSkype,
				'digital_sign' => $digital_sign,
				'confirmed' => true,
				'role' => $role,
			]);
			return redirect('/home')->withSuccess('Cambios realizados en el usuario '.$nuevoUsuario->name.' realizados con exito.');
		}
	}

	public function eliminar($id){
		$user = User::findOrFail($id);

		if( $user->id == Auth::user()->id){
			return redirect('/home')->withErrors('No puedes hacer eso.');
		} else {
			return view('user.eliminar',[
				'user' => $user,
			]);			
		}
	}

	public function delete($id, Request $request){

		$this->validate($request,[
			'aceptar' => 'required|boolean',
		]);

		if($request->input('aceptar')){
			$user = User::findOrFail($id);

			if( $user->id == Auth::user()->id){
				return redirect('/home')->withErrors('No puedes hacer eso.');
			} 

			if($user->isClient()){//Si el usuario es cliente tambien hayq que borrar los proyectos relacionados con estos id
				$this->borrarCliente($user);
			}
			$user->delete();
			return redirect('/home')->withSuccess('Usuario eliminado con exito.');
		} else {
			return redirect()->back()->withErrors('Hubo un error, intentelo de nuevo.');
		}
	}

	public function borrarCliente($user){

		$dossiers = $user->dossiers;
		foreach ($dossiers as $proyecto) {
			if( $proyecto->encontrar() ){
				$borrar = $proyecto->encontrar();
				$borrar->delete();
			}
		}
		$adminSocialNetworks = $user->adminSocialNetworks;
		foreach ($adminSocialNetworks as $proyecto) {
			if( $proyecto->encontrar() ){
				$borrar = $proyecto->encontrar();
				$borrar->delete();
			}
		}
	}


	public function proyectos()
	{
		$dossiers = Dossier::all();
		$AdmSN = adminSocialNetwork::all();
		$customs = Custom::all();
		$proyecto = $dossiers->concat($customs)->concat($AdmSN)->sortByDesc('updated_at');
		return view('admin.proyectos',[
			'proyectos' => $proyecto, 
		]);
	}

	public function asignar( $type , $id ){
		if( $type < 0  && $type >1 )
			return redirect()->back();
		$proyecto = Proyect::where([
			['proyect_type', $type],
			['proyect_id', $id],
		])->first();
		// $reasignar = ''
		if(! is_null($proyecto) )
			return redirect('/proyecto/reasignar/'.$proyecto->id);
		$devs = User::where('role', '=', 1)->get();
		return view('admin.asignar',[
			'devs' => $devs,
			'type' => $type,
			'proyect_id' =>$id,
		]);
	}

	public function reasignar( $id ){
		$proyect = Proyect::findOrFail($id);

		$devs = User::where('role', '=', 1)->get();

		return view('admin.reasignar',[
			'proyecto' => $proyect,
			'devs' =>$devs,
		]);
	}
}
