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
			<p class=""> Contacto: <strong class="text-dark">{{ $user->contacto }}</strong> </p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> Cuenta de Skype: <strong class="text-dark">{{ $user->cuentaSkype }}</strong></p>
		</div>
		<div class="col-sm-6 text-center">
			<p class=""> Estado: <strong class="text-success">Desarrollador</strong></p>
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
<div class="col-sm-12">
	@forelse( $user->devs as $dev )
	@if( $loop->first)
	<div class="row">
		<div class="card-body border m-2 p-3">
			<div class="col-sm-12 my-3">
				<h3 class="card-title"><a class="text-info" style="text-decoration: none;" data-toggle="collapse" href="#cardproyectos" role="button" aria-expanded="false" aria-controls="cardproyectos"><span class="">
					Proyectos en los que esta trabajando:
				</span></a> </h3>
			</div>
			<div class="collapse" id="cardproyectos">
				<div id="accordion1" role="tablist">
					@endif
					<div class="card">
						<div class="card-header" role="tab" id="heading{{$loop->index}}">
							<h5 class="mb-0">
								<small class="mx-3 text-secondary text-muted">
									{{ $dev->proyect->forHumansCreado()}}
								</small>
								<a class="collapsed mr-5 text-dark" data-toggle="collapse" href="#collapse{{$loop->index}}" role="button" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
									{{$dev->proyect->nombre}}
								</a>
							</h5>
						</div>
						<div id="collapse{{$loop->index}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion1">
							<a href="{{ route('proyecto.show', $dev->proyect->id) }}" style="display: block; text-decoration: none;">
								<div class="card-body">
									@if($dev->proyect->isTerminado())
									<div class="alert alert-success  w-50 mx-auto">
										<h5 class="text-center alert-heading">Proyecto Terminado</h5>
									</div>
									@else
									<div class="alert alert-info w-50 mx-auto">
										<h5 class="text-center alert-heading">Proyecto En Desarrollo</h5>
									</div>
									@endif
									<div class="text-center">
										<small class="text-danger">
											Fecha limite <br> {{ $dev->proyect->fecha_limite }}
										</small>
									</div>
									<h4 class="text-dark text-center">
										Trabajado
									</h4>
									@include('dev.trabajado')
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
				<h3 class="alert-heading text-center">Este usuario aun no ha sido asignado a un proyecto!</h3>
				<p class="text-center">Aqui apareceran los proyectos que tenga asignado este asignado este usuario cuando tenga alguno.</p>
			</div>
		</div>
		@endforelse
	</div>
</div>
@include('comments.comentariosUser')