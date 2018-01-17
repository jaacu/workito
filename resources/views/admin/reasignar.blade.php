@extends('layouts.app')

@section('content')
@include('debug')
<div class="container">
	@forelse( $devs as $dev)
	@if( $loop->first)
	<div class="row my-2">
		<div class="col-sm-12">
			<form action="{{ route('proyecto.edit' , $proyecto->id ) }}" method="post">
				{{ csrf_field() }}
				<div class="form-row my-3 p-2">
					<div class="col-sm-8 text-center mx-auto"> 
						<label for="name" class="">Nombre del proyecto:</label>
						<input id="name" type="text" class="text-center form-control @if( $errors->has('name')) is-invalid @endif" name="name" value="{{ $proyecto->nombre }}" required autofocus>
						@foreach($errors->get('name') as $error)
						<div class="invalid-feedback">
							<strong> {{ $error }}</strong>
						</div>
						@endforeach
					</div>
				</div>

				<div class="form-row my-3 p-2">
					<div class="col-sm-4 text-center mx-auto"> 
						<label for="fecha_limite" class="">Fecha limite:</label>
						<input id="fecha_limite" type="date" class="form-control @if( $errors->has('fecha_limite')) is-invalid @endif" name="fecha_limite" value="{{ $proyecto->fecha_limite }}" required>
						@foreach($errors->get('fecha_limite') as $error)
						<div class="invalid-feedback">
							<strong> {{ $error }}</strong>
						</div>
						@endforeach
					</div>
				</div>
				
				<div class="form-row my-3 p-2">
					<div class="col-sm-8 text-center mx-auto"> 
						<label for="dev" class="">Desarrolladores registrados:</label>
						<select name="dev[]" id="dev" class="selectpicker show-tick form-control @if( $errors->has('dev')) is-invalid @endif" multiple title="Desarrolladores..." data-live-search="true" data-selected-text-format="count > 3" data-size="7" data-actions-box="true" data-header="Selecciona 1 o mas desarrolladores." required>
							@endif
							<option value="{{$dev->id}}" data-tokens="{{ $dev->name }}" @if( $proyecto->hasDev($dev->id) ) selected="selected" @endif>{{ $dev->name}}</option>
							@if( $loop->last)	
						</select>
						@foreach($errors->get('dev') as $error)
						<div class="invalid-feedback">
							<strong> {{ $error }}</strong>
						</div>
						@endforeach
					</div>
				</div> 
				<input type="hidden" name="id" value="{{ $proyecto->id }}">
				<input type="hidden" name="type" value="{{ $proyecto->encontrar()->getType()}} ">
				@if( $proyecto->isCustom())
				<div class="form-row my-3 p-2">
					<div class="col-sm-12 mx-auto text-dark text-center">
						<label for="descripcion" ><h3>Descripcion:</h3></label>
					</div>
					<div class="col-sm-8 mx-auto">
						<textarea name="descripcion" id="descripcion" cols="50" rows="6" class="form-control">{{ $proyecto->encontrar()->descripcion }}</textarea>
					</div>
				</div>
				@endif
				<div class="form-row my-3">
					<div class="col-sm-6 mx-auto text-center">
						<button type="submit" class="btn btn-success btn-lg">
							Guardar Cambios.
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endif
	@empty
	<div class="row my-5">
		<div class="alert alert-warning p-3 rounded col-sm-12 text-center my-3">
			<h4 class="alert-heading">Parece que no hay desarrolladores registrados.</h4>
		</div>
		<div class="mx-auto col-sm-8 p-2 text-center ">
			<div class="p-3">
				<a href="{{ route('admin.users') }}" class="btn btn-lg btn-primary mr-2">Usuarios Registrados.</a>
				<a href="{{ route('home')}}" class="btn btn-lg btn-primary ml-2">Volver a la pagina principal.</a>
			</div>
		</div>
	</div>
	@endforelse
</div>
@endsection