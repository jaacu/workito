<div class="col-sm-3"></div>
<div class="col-sm-6">
	<div class="row border border-secondary rounded p-2">
		<div class="col-sm-6 text-center">
			<p class=""> <strong class="text-dark">{{  $user->name }}</strong> </p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> <strong class="text-dark">{{ $user->email }}</strong> </p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> NIF: <strong class="text-dark">{{ $user->NIF}}</strong> </p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> Contacto: <strong class="text-dark">{{ $user->contacto }}</strong> </p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> Cuenta de Skype: <strong class="text-dark">{{ $user->cuentaSkype }}</strong></p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> Estado: <strong class="text-success">Cliente</strong></p>
		</div>
		<div class="col-sm-12">
			@if( $user->confirmed )
			<p>Firma Digital: <strong class="text-dark">{{$user->digital_sign}}</strong></p>
			@else
			<div class="alert alert-danger" role="alert">
				<h5 class="alert-heading ml-2">Este usuario aun no ha verificado su cuenta!</h5>
			</div>
			@endif
		</div>
	</div>
	<div class="row my-2 ml-4">
		<div class="col-sm-6 my-2 p-2 text-center">
			<a class="btn btn-outline-info" href="{{ route('user.editar.admin', $user->id) }}">Editar.</a>
		</div>
		<div class="col-sm-6 my-2 p-2 text-center">
			<a href="{{ route('user.eliminar.admin', $user->id) }}" class="btn btn-outline-danger">Eliminar.</a>
		</div>		
	</div>
	<div class="col-sm-3"></div>
</div>
<div class="col-sm-12 mb-5">
	<div class="col-sm-12">
		@if( $user->hasProyects() )
		<div class="row">
			<div class="col-sm-12 text-info">
				<h3>Proyectos creados por este usuario:</h3>
			</div>
			<div class="col-sm-12">
				@foreach( $user->getProyects() as $proyecto)
				@if ($loop->first)
				<div id="accordion1" role="tablist">
					@endif			
					<div class="card">
						<div class="card-header" role="tab" id="heading{{$loop->index}}">
							<h5 class="mb-0">
								<small class="mx-3 text-secondary text-muted">
									@if( $proyecto instanceof App\Dossier )
									Dossier
									@endif
									@if( $proyecto instanceof App\adminSocialNetwork )
									Administracion De Redes Sociales
									@endif
								</small>
								<a class="collapsed mr-5 text-dark" data-toggle="collapse" href="#collapse{{$loop->index}}" role="button" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
									{{$proyecto->nombre}}
								</a>
								@if( $proyecto->encontrar() )
								<a href="{{ route('proyecto.show',$proyecto->encontrar()->id ) }}" 
									class="btn btn-outline-primary ml-4">
									@if($proyecto->encontrar()->isTerminado() ) Proyecto Terminado @else Proyecto en desarrollo. @endif</a>
									@else
									<a href="{{ route('proyecto.asignar',[$proyecto->getType(),$proyecto->id ]) }}" class="btn btn-outline-primary ml-4">Asignar proyecto.</a>
									@endif
								</h5>
							</div>
							<div id="collapse{{$loop->index}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion1">
								<div class="card-body">
									@includeWhen( ($proyecto instanceof App\Dossier)  ,'proyecto.proyectoDossier')
									@includeWhen( ($proyecto instanceof App\adminSocialNetwork)  ,'proyecto.proyectoAdmSN')
									{{-- @include('proyecto.proyectoAdmSN') --}}
								</div>
							</div>
						</div>
						@if ($loop->last)
					</div>
					@endif
					@endforeach
				</div>
			</div>
			@else
			<div class="row my-3">
				<div class="col-sm-12 alert alert-warning">
					<h3 class="alert-heading text-center">Este usuario aun no ha creado ningun proyecto!</h3>
					<p class="text-center">Aqui apareceran los proyectos de este usuario cuando tenga alguno.</p>
				</div>
			</div>
			@endif
		</div>
	</div>
	<br> <br> <br>