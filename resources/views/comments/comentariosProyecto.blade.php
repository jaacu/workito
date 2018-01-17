<div class="row my-2">
	@forelse( $proyecto->comments as $comment)
	@if( $loop->first )
	<div class="col-sm-12">
		<h3 class="text-center">Comentarios: </h3>
		@endif
		@include('comments.comment')
		@if($loop->last)
	</div>
	@endif
	@empty
	<div class="col-sm-12">
		<div class="alert alert-info p-2">
			<h4 class="alert-heading text-center">No hay comentarios en este proyecto</h4>
		</div>
	</div>
	@endforelse
</div>