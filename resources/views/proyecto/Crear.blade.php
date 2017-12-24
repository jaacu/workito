@extends('layouts.app')

@section('content')

<div>
	<form action="/proyecto/create" method="POST">
		<div class="form-group">
			<p>Nombre: </p>
			<input type="text" name="nombre" class="form-control" required="required">
			<p>Tiempo estimado del proyecto: </p>
			<input type="time" name="tiempo" class="form-control">
			{{csrf_field()}}
			<input type="submit" value="Enviar" >
			@if($errors->any())
			@foreach($errors->get('nombre') as $error)
			<div>{{$error}}</div>
			@endforeach
			@endif
		</div>

	</form>
</div>
@endsection