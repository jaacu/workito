@extends('layouts.app')

@section('content')
<div class="container">
	@forelse( $proyectos as $proyecto )
	@if($loop->first)
	<div class="row">
		<div class="col-sm-6">
			<h3 class="text-dark text-center">Proyectos</h3>
		</div>
		<div class="col-sm-6">
			@include('searchBar', ['action' =>route('proyecto.buscar')])
		</div>
	</div>
	<div class="row my-4">
		@endif
		@include('proyecto.proyectoMIN')
		@if($loop->last)
	</div>
	@endif
	@empty
	<div class="row mt-4">
		<div class="col-sm-12 alert alert-warning">
			<h4 class="alert-heading">Parece que no hay ningun proyecto!</h4>
			<hr>
			<a href="{{ route('proyecto.crear') }}" class="btn btn-primary">Crear un nuevo proyecto ahora.</a>
		</div>
	</div>
	@endforelse
</div>
@endsection