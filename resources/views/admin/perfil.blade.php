@extends('layouts.app')

@section('content')
<div>
	@if( session('success') )
	<div>
		<p style="color: green;">{{session('success')}}</p>
	</div>
	
	@endif
	<h1>Datos del Admin:</h1>
	<p> Nombre: {{  Auth::user()->name }} </p>
	<p> Email: {{ Auth::user()->email }} </p>
</div>

@endsection