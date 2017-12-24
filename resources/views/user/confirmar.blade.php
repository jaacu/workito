@extends('layouts.app')

@section('content')
<div>
	@if( $errors->any())
	@foreach( $errors->all() as $error)
	<div style="color: red;">{{$error}}</div>
	@endforeach
	@endif
	<h1>Firma los terminos y condiciones con la firma digital enviada tu correo para confirmar tu cuenta</h1>
	<form action="/user/confirm" method="post">
		<p>Terminos y condiciones blah blah <br><br><br><br></p>
		<input type="text" name="digital_sign" class="form-control" required="required" autofocus="autofocus">
		{{ csrf_field()}}
		<input type="submit" value="Guardar">
	</form>
</div>

@endsection