@extends('layouts.app')

@section('content')
<div>
	@include('debug')
	<p>Esta apunto de eliminar el siguiente proyecto: "{{ $proyecto->nombre }}".</p>
	@include('proyecto.proyectoMIN',[ 'del' => true])
	<p>Esta completamente seguro de que desea eliminarlo? Se perderan todos los datos guardados relacionados a este proyecto incluyendo el tiempo trabajado de los desarrolladores y comentarios.</p>
	<form action="/proyecto/delete/{{$proyecto->id}}" method="POST">
		{{ csrf_field() }}
		<p style="border: red dashed 0.4px">Estoy seguro y deseo borrarlo de todas formas. <input name="aceptar" class="" type="checkbox" required="required" value="true"></p> <br>
		<input class="btn-danger btn" type="submit" value="Borrar.">
	</form>
</div>

@endsection