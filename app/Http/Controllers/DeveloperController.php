<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Proyect;
use App\Dev;

class DeveloperController extends Controller
{
	public function proyectos(){
		return view('dev.proyectos',[
			'devs' => Auth::user()->devs,
		]);
	}

	public function actualizar(){
		$dev = Dev::findOrFail($_GET['id']);
		
		$dev->diasTrabajado = $_GET['diasTrabajado'];
		$dev->horasTrabajado = $_GET['horasTrabajado'];
		$dev->minutosTrabajado = $_GET['minutosTrabajado'];
		$dev->segundosTrabajado = $_GET['segundosTrabajado'];
		$dev->save();
		echo "Tiempo guardado con exito.";
	}

	public function proyecto($id){
		$proyecto = Proyect::findOrFail($id);
		$devs = $proyecto->devs;
		
		foreach ($devs as $dev) {

			if( $dev->user->id == Auth::user()->id or Auth::user()->isAdmin() ){
				return view('dev.proyecto',[
					'proyecto' => $proyecto,
					'dev' => $dev,
				]);
			}
		}

		return redirect('/home')->withErrors('No estas asigando a este proyecto.');
		
	}

}
