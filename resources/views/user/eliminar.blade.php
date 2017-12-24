@extends('layouts.app')

@section('content')
<div>
	@include('debug')
	<p>Esta apunto de eliminar el siguiente usuario: "{{ $user->name }}".</p>
	@includeWhen( $user->isClient() ,'user.client',[])
	@includeWhen( $user->isDeveloper() ,'user.dev',[])
	<p>Esta completamente seguro de que desea eliminarlo? Se perderan todos los datos guardados relacionados a este usuario incluyendo proyectos y comentarios.</p>
	<form action="/delete/{{$user->id}}" method="POST">
		{{ csrf_field() }}
		<p style="border: red dashed 0.4px">Estoy seguro y deseo borrarlo de todas formas. <input name="aceptar" class="" type="checkbox" required="required" value="true"></p> <br>
		<input class="btn-danger btn" type="submit" value="Borrar.">
	</form>
</div>

@endsection