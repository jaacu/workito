@extends('layouts.app')

@section('content')
<div>
	<h1>Datos del usuario:</h1>
	@if( $errors->any())
	@foreach( $errors->all() as  $error)
	<p>{{$error}}</p>
	@endforeach
	@endif
	<form action="/user/edit" method="post">
		{{csrf_field()}}
		<p> Nombre: </p>
		<input type="text" name="name" required="required" value="{{  Auth::user()->name }}">
		<p> Email: </p>
		<input type="email" name="email" required="required" value="{{ Auth::user()->email }}">
		<p> NIF: </p>
		<input type="text" name="NIF" required="required" value="{{ Auth::user()->NIF}}">
		<p> Contacto: </p>
		<input type="text" name="contacto" required="required" value="{{ Auth::user()->contacto }}">
		<p> Cuenta de Skype: </p>
		<input type="text" name="cuentaSkype" required="required" value="{{ Auth::user()->cuentaSkype }}">
		<input type="submit" value="Guardar cambios.">
	</form>
</div>

@endsection