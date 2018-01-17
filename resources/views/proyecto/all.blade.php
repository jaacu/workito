@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-2">
		@forelse( Auth::user()->getProyects() as $proyecto)
		@if( $loop->first )
		<div class="col-sm-12">
			<h3 class="text-dark text-center">Proyectos</h3>
		</div>
		@endif
		<div class="card col-sm-4 border-0">
			<div class="card-body border-dark m-2 p-3 border rounded bg-light">
				<h5 class="card-title text-center"><a class="text-dark" style="text-decoration: none;" data-toggle="collapse" href="#card{{ $loop->index}}" role="button" aria-expanded="false" aria-controls="card{{ $loop->index}}"><span class=" text-dark">
					{{ $proyecto->nombre }}
				</span></a> </h5>
				<div class="collapse bg-primary" id="card{{ $loop->index}}">
					<ul class="list-group list-group-flush">
						<a href="{{ route('proyecto.show.type', [ $proyecto->getType() , $proyecto->id] ) }}" style="display: block; text-decoration: none;">
							<li class="list-group-item bg-light border-0 text-center" style="border-top-left-radius: 60%; ">
								<span class=" text-capitalize text-info">{{ $proyecto->getTypeString() }}</span>
							</li>
							<li class="list-group-item bg-light border-0 text-center" style="border-bottom-right-radius: 60%">
								<small class="text-muted text-capitalize">Creado {{ $proyecto->forHumansCreado() }}</small>
							</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
		@empty
		<div class="col-sm-12 my-2 alert alert-warning text-center">
			<h3 class="alert-heading text-capitalize">
				Aun no has creado ningun proyecto.
			</h3>
			<h6 class="">Una vez crees proyectos podras verlos aqui!</h6>
			<p class="">Desde la pagina principal podras crear nuevos proyectos</p>
			<a href="{{ route('home') }}" class="alert-link ">Volver a la pagina principal</a>
			<hr>
		</div>

		@endforelse
	</div>
</div>
@endsection