<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'PageController@login')->name('inicio');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	Route::group([
		'prefix' => 'api',
		'middleware' =>'roles:4',
				], function () {//Route Group prefix api
					Route::get('notifications','PageController@notifications')->name('api.get-notifications');
						// Route::post('edit/{id}','ProyectController@editComentario');
						// Route::get('eliminar/{id}','ProyectController@eliminarComentario');
				});
// Admin rol:0
	Route::group(['middleware' => 'roles:0'], function () {

		Route::group(['prefix' => 'admin'], function () {
			Route::get('users','AdminController@users')->name('admin.users');
			Route::get('proyectos','AdminController@proyectos')->name('admin.proyectos');

			Route::get('buscar/user','AdminController@buscarUsuario')->name('admin.buscar.user');
		}); 

		Route::group(['prefix' => 'user'], function () {
			Route::get('{id}','AdminController@user')->name('user');
			
			Route::get('crear','AdminController@crearUser')->name('user.crear.admin');
			Route::post('create','AdminController@createUser')->name('user.create.admin');

			Route::get('editar/{id}','AdminController@editar')->name('user.editar.admin');
			Route::post('edit/{id}','AdminController@edit')->name('user.edit.admin');

			Route::get('eliminar/{id}','AdminController@eliminar')->name('user.eliminar.admin');
			Route::post('delete/{id}','AdminController@delete')->name('user.delete.admin');
		});		
	});
// Fin admin

//Developers rol:1
	Route::group(['prefix' => 'dev'], function () {
		Route::get('proyectos','DeveloperController@proyectos')->middleware('roles:1')->name('dev.proyectos');
		Route::get('proyecto/{id}','DeveloperController@proyecto')->middleware('roles:4')->name('dev.proyecto');
		Route::get('actualizar','DeveloperController@actualizar')->middleware('roles:1')->name('dev.actualizar');
	});
//Fin developers

// User cliente rol 2, desarrolador rol 1, admin rol 0
	Route::group(['prefix' => 'user'], function () {
		Route::get('perfil','PageController@perfil')->name('user.perfil');

		Route::group(['prefix' => 'notificaciones'], function () {
			Route::get('notificaciones/markRead','PageController@leerNotificaciones')->name('user.notifications.leer');
			Route::get('notificaciones/eliminar','PageController@eliminarNotificaciones')->name('user.notifications.eliminar');
		});
		Route::get('editar','PageController@editar')->name('user.editar');
		Route::post('edit','PageController@edit')->name('user.edit');

		Route::group(['middleware' => 'roles:2'], function () {

			Route::get('confirmar','PageController@confirmar')->name('user.confirmar');
			Route::post('confirm','PageController@confirm')->name('user.confirm');

			Route::get('mail','PageController@mail')->name('user.mail');
		});
	});
	
//Fin User

	Route::group(['middleware' => 'confirmed'], function () {//Route Group Confirmed
		//Proyectos
		Route::get('/proyecto/todo','ProyectController@all')->name('proyecto.all');
//Fin proyectos

//Administracion Redes Sociales
		Route::get('/proyecto/Crear/AdmSN','ProyectController@CrearAdmSN')->name('proyecto.adminSocialNetworks.crear');
		Route::post('/proyecto/create/AdmSN','ProyectController@CreateAdmSN')->name('proyecto.adminSocialNetworks.create');

		Route::get('/proyectoAdmSN/editar/{id}','ProyectController@editarAdmSN')->name('proyecto.adminSocialNetworks.editar');
		Route::post('/proyectoAdmSN/edit/{id}','ProyectController@editAdmSN')->name('proyecto.adminSocialNetworks.edit');
//Fin Administracion Redes Sociales

// Dossier
		Route::get('/proyecto/Crear/dossier','ProyectController@Creardossier')->name('proyecto.dossier.crear');
		Route::post('/proyecto/create/dossier','ProyectController@Createdossier')->name('proyecto.dossier.create');

		Route::get('/proyectoDossier/editar/{id}','ProyectController@editarDossier')->name('proyecto.dossier.editar');
		Route::post('/proyectoDossier/edit/{id}','ProyectController@editDossier')->name('proyecto.dossier.edit');
// Fin Dossier
		Route::get('proyecto/show/{type}/{id}','ProyectController@showType')->name('proyecto.show.type');
	});//Fin route Group Confirmed

//Proyectos
	Route::group(['prefix' => 'proyecto'], function () {//Route Group prefix proyecto

		Route::group(['middleware' => 'roles:0'], function () {//Route Group prefix proyecto para Admins
			Route::get('crear','ProyectController@Crear')->name('proyecto.crear');

			Route::post('createCustom','ProyectController@createCustom')->name('proyecto.custom.crear');

			Route::get('asignar/{type}/{id}','AdminController@asignar')->name('proyecto.asignar');
			Route::post('create','ProyectController@create')->name('proyecto.create');

			Route::get('eliminar/{id}','ProyectController@eliminar')->name('proyecto.eliminar');
			Route::post('delete/{id}','ProyectController@delete')->name('proyecto.delete');

			Route::get('reasignar/{id}','AdminController@reasignar')->name('proyecto.reasignar');
			Route::post('edit/{id}','ProyectController@edit')->name('proyecto.edit');

			Route::get('terminate/{id}','ProyectController@terminate')->name('proyecto.terminate');
		});
		Route::group(['middleware' => 'roles:4'], function () {//Route Group prefix proyecto para admins y devs
			Route::get('show/{id}','ProyectController@show')->name('proyecto.show');
			Route::post('comentar/{id}','ProyectController@comentar')->name('proyecto.comentar');

			Route::get('buscar','ProyectController@buscarProyectos')->name('proyecto.buscar');

			// Route::get('')
		});

	});

	Route::group([
		'prefix' => 'comentario',
		'middleware' =>'roles:4',
					], function () {//Route Group prefix comentarios
		Route::get('editar/{id}','ProyectController@editarComentario')->name('comentario.editar');//Id del comentario
		Route::post('edit/{id}','ProyectController@editComentario')->name('comentario.edit');//Id del comentario
		Route::get('eliminar/{id}','ProyectController@eliminarComentario')->name('comentario.eliminar');//Id del comentario
	});
//Fin Proyectos
});
