<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Dossier;
use App\adminSocialNetwork;
use App\Proyect;

class AdminController extends Controller
{
	public function users(){
		$clients = DB::table('users')->where('role', '=', 2)->get();
		$devs = DB::table('users')->where('role', '=', 1)->get();
		$admins = DB::table('users')->where([
			['role', 0],
			['id', '!=', Auth::user()->id],
		])->get();
		return view('admin.users',[
			'devs' => $devs,
			'clients' => $clients,
			'admins' => $admins
		]);
	}

	public function user($id){
		$user = User::findOrFail($id);
		if($user->id == Auth::user()->id){
			return redirect('/user/perfil');
		} else {
			if( !Auth::user()->isAdmin() ){
				return redirect('/home')->withErrors('NO TIENES LOS PERMISOS NECESARIOS PARA REALIZAR ESA ACCION.');
			}
			return view('user.show',[
				'user' => $user,
			]);
		}
	}

	public function editar($id){
		$user = User::findOrFail($id);
		if($user->id == Auth::user()->id){
			return redirect()->back();
		} else {
			return view('user.upgrade',[
				'user' => $user,
			]);
		}
	}

	public function edit(Request $request,$id){
		$this->validate($request,[
			'role' => 'required|numeric',
		]);
		$user = User::findOrFail($id);
		if( $user->id == Auth::user()->id){
			return redirect('/home')->withErrors('No puedes hacer eso.');
		}
		if($user->role == $request->input('role') ){
			return redirect()->back()->withErrors('Selecciona un rol diferente.');
		} 
		$name = $user->name;
		$email = $user->email;
		$password = $user->password;
		$NIF = $user->NIF;
		$contacto = $user->contacto;
		$cuentaSkype = $user->cuentaSkype;
		$digital_sign = $user->digital_sign;

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
			'role' => $request->input('role'),
		]);

		// dd($nuevoUsuario);
		// $user->role = $request ->input('role',$user->role);
		// if($request ->input('role') == 1 or $request ->input('role') == 0){
		// 	$user->confirmed=true;
		// }

		// $user->save();

		return redirect('/home')->withSuccess('Cambio de rol en el usuario '.$user->name.' realizado con exito.');
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
			'aceptar' => 'required',
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


	public function proyectos(){
		$dossiers = Dossier::all()->sortByDesc('updated_at');
		$AdmSN = adminSocialNetwork::all()->sortByDesc('updated_at');
		$proyects = Proyect::all()->sortByDesc('updated_at');
		//dd($dossiers);
		return view('admin.proyectos',[
			'dossiers' => $dossiers,
			'AdmSN' => $AdmSN,
			'proyects' => $proyects, 
		]);
	}

	public function asignar( $type , $id ){
		if( $type < 0  && $type >1 )
			return redirect()->back();
		$proyecto = DB::table('proyects')->where([
			['proyect_type', $type],
			['proyect_id', $id],
		])->first();
		// $reasignar = ''
		if(! is_null($proyecto) )
			return redirect('/proyecto/reasignar/'.$proyecto->id);
		$devs = DB::table('users')->where('role', '=', 1)->get();
		return view('admin.asignar',[
			'devs' => $devs,
			'type' => $type,
			'proyect_id' =>$id,
		]);
	}

	public function reasignar( $id ){
		$proyect = Proyect::findOrFail($id);

		$devs = DB::table('users')->where('role', '=', 1)->get();

		return view('admin.reasignar',[
			'proyecto' => $proyect,
			'devs' =>$devs,
		]);
	}
}
