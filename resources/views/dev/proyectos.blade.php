@extends('layouts.app')

@section('content')

<div class="container">
	@forelse( $devs as  $dev)
	@if( $loop->first)
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
		@include('dev.proyectDevMIN')
		@if($loop->last)
	</div>
	@endif
	@empty
	<div>
		Parece que no tienes ningun proyecto asignado :(
	</div>
	@endforelse
</div>
@endsection