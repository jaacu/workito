<div class="row my-2">
	<div class="col-sm-12">
		<h3 class="text-primary text-center my-2"> Notificaciones Totales {{Auth::user()->notifications->count()}} </h3>
	</div>
</div>

<div class="row my-4">
	@if( Auth::user()->notifications->count() )
	<div class="col-sm-6">
		<h4 class="text-center text-dark">Notificaciones No leidas</h4>
		@forelse( Auth::user()->unreadNotifications as $notification )
		@if( $loop->first)
		<div class="col-sm-6 mx-auto">
			{{-- ARREGLAR ESTO LUEGO --}}
			<a  href="{{ route('user.notifications.leer')}}" class="btn btn-success">Marcar todas las notificaciones como leidas</a>
		</div> 	 		
		<div class="row ">
			<div class="row w-100">
				@endif
				@if($loop->index % 2 == 0)
				@endif
				<div class="col-sm-6 p-0 h-100">
					<div class="my-2 h-99" style="height: 100px;">
						<div class="card mx-2 my-2 rounded border h-100 border-secondary" >
							<a href="{{ $notification->data['ruta'] }}" style="display: block; text-decoration: none;">
								<div class="card-body mb-0 pb-0">
									<p class="text-dark text-justify">{{ $notification->data['mensaje'] }}</p>
								</div>
							</a>
							{{-- <div class="mx-auto my-auto">
								<a href="" class="btn btn-success">Marcar como leida</a>
							</div> --}}
						</div>
					</div>
				</div>
				@if($loop->iteration % 2 == 0)
			</div>
			<div class="row w-100">
				@endif
				@if($loop->last)
			</div>
		</div>
		@endif
		@empty
		<div class=" alert alert-success">
			<h1 class="alert-heading">
				No tienes notificaciones sin leer!
			</h1>
		</div>
		@endforelse
	</div>

	<div class="col-sm-6">
		<h4 class="text-center text-dark">Notificaciones Leidas</h4>
		@forelse( Auth::user()->readNotifications as $notification )
		@if( $loop->first)
		<div class="col-sm-6 mx-auto">
			{{-- ARREGLAR ESTO LUEGO --}}
			<a  href="{{ route('user.notifications.eliminar')}}" class="btn btn-danger">Eliminar todas las notificaciones leidas</a>
		</div> 	 
		<div class="row ">
			<div class="row w-100">
				@endif
				@if($loop->index % 2 == 0)
				@endif
				<div class="col-sm-6 p-0 h-100">
					<div class="my-2 h-99" style="height: 100px;">
						<div class="card mx-2 my-2 rounded border h-100 border-secondary" >
							<a href="{{ $notification->data['ruta'] }}" style="display: block; text-decoration: none;">
								<div class="card-body mb-0 pb-0">
									<p class="text-dark text-justify">{{ $notification->data['mensaje'] }}</p>
								</div>
							</a>
							{{-- <div class="mx-auto my-auto">
								<a href="#" class="btn btn-success">Borrar notificacion.</a>
							</div> --}}
						</div>
					</div>
				</div>
				@if($loop->iteration % 2 == 0)
			</div>
			<div class="row w-100">
				@endif
				@if($loop->last)
			</div>
		</div>
		@endif
		@empty
		<div class=" mt-5 alert alert-secondary">
			<h1 class="alert-heading">
				No has marcado ninguna notificacion como leida.
			</h1>
		</div>
		@endforelse
	</div>
	@else
	<div class="col-sm-12 ">
		<div class=" mx-auto mt-5 alert alert-info text-center">
			<h3 class="alert-heading">
				Parece que aun no tienes notificaciones.
			</h3>
			<p> Cuando tengas notificaciones se mostraran aqui!</p>
		</div>
	</div>
	@endif 
</div>