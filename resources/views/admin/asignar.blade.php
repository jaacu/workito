@extends('layouts.app')

@section('content')

@forelse( $devs as $dev)
@if( $loop->first)
<div class="form-group">
	<form action="/proyecto/create" method="post">
		@if( $errors->has('name') )
		@foreach($errors->get('name') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif

		<p>Nombre del proyecto: </p>
		<input class="form-control" type="text" required="required" autofocus="autofocus" name="name" value="{{ old('name') }}" >

		@if( $errors->has('fecha_limite') )
		@foreach($errors->get('fecha_limite') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif

		<p>Fecha limite (Opcional): </p>
		<input class="form-control" type="date" name="fecha_limite" value="{{ old('fecha_limite') }}">

		{{-- @if( $errors->has('restante') )
		@foreach($errors->get('restante') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif

		<p>Tiempo restante (Opcional): </p>
		<input class="form-control" type="time" name="restante" value="{{ old('restante') }}"> --}}

		@if( $errors->has('dev') )
		@foreach($errors->get('dev') as $error)
		<div style="color: red;">{{$error}}</div>
		@endforeach
		@endif
		<h3>Desarrolladores registrados:</h3>
		<select name="dev[]" class="selectpicker show-tick" multiple="multiple" title="Desarrolladores..." data-live-search="true" data-selected-text-format="count > 3" data-size="7" data-actions-box="true" data-header="Selecciona 1 o mas desarrolladores.">
			@endif
			<option value="{{$dev->id}}" data-tokens="{{ $dev->name }}" >{{ $dev->name}}</option>
			@if( $loop->last)	
		</select> 
		{{ csrf_field() }}
		<input class="form-control" type="hidden" name="type" value="{{ $type }}"> 
		<input class="form-control" type="hidden" name="id" value="{{ $proyect_id }}">
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