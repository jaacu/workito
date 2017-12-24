@extends('layouts.app')

@section('content')
@include('debug')
@forelse( $devs as $dev)
@if( $loop->first)
<div class="form-group">
	<form action="/proyecto/edit/{{ $proyecto->id }}" method="post">
		@if( $errors->has('name') )
		@foreach($errors->get('name') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif
		<h3>Edita el proyecto {{ $proyecto->nombre}}</h3>
		<p>Nombre del proyecto: </p>
		<input class="form-control" type="text" required="required" autofocus="autofocus" name="name" value="{{ $proyecto->nombre }}" >

		@if( $errors->has('fecha_limite') )
		@foreach($errors->get('fecha_limite') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif
		
		
		<p>Fecha limite (Opcional): </p>
		<input class="form-control" type="date" name="fecha_limite" value="@if( $proyecto->fecha_limite ){{ $proyecto->fecha_limite }} @else {{ old('fecha_limite') }}@endif ">
		
		{{-- @if( $errors->has('restante') )
		@foreach($errors->get('restante') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif

		<p>Tiempo restante (Opcional): </p>
		<input class="form-control" type="time" name="restante" value="@if( $proyecto->restante ){{ $proyecto->restante }} @else {{ old('restante') }}@endif "> --}}

		@if( $errors->has('dev') )
		@foreach($errors->get('dev') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif

		<h3>Desarrolladores registrados:</h3>
		<select name="dev[]" class="selectpicker" multiple="multiple" title="Desarrolladores..." data-live-search="true" data-selected-text-format="count > 3" data-size="7" data-actions-box="true" data-header="Selecciona 1 o mas desarrolladores.">
			@endif
			<option value="{{$dev->id}}" data-tokens="{{ $dev->name }}" @if( $proyecto->hasDev($dev->id) ) selected="selected" @endif>{{ $dev->name}}</option>
			@if( $loop->last)	
		</select> 
		{{ csrf_field() }}
		<input type="hidden" name="id" value="0">
		<input type="hidden" name="type" value="0">
		<input type="submit" value="Guardar">
	</form>
</div>
@endif
@empty
<p>Parece que no hay desarrolladores registrados.</p>
<p><a href="/admin/users">Ir a usuarios registrados.</a></p>
<p><a href="/home">Volver a la pagina principal.</a></p>
@endforelse


@endsection