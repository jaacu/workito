@extends('layouts.app')

@section('content')
<div class="container mt-3">
	{{-- {{ dd($data) }} --}}
	@forelse( $data as  $item)
	@if( $loop->first)
	@include('debug')
	<div class="row mt-2">
		<div class="col-sm-6">
			<h1 class=" ml-3 text-center">Resultados </h1>
		</div>
		<div class="col-sm-6 text-center">
			<a href="{{$url}}" class="btn btn-outline-dark center-block btn-lg  ">Volver</a>
		</div>
	</div>
	<hr class="mt-2 mb-2">
	<div class="row clearfix">
		@endif
		@includeWhen( ($item instanceof App\Proyect)  ,'proyecto.proyectoMIN', [ 'proyecto' => $item->encontrar()])
		@includeWhen( ($item instanceof App\Dossier or $item instanceof App\adminSocialNetwork )  ,'proyecto.proyectoMIN', [ 'proyecto' => $item])
		@includeWhen( ($item instanceof App\User)  ,'user.userMIN', [ 'user' => $item])
		@includeWhen( ($item instanceof App\Dev)  ,'dev.proyectDevMIN', [ 'dev' => $item])
		@if($loop->last)
	</div>
	@endif
	@empty
	<div class="row my-5">
		<div class="col-sm-12 alert alert-warning">
			<h3 class="alert-heading">No se ha encontrado ningun resultado, cambio la busqueda e intentalo de nuevo!</h3>
		</div>
		<div class="col-sm-12 text-center my-5">
			<a href="{{$url}}" class="btn btn-outline-dark center-block btn-lg  ">Volver</a>
		</div>
	</div>
	@endforelse
</div>
@endsection