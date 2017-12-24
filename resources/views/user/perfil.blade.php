@extends('layouts.app')

@section('content')
<div>
	{{-- @if( session('success') )
	<div>
		<p style="color: green;">{{session('success')}}</p>
	</div>
	
	@endif --}}
	<h1>Datos del usuario:</h1>
	<p> Nombre: {{  Auth::user()->name }} </p>
	<p> Email: {{ Auth::user()->email }} </p>
	<p> NIF: {{ Auth::user()->NIF}} </p>
	<p> Contacto: {{ Auth::user()->contacto }} </p>
	<p> Cuenta de Skype: {{ Auth::user()->cuentaSkype }} </p>
	@if( Auth::user()->isConfirmed() )
	<p>Firma Digital: {{Auth::user()->digital_sign}} </p>
	@else
	<p style="color: red;">No ha confirmado verificado todavia su cuenta, confirmela <a href="/user/confirmar">ahora</a>. </p>
	@endif
	<a href="/user/editar">Editar datos.</a>
</div>

@endsection