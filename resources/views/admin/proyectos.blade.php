@extends('layouts.app')

@section('content')
<h3>Proyectos registrados: </h3>

@if( $AdmSN->count() or $dossiers->count() or $proyects->count() )
{{-- @if( $proyects->count() )
@foreach( $proyects as $proyecto)
@include('proyecto.proyecto')
Nombre del proyecto: 
<a href="#">Detalles del proyecto del cliente.</a>
<hr style="border:solid;">
@endforeach
@endif
--}}
@if( $AdmSN->count() )
<h3>Proyectos de Administracion De Redes Sociales</h3>
@foreach( $AdmSN as $proyecto)
<p>Nombre del proyecto dado por el cliente: "{{ $proyecto->nombre}}" </p>
@if( $proyecto->encontrar($proyecto->id) )
@include('proyecto.proyectoMIN', [ 'proyecto' => $proyecto->encontrar($proyecto->id)])
@else
<p>Este proyecto no esta asignado a nadie. <a href="/proyecto/asignar/1/{{$proyecto->id}}">Asignar ahora.</a></p>
@endif	
<a href="/proyecto/show/1/{{$proyecto->id}}">Detalles del proyecto del cliente.</a>
<hr style="border:solid;">
@endforeach
@endif

@if( $dossiers->count() )
<h3>Proyectos de Dossier</h3>
@foreach( $dossiers as $proyecto)
<p>Nombre del proyecto dado por el cliente: "{{ $proyecto->Nombre}}" </p>
@if( $proyecto->encontrar($proyecto->id) )
@include('proyecto.proyectoMIN', [ 'proyecto' => $proyecto->encontrar($proyecto->id)])
@else
<p>Este proyecto no esta asignado a nadie. <a href="/proyecto/asignar/0/{{$proyecto->id}}">Asignar ahora.</a></p>
@endif
<a href="/proyecto/show/0/{{$proyecto->id}}">Detalles del proyecto del cliente.</a>
<hr style="border:solid;">
@endforeach
@endif

@else
<div>
	Parece que hay ningun proyecto activo :(
</div>
@endif
@endsection