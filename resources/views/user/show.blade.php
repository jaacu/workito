@extends('layouts.app')

@section('content')
<div>
	<p>Editar permisos de este usuario. <a href="/editar/{{$user->id}}">Aqui.</a></p>
	<p><a href="/eliminar/{{$user->id}}">Eliminar este usuario.</a></p>
	@if( $user->isDeveloper() )
	@include('user.dev')
	@endif

	@if( $user->isClient() )	
	@include('user.client')
	@forelse($user->proyectsClient() as $proyecto)
	@if($loop->first)
	<p>Proyectos relacionados con este cliente:</p>
	@endif
	<hr style="border: solid;">
	{{-- @includeWhen( ($proyecto instanceof App\adminSocialNetwork)  ,'proyecto.proyectoAdmSN') --}}
	{{-- @includeWhen( ($proyecto instanceof App\Dossier)  ,'proyecto.proyectoDossier') --}}
	@include('proyecto.proyectoMIN')
	@empty
	<p>No hay ningun proyecto relacionado con este cliente.</p>
	@endforelse

	@if( $user->adminSocialNetworks->count() or $user->dossiers->count()  )

	@if( $user->adminSocialNetworks->count() )
	<h3>Proyectos de Administracion De Redes Sociales</h3>
	@foreach( $user->adminSocialNetworks as $proyecto)
	@if( ! $proyecto->encontrar($proyecto->id))
	@include('proyecto.proyectoAdmSN')
	<a href="/proyectoAdmSN/editar/{{$proyecto->id}}">Editar Proyecto</a>
	<hr style="border: solid;">
	@endif

	@endforeach
	@endif
	
	@if( $user->dossiers->count() )
	<h3>Proyectos de Dossier</h3>
	@foreach( $user->dossiers as $proyecto)
	
	@if( ! $proyecto->encontrar($proyecto->id))
	@include('proyecto.proyectoDossier')
	<a href="/proyectoDossier/editar/{{$proyecto->id}}">Editar Proyecto</a>
	<hr style="border: solid;">
	@endif
	
	@endforeach
	@endif

	@else
	<div>
		Este usuario no ha creado ningun proyecto.
	</div>
	@endif

	@endif	
</div>
@endsection