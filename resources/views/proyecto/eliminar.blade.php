@extends('layouts.app')

@section('content')
<div class="container">
	@include('debug')
	<div class="row my-2">
		<div class="col-sm-12">
			<div class="alert alert-danger">
				<h3 class="alert-heading">Esta apunto de eliminar el siguiente proyecto: "<strong>{{ $proyecto->nombre }}</strong>".</h3>
				<hr>
				<p>Esta completamente seguro de que desea eliminarlo? Se perderan todos los datos guardados relacionados a este proyecto incluyendo el tiempo trabajado de los desarrolladores y comentarios.</p>
			</div>	
		</div>
		<div class="col-sm-12 my-3">
			<form action="/proyecto/delete/{{$proyecto->id}}" method="POST">
				{{ csrf_field() }}
				<div class="form-row">
					<div class="col-sm-12 text-center">
						<div class="form-check">
							<label class="form-check-label" for="aceptar"><h5>Estoy seguro y deseo borrarlo de todas formas.</h5></label><input id="aceptar" name="aceptar" class="ml-3 form-check-input" type="checkbox" required value="true">
						</div>
					</div>
				</div>
				<div class="form-row my-2">
					<div class="col-sm-12 text-center">
						<button class="btn-danger btn btn-lg" type="submit">Eliminar.</button>
					</div>
				</div>
			</form>
			
		</div>
	</div>

</div>

@endsection