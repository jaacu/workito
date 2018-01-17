@extends('layouts.app')

@section('content')
<div class="container">
	@include('debug')
	<div class="row my-2">
		<div class="col-sm-12 text-center">
			<h3>Comentario hecho en el proyecto: "{{ $comment->proyect->nombre }}"</h3>
		</div>
		<div class="col-sm-12 text-center my-5">
			<h5 class="">Creado: {{ $comment->forHumansCreado() }}</h5>
			@if( $comment->isEditado() )
			<br><h5 class="">Ultima vez editado: {{ $comment->forHumansEditado() }}</h5>
			@endif		
		</div>
		<div class="col-sm-6 my-3 p-2 mx-auto">
			<form action="{{ route('comentario.edit', $comment->id) }}" method="post">
				{{ csrf_field() }}
				<div class="form-row">
					<div class="col-sm-12">
						<div>
							<textarea class="form-control" name="texto" id="texto" cols="50" rows="3" placeholder="Comentario editado" autofocus="autofocus" required="required">{{ $comment->texto}}</textarea><br>
							
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-sm-12 text-center">
						<button type="submit" class="btn btn-success">Guardar Cambios.</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection