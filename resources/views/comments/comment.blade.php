<div>
	<p> {{ $comment->texto }} </p>
	<p> Hecho por: {{ $comment->user->name }} 
		@if( $comment->user->role == 0 ) <span style="color: blue;">Admin</span> @endif
		@if( $comment->user->role == 1 ) <span style="color: green;">Developer</span> @endif 
	</p>
	<small> Comentado {{$comment->forHumansCreado() }}. </small>
	@if( $comment->isEditado() )
	<br><small>Editado {{ $comment->forHumansEditado() }}</small>
	@endif
	<br>
	@if(Auth::user()->id === $comment->user->id)
	<a href="/comentario/editar/{{$comment->id}}" class="btn-info btn">Editar.</a>
	@endif
	@if( Auth::user()->id === $comment->user->id or Auth::user()->isAdmin() )
	<a href="/comentario/eliminar/{{$comment->id}}" class="btn-danger btn" >Eliminar</a>
	@endif
</div>