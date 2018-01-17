<div class="card col-sm-3 border-0">
	<div class="card-body border-dark @if ( $proyecto->encontrar() ) @if( $proyecto->encontrar()->isTerminado() )  bg-success @else bg-info @endif @else bg-danger @endif m-2 p-3 border  rounded">
		<h5 class="card-title text-center"><a class="text-dark" style="text-decoration: none;" data-toggle="collapse" href="#card{{ $loop->index}}" role="button" aria-expanded="false" aria-controls="card{{ $loop->index}}"><span class=" text-dark">
			@if ( $proyecto->encontrar() )
			{{ $proyecto->encontrar()->nombre }}
			@else
			{{ $proyecto->nombre }}
			@endif
		</span></a> </h5>
		<div class="collapse @if ( $proyecto->encontrar() ) @if( $proyecto->encontrar()->isTerminado() )  bg-success @else bg-info @endif @else bg-danger @endif" id="card{{ $loop->index}}">
			<ul class="list-group list-group-flush">
				@if ( $proyecto->encontrar() )
				<a href="{{ route('proyecto.show', $proyecto->encontrar()->id ) }}" style="display: block; text-decoration: none;">
					<li class="list-group-item bg-light border-0 text-center" style="border-top-left-radius: 60%; ">
						<span class=" text-danger">{{ $proyecto->encontrar()->fecha_limite }}</span>
					</li>
					<li class="list-group-item bg-light border-0 text-center" style="border-bottom-right-radius: 60%">
						<span class="text-dark"> Desarrolladores:</span> <span class="badge badge-pill badge-info"> {{ $proyecto->encontrar()->devs->count() }}</span>
					</li>
				</a>
				@else
				<a href="{{ route('proyecto.show.type', [ $proyecto->getType() , $proyecto->id ] ) }}" style="display: block; text-decoration: none;">
					<li class="list-group-item bg-light border-0 text-center" style="border-top-left-radius: 60%; border-bottom-right-radius: 60%">
						<span class="text-dark"> Por: <strong>{{ $proyecto->user->name}} </strong>.</span>
					</li>
				</a>
				@endif
			</ul>
		</div>
	</div>
</div>