@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-2">
		<div class="col-sm-12">
			@unless( isset($type) )
			@include('proyecto.proyecto')
			@endunless

			@isset( $type )
			@include($view)
			@if ( Auth::user()->isAdmin() )
			<div class="row my-5">
				<div class="col-sm-6 text-center">
					<h3><a class="btn btn-outline-primary btn-lg w-20" href=" {{ route('user', $proyecto->user->id ) }}">{{ $proyecto->user->name}} </a></h3>
				</div>
				@if( $proyecto->encontrar() )
				<div class="col-sm-6 text-center">
					<a href="{{ route('proyecto.show', $proyecto->encontrar()->id ) }}" class="btn btn-primary btn-lg">Ver proyecto en desarrollo.</a>
					@else
					<a href="{{ route('proyecto.asignar', [ $proyecto->getType() , $proyecto->id] ) }}" class="btn btn-secondary btn-lg">Asignar proyecto.</a>
				</div>
				@endif
			</div>
			@endif
			@endisset
		</div>
	</div>
</div>
@endsection