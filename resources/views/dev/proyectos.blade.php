@extends('layouts.app')

@section('content')

@forelse( $devs as  $dev)

@if( $loop->first)
@include('debug')
<h3>Proyectos a los que has sido asignado: </h3>
@endif
<div>
	{{-- @include('debug') --}}
	@include('proyecto.proyectoMIN',['proyecto' => $dev->proyect])
	{{-- <p>Nombre del proyecto: {{ $dev->proyect->nombre }} </p>
	<p>Id del proyecto: {{ $dev->proyect->id }}</p>
	<p>Proyecto creado: {{ $dev->proyect->created_at }}</p>
	@if( $dev->proyect->fecha_limite )
	<p>Fecha limite: {{$dev->proyect->fecha_limite}}</p>
	@endif
	<p>Ultima vez que fue modificado: {{ $dev->proyect->updated_at}}</p>
	<p>Tipo de proyecto: 
		@php
		switch($dev->proyect->proyect_type){
			case 0:
			@endphp
			<h3>Dossier.</h3>
			Detalles del proyecto:
			@include('proyecto.proyectoDossier', ['proyecto' => $dev->proyect->encontrarDossier($dev->proyect->proyect_id)])
			@php
			break;
			case 1:
			@endphp
			<h3>Administracion De Redes Sociales</h3>
			Detalles del proyecto:
			@include('proyecto.proyectoAdmSN', ['proyecto' => $dev->proyect->encontrarAdminSN($dev->proyect->proyect_id)])
			@php
			break;
			default:
			@endphp
			@php
			break;
		}
		@endphp
	</p> --}}
</div>
<p><a href="/dev/proyecto/{{ $dev->proyect->id }}">Trabajar en este proyecto.</a></p>
<hr style="border: solid;">
@empty
<div>
	Parece que no tienes ningun proyecto asignado :(
</div>
@endforelse

@endsection