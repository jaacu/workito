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

Route::get('/', 'PageController@login');

// Admin rol:0
Route::get('/admin/users','AdminController@users')->middleware(['auth','roles:0']);
Route::get('/editar/{id}','AdminController@editar')->where('id', '[0-9]+')->middleware(['auth','roles:0']);
Route::post('/edit/{id}','AdminController@edit')->where('id', '[0-9]+')->middleware(['auth','roles:0']);
Route::get('/user/{id}','AdminController@user')->where('id', '[0-9]+')->middleware(['auth']);

Route::get('/eliminar/{id}','AdminController@eliminar')->where('id', '[0-9]+')->middleware(['auth','roles:0']);
Route::post('/delete/{id}','AdminController@delete')->where('id', '[0-9]+')->middleware(['auth','roles:0']);

Route::get('/admin/proyectos','AdminController@proyectos')->middleware(['auth','roles:0']);
// Fin admin

//Developers rol:1
Route::get('/dev/proyectos','DeveloperController@proyectos')->middleware(['auth','roles:1']);
Route::get('/dev/proyecto/{id}','DeveloperController@proyecto')->middleware(['auth','roles:4']);

Route::get('/actualizar','DeveloperController@actualizar')->middleware(['auth','roles:1']);
//Fin developers

// User cliente rol 2, desarrolador rol 1, admin rol 0
Route::get('/user/perfil','PageController@perfil')->middleware('auth');

Route::get('/user/editar','PageController@editar')->middleware(['auth','roles:2']);
Route::post('/user/edit','PageController@edit')->middleware(['auth','roles:2']);

Route::get('/user/confirmar','PageController@confirmar')->middleware(['auth','roles:2']);
Route::post('/user/confirm','PageController@confirm')->middleware(['auth','roles:2']);

Route::get('/user/mail','PageController@mail')->middleware(['auth','roles:2']);
//Fin User

//Proyectos
Route::get('/proyecto/todo','ProyectController@all')->middleware(['auth','confirmed']);
//Fin proyectos

//Administracion Redes Sociales
Route::get('/proyecto/Crear/AdmSN','ProyectController@CrearAdmSN')->middleware(['auth','confirmed']);
Route::post('/proyecto/create/AdmSN','ProyectController@CreateAdmSN')->middleware(['auth','confirmed']);

Route::get('/proyectoAdmSN/editar/{id}','ProyectController@editarAdmSN')->middleware(['auth','confirmed']);
Route::post('/proyectoAdmSN/edit/{id}','ProyectController@editAdmSN')->middleware(['auth','confirmed']);
//Fin Administracion Redes Sociales

// Dossier
Route::get('/proyecto/Crear/dossier','ProyectController@Creardossier')->middleware(['auth','confirmed']);
Route::post('/proyecto/create/dossier','ProyectController@Createdossier')->middleware(['auth','confirmed']);

Route::get('/proyectoDossier/editar/{id}','ProyectController@editarDossier')->where('id', '[0-9]+')->middleware(['auth','confirmed']);
Route::post('/proyectoDossier/edit/{id}','ProyectController@editDossier')->where('id', '[0-9]+')->middleware(['auth','confirmed']);
// Fin Dossier

//Proyectos
Route::get('/proyecto/asignar/{type}/{id}','AdminController@asignar')->where(['type' => '[0-9]+','id' => '[0-9]+'])->middleware(['auth','roles:0']);
Route::post('/proyecto/create','ProyectController@create')->middleware(['auth','roles:0']);

Route::get('/proyecto/eliminar/{id}','ProyectController@eliminar')->where(['id' => '[0-9]+'])->middleware(['auth','roles:0']);
Route::post('/proyecto/delete/{id}','ProyectController@delete')->where(['id' => '[0-9]+'])->middleware(['auth','roles:0']);

Route::post('/proyecto/edit/{id}','ProyectController@edit')->middleware(['auth','roles:0']);
Route::get('/proyecto/reasignar/{id}','AdminController@reasignar')->where(['id' => '[0-9]+'])->middleware(['auth','roles:0']);

Route::get('/proyecto/show/{id}','ProyectController@show')->where(['id' => '[0-9]+'])->middleware(['auth','roles:4']);
Route::get('/proyecto/show/{type}/{id}','ProyectController@showType')->where(['id' => '[0-9]+'])->middleware(['auth','roles:0']);

Route::post('/proyecto/comentar/{id}','ProyectController@comentar')->where(['id' => '[0-9]+'])->middleware(['auth','roles:4']);
Route::get('/comentario/editar/{id}','ProyectController@editarComentario')->where(['id' => '[0-9]+'])->middleware(['auth','roles:4']);//Id del comentario
Route::post('/comentario/edit/{id}','ProyectController@editComentario')->where(['id' => '[0-9]+'])->middleware(['auth','roles:4']);//Id del comentario
Route::get('/comentario/eliminar/{id}','ProyectController@eliminarComentario')->where(['id' => '[0-9]+'])->middleware(['auth','roles:4']);//Id del comentario


//Fin Proyectos

Route::get('/home', 'HomeController@index')->name('home');

// 04141797613 alfredo 