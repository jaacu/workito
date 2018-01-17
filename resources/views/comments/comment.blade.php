<div class="col-sm-12">
	<div class="border w-70 mx-auto p-2 m-2 rounded">
		
		@if ( Auth::user()->isAdmin() )
		<small class="text-muted"><a href="{{ route('user', $comment->user->id ) }}" style="text-decoration: none;" class=""><span class="text-{{$comment->user->getRoleColor()}}">{{ $comment->user->name }}</span></a> dijo...</small>
		@else
		<small class="text-muted"><span class="text-{{$comment->user->getRoleColor()}}">{{ $comment->user->name }}</span> dijo...</small> 
		@endif

		<p class="mb-0">{{ $comment->texto }}</p>
		<small class="text-muted"> Comentado {{$comment->forHumansCreado() }}. </small>
		@if( $comment->isEditado() )
		<br><small class="text-muted">Editado {{ $comment->forHumansEditado() }}</small>
		@endif
		<br>
		@unless( $comment->proyect->isTerminado())
		@if(Auth::user()->id === $comment->user->id)
		<a href="{{ route('comentario.editar', $comment->id) }}" class="btn-info btn">Editar</a>
		@endif
		@if( Auth::user()->id === $comment->user->id or Auth::user()->isAdmin() )
		<a href="{{ route('comentario.eliminar', $comment->id) }}" class="btn-danger btn" >Eliminar</a>
		@endif
		@endunless
	</div>
</div>