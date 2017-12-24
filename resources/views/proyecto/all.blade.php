@extends('layouts.app')

@section('content')
<h3>Sus proyectos: </h3>

@if( Auth::user()->adminSocialNetworks->count() or Auth::user()->dossiers->count()  )

@if( Auth::user()->adminSocialNetworks->count() )
<h1>Proyectos de Administracion De Redes Sociales</h1>
@foreach( Auth::user()->adminSocialNetworks as $proyecto)
@include('proyecto.proyectoAdmSN')
<a href="/proyectoAdmSN/editar/{{$proyecto->id}}">Editar Proyecto</a>
@endforeach
@endif

@if( Auth::user()->dossiers->count() )
<h1>Proyectos de Dossier</h1>
@foreach( Auth::user()->dossiers as $proyecto)
@include('proyecto.proyectoDossier')
<a href="/proyectoDossier/editar/{{$proyecto->id}}">Editar Proyecto</a>
@endforeach
@endif

@else
<div>
	Parece que hay ningun proyecto activo :(
</div>
@endif
@endsection