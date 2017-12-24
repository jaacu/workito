@extends('layouts.app')

@section('content')

<div>
	<h1>Crear Nuevo Proyecto De Administracion De Redes Sociales</h1>
	<form action="/proyecto/create/AdmSN" method="POST">
		<div class="form-group">
			@if( $errors->has('facebook')  and $errors->has('twitter') and $errors->has('instagram') )
			<div style="color: red;">Por favor seleccione al menos una red social.</div>
			@endif
			<p>Nombre de la empresa o persona: </p>
			<input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" autofocus="autofocus" >
			@if( $errors->has('nombre') )
			@foreach($errors->get('nombre') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			<p>Facebook: </p>
			<input type="checkbox" name="facebook" class="form-control" value="true">
			<p>Facebook Permisos de Compra: </p>
			<input type="text" name="fbPermisosCompra" class="form-control" value="{{ old('fbPermisosCompra') }}">
			@if( $errors->has('fbPermisosCompra') )
			@foreach($errors->get('fbPermisosCompra') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			<p>twitter: </p>
			<input type="checkbox" name="twitter" class="form-control" value="true">
			<p>Email de Twitter: </p>
			<input type="email" name="twEmail" class="form-control" value="{{ old('twEmail') }}">
			@if( $errors->has('twEmail') )
			@foreach($errors->get('twEmail') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			<p>Password de Twitter: </p>
			<input type="text" name="twPassword" class="form-control" value="{{ old('twPassword') }}">
			@if( $errors->has('twPassword') )
			@foreach($errors->get('twPassword') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			<p>Instagram: </p>
			<input type="checkbox" name="instagram" class="form-control" value="true">
			<p>Email de Instagram: </p>
			<input type="email" name="instEmail" class="form-control" value="{{ old('instEmail') }}">
			@if( $errors->has('instEmail') )
			@foreach($errors->get('instEmail') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			<p>Password de Instagram: </p>
			<input type="text" name="instPassword" class="form-control" value="{{ old('instPassword') }}">
			@if( $errors->has('instPassword') )
			@foreach($errors->get('instPassword') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			{{csrf_field()}}
			<input type="submit" value="Guardar" >
		</div>

	</form>
</div>
@endsection