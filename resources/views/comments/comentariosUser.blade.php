<div class="col-sm-12 my-3">
	@forelse( $user->comments as $comment )
	@if( $loop->first)
	<div class="row">
		<div class="card-body border m-2 p-3">
			<div class="col-sm-12 my-3">
				<h3 class="card-title"><a class="text-info" style="text-decoration: none;" data-toggle="collapse" href="#cardcomentarios" role="button" aria-expanded="false" aria-controls="cardcomentarios"><span class="">
					Comentarios hechos por este usuario:
				</span></a> </h3>
			</div>
			<div class="collapse" id="cardcomentarios">
				<div id="accordion2" role="tablist">
					@endif
					<div class="card">
						<div class="card-header" role="tab" id="2heading{{$loop->index}}">
							<h5 class="mb-0">
								<small class="mx-3 text-secondary text-muted">
									{{ $comment->forHumansCreado() }}
								</small>
								<a class="collapsed mr-5 text-dark" data-toggle="collapse" href="#2collapse{{$loop->index}}" role="button" aria-expanded="false" aria-controls="2collapse{{$loop->index}}">
									En "<span class="text-capitalize text-success">{{ $comment->proyect->nombre}}</span>"
								</a>
							</h5>
						</div>
						<div id="2collapse{{$loop->index}}" class="collapse" role="tabpanel" aria-labelledby="2heading{{$loop->index}}" data-parent="#accordion2">
							<a href="{{ route('dev.proyecto', $comment->proyect->id) }}" style="display: block; text-decoration: none;">
								<div class="card-body p-2">
									<div class="text-center">
										@if( $comment->isEditado() )
										<small class="text-muted">Editado {{ $comment->forHumansEditado() }}</small>
										@endif
										<h4 class="text-dark">
											{{$comment->texto}}
										</h4>
									</div>
								</div>
							</a>
						</div>
					</div>
					@if ($loop->last)
				</div>
			</div>
		</div>
		@endif
		@empty
		<div class="row my-3">
			<div class="col-sm-12 alert alert-warning">
				<h3 class="alert-heading text-center">Este usuario aun no ha hecho ningun comentario!</h3>
				<p class="text-center">Aqui apareceran los comentarios creados por este usuario cuando tenga alguno.</p>
			</div>
		</div>
		@endforelse
	</div>
</div>