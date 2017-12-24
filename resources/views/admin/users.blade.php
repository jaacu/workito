@extends('layouts.app')

@section('content')
<h3>Todos los usuarios: </h3>

@if( $clients->count() or $devs->count() or $admins->count() )

@if( $admins->count() )
<p>Otros administradores: </p>
@foreach( $admins as $admin)
<p> Nombre del administrador: {{ $admin->name}}</p>
@endforeach
@endif

@if( $devs->count() )
<p>Desarrolladores registrados: </p>
@foreach( $devs as $dev)
{{-- <div class="col-xs-@php echo random_int(1,12); @endphp"> --}}
	<div class="col-xs-4" style="padding:20px;color;white;border-radius:3px;margin:10px">
		<p  > Nombre del desarrollador: {{ $dev->name}}</p>
		<p><a href="/user/{{$dev->id}}">Detalles.</a></p>	
	</div>

	@endforeach
	@endif

	@if( $clients->count() )
	<p>Clientes registrados: </p>
	@foreach( $clients as $client)
	<p> Nombre del cliente: {{ $client->name}}</p>
	<p><a href="/user/{{$client->id}}">Detalles.</a></p>
	@endforeach
	@endif

	@else
	<div>
		Parece que hay usuarios registrados.
	</div>
	@endif
	@endsection