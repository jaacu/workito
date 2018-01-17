<div class="card col-sm-6 border-0">
	<div class="card-body border-dark @if( $dev->proyect->isTerminado() )  bg-success @else bg-info @endif m-2 p-3 border  rounded">
		<h5 class="card-title text-center"><a class="text-dark" style="text-decoration: none;" data-toggle="collapse" href="#card{{ $loop->index}}" role="button" aria-expanded="false" aria-controls="card{{ $loop->index}}"><span class=" text-dark">
			{{ $dev->proyect->nombre }}
		</span></a> </h5>
		<div class="collapse @if( $dev->proyect->isTerminado() )  bg-success @else bg-info @endif" id="card{{ $loop->index}}">
			<ul class="list-group list-group-flush">
				<a href="{{ route('proyecto.show', $dev->proyect->id ) }}" style="display: block; text-decoration: none;">
					<li class="list-group-item bg-light border-0 text-center" style="border-top-left-radius: 60%; ">
						<span class=" text-danger">{{ $dev->proyect->fecha_limite }}</span>
					</li>
					<li class="list-group-item bg-light border-0 text-center" style=";">
						@include('dev.trabajado')
					</li>
					<li class="list-group-item bg-light border-0 text-center" style="border-bottom-right-radius: 60%;">
					</li>
				</a>
			</ul>
		</div>
	</div>
</div>