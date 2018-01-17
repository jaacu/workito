@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12 my-3">
			<div class="alert alert-danger">
				<h3 class="alert-heading">
					<strong>Advertencia!</strong>
				</h3>
				<h6>
					Al momento de eliminar este usuario tenga en cuenta que se perderan todos los datos de proyectos y comentarios relacionados con este usuario. 
				</h6>
				@include('user.conteoMIN')
				<h4><strong>Todos estos datos se perdaran.</strong></h4>
			</div>
			@include('debug')
			<div class="row">
				<div class="col-sm-8 mx-auto">
					<h5>Esta apunto de eliminar el siguiente usuario: <strong class="text-dark">"{{ $user->name }}"</strong>.</h5>
					<p>Esta completamente seguro de que desea eliminarlo? Se perderan todos los datos guardados relacionados a este usuario incluyendo proyectos y comentarios.</p>
				</div>
				<div class="col-sm-8 mx-auto my-2">
					<form action="{{ route('user.delete.admin', $user->id) }}" method="POST">
						{{ csrf_field() }}
						<div class="form-row">
							<div class="col-sm-12  border border-secondary bg-light p-2">
								<div class="form-check mx-auto">
									<input name="aceptar" class="form-check-input mx-auto" type="checkbox" required value="1">
									<h5><label for="aceptar" class=" form-check-label mx-auto text-danger">Estoy seguro y deseo borrarlo de todas formas.</label></h5>
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-6 mt-4 ">
								<button class="btn-danger btn btn-lg" type="submit"> 
									Eliminar.
								</button>
							</div>
							<div class="col-sm-6 mt-4">
								<a href="{{ route('user', $user->id) }}" class="btn btn-dark">Volver al perfil.</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection