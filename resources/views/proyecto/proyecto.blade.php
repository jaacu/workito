<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center text-dark my-3">
			<h3 class="text-info"> {{ $proyecto->nombre }} </h3>
		</div>
		<div class="col-sm-6 text-center my-3">
			<h6>Creado por: @if (Auth::user()->isAdmin() ) <a href="{{ route('user', $proyecto->user->id) }}" class="btn btn-primary btn-sm"> {{ $proyecto->user->name }}</a> 
				@else <span class="text-{{ $proyecto->user->getRoleColor() }}">{{$proyecto->user->name}}</span>
				@endif {{ $proyecto->forHumansCreado() }}.</h6>
			</div>
			<div class="col-sm-6 text-center my-3">
				<strong>Id: <span class="badge badge-info">{{ $proyecto->id }}</span></strong>
			</div>
			<div class="col-sm-6 text-center my-2 align-self-center">
				<p>Limite: <strong>{{$proyecto->fecha_limite}}</strong></p>
			</div>
			@if( $proyecto->isEditado() and !$proyecto->isTerminado() )
			<div class="col-sm-6 text-center-my-2">	
				<p>Ultima vez que fue modificado: <strong>{{ $proyecto->forHumansEditado() }}</strong></p>
			</div>
			@endif
			<div class="col-sm-6 text-center my-2 ">
				@if( $proyecto->isTerminado() )
				@if(Auth::user()->isAdmin())
				<a href="{{ route('proyecto.terminate', $proyecto->id) }}" class="btn btn-success">Poner proyecto en desarrollo.</a>
				@endif
				<h6><span class="text-success">Terminado</span> {{ $proyecto->forHumansEditado()}}</h6>
				@else	
				@if( Auth::user()->isAdmin())
				<div class="btn-group" role="group">
					<a class="btn btn-outline-secondary" href="{{ route('proyecto.reasignar', $proyecto->id) }}">Editar</a>
					<a class="btn btn-danger" href="{{ route('proyecto.eliminar', $proyecto->id) }}">Eliminar</a>
					<a class="btn btn-success" href="{{ route('proyecto.terminate', $proyecto->id) }}" >Terminar</a>
				</div>
				@endif
				@endif
			</div>
			@if( $proyecto->isTerminado() )
			<div class="col-sm-12 text-center alert alert-success">
				<h3 class="alert-heading">Este proyecto ya ha sido terminado!</h3>
			</div>
			@endif
			@if(Auth::user()->isDeveloper() and $proyecto->actualDev() )
			<div class="col-sm-12 my-3 p-2">
				<div class="mx-auto w-50">
					<h4 class="text-info text-center"> Trabajado </h4>
					@include('dev.trabajado', ['dev' => $proyecto->actualDev()] )
				</div>
			</div>
			@endif
			@forelse( $proyecto->devs as $dev)
			@if( $loop->first)
			<div class="col-sm-12 text-center my-2">
				<h4>Desarrolladores en este proyecto:</h4>
			</div>
			<div class="col-sm-12">
				<div class="row">
					@endif
					@if( Auth::user()->isAdmin() )
					<div class="col-sm-6">
						<div class="card-body border m-2 p-3">
							<h5 class="card-title text-center"><a class="text-dark" style="text-decoration: none;" data-toggle="collapse" href="#card{{ $loop->index}}" role="button" aria-expanded="false" aria-controls="card{{ $loop->index}}"><span class=" text-dark">
								{{ $dev->user->name}}
							</span></a> </h5>
							<div class="collapse" id="card{{ $loop->index}}">
								<a href="{{ route('user' , $dev->user->id) }}" style="text-decoration: none; display: block;">
									<p class="text-dark text-center">Trabajado<br> @include('dev.trabajado')</p>
								</a>
							</div>
						</div>
					</div>
					@else
					<div class="col-sm-4">
						<div class=" rounded border p-3 m-2 ">
							<h6 class="text-dark text-center"> {{ $dev->user->name}}</h6>
						</div>
					</div>
					@endif
					@if( $loop->last)
				</div>
			</div>
			@endif
			@empty
			<p>No hay desarrolladores asignados a este proyecto. <a href="/proyecto/reasignar/{{ $proyecto->id }}">Asignar ahora.</a></p>
			@endforelse
			@if ( Auth::user()->isAdmin() and $proyecto->isTerminado() )
			<div class="col-sm-12">
				<form action="/proyecto/delete/{{$proyecto->id}}" method="POST">
					{{ csrf_field() }}
					<div class="mx-5 alert alert-danger">
						<h3 class="alert-heading text-center">Eliminar Permanentemente el Proyecto.</h3>
						<hr>
						<div class="input-group p-3 rounded my-2 mx-5">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<input name="aceptar" type="checkbox" required value="true">
									<span class="input-group-text" style="font-size: 18px;">Acepto borrar este proyecto y todos los datos relacionados con este.</span>
								</div>
							</div>
							<div class="input-group-append ml-5">
								<button class="btn btn-outline-danger h-100" type="submit">Borrar.</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			@endif
			<div class="col-sm-12 text-center my-3">
				<a target="_blank" class="btn btn-outline-info btn-lg" href="{{ route('dev.proyecto', $proyecto->id) }}">Pagina de desarrollo de este proyecto.</a>
			</div>
			<div class="col-sm-12">
				@php
				switch($proyecto->proyect_type){
					case 0:
					@endphp
					<div class="col-sm-12 center-text">
						<h3>Dossier.</h3>
						Detalles del proyecto:
					</div>
					@include('proyecto.proyectoDossier', ['proyecto' => $proyecto->encontrar()])
					@php
					break;
					case 1:
					@endphp
					<div class="col-sm-12 center-text">
						<h3>Administracion De Redes Sociales</h3>
						Detalles del proyecto:
					</div>
					@include('proyecto.proyectoAdmSN', ['proyecto' => $proyecto->encontrar()])
					@php
					break;
					case 2:
					@endphp 
					<div class="row my-2">
						<div class="col-sm-12">
							<h3 class="text-dark text-center">Descripcion</h3> 
						</div>
						<div class="col-sm-8 mx-auto">
							<div class="p-2 m-2 border rounded border-secondary bg-light">
								{{$proyecto->encontrar()->descripcion }}
							</div>
						</div>
					</div>
					@php
					break;
					default:
					@endphp
					Error al guardar el proyecto
					@php
					break;
				}
				@endphp
			</div>
			<div class="col-sm-12 my-2">
				@if( Auth::user()->isAdmin() and ! $proyecto->isCustom() )
				<p><a class="btn btn-outline-secondary" href=" {{ route('user', $proyecto->encontrar()->user->id ) }}">{{ $proyecto->encontrar()->user->name }}</a></p>
				@endif
			</div>
		</div>
	</div>