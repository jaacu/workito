<div>
	@if( $errors->any() )
	@foreach($errors->all() as $error)
	<div style="color: red;">{{$error}}</div>
	@endforeach
	@endif
	
	<p>Nombre del proyecto: {{ $proyecto->nombre }} </p>
	<p>Id del proyecto: {{ $proyecto->id }}</p>
	<p>Proyecto creado: {{ $proyecto->created_at }}</p>
	<p>Creado por el administrador: {{ $proyecto->user->name }}</p>
	@forelse( $proyecto->devs as $dev)

	@if( $loop->first)
	<p>Desarrolladores encargados de este proyecto: </p>
	<ul>
		@endif
		<li>Desarrollador: <a href="/user/{{ $dev->user->id }}"> {{ $dev->user->name }}</a> @if(Auth::user()->isAdmin() ) Tiempo trabajado en este proyecto: @include('dev.trabajado') @endif</li>
		@if( $loop->last)
	</ul>
	@endif
	@empty
	<p>No hay desarrolladores asignados a este proyecto. <a href="/proyecto/reasignar/{{ $proyecto->id }}">Asignar ahora.</a></p>
	@endforelse
	@if( $proyecto->fecha_limite )
	<p>Fecha limite: {{$proyecto->fecha_limite}}</p>
	@endif

	{{-- @if( $proyecto->restante )
	<p>Tiempo restante: {{$proyecto->restante}}</p>
	@endif --}}
	<p>Ultima vez que fue modificado: {{ $proyecto->updated_at}}</p>
	<p><a target="_blank" href="/dev/proyecto/{{$proyecto->id}}">Pagina de desarrollo de este proyecto.</a></p>
	@if( Auth::user()->isAdmin())
	<p><a href="/proyecto/reasignar/{{ $proyecto->id }}">Reasignar este proyecto.</a></p>
	<p><a href="/proyecto/eliminar/{{ $proyecto->id }}">Eliminar este proyecto.</a></p>
	@endif
	<p>Tipo de proyecto: 
		@php
		switch($proyecto->proyect_type){
			case 0:
			@endphp
			<h3>Dossier.</h3>
			Detalles del proyecto:
			@include('proyecto.proyectoDossier', ['proyecto' => $proyecto->encontrarDossier($proyecto->proyect_id)])
			@php
			break;
			case 1:
			@endphp
			<h3>Administracion De Redes Sociales</h3>
			Detalles del proyecto:
			@include('proyecto.proyectoAdmSN', ['proyecto' => $proyecto->encontrarAdminSN($proyecto->proyect_id)])
			@php
			break;
			default:
			@endphp
			echo 'Error al guardar el proyecto.';
			@php
			break;
		}
		// $proyecto->encontrar($proyecto->proyect_type,$proyecto->id);
		@endphp
		@if( Auth::user()->isAdmin())
		<p>Cliente: <a href="/user/{{$proyecto->encontrar($proyecto->proyect_type,$proyecto->proyect_id)->user->id}}">{{ $proyecto->encontrar($proyecto->proyect_type,$proyecto->proyect_id)->user->name }}</a></p>
		@endif
	</p>

</div>