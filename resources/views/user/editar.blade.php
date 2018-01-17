@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-3">
		<div class="col-sm-12">
			<h1 class="text-center text-capitalize">Datos:</h1>
		</div>
		<div class="col-sm-12">
			<form action="{{ route('user.edit') }}" method="post">
				{{csrf_field()}}
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="name" class="">Nombre</label>
						<input id="name" type="text" class="form-control @if( $errors->has('name')) is-invalid @endif" name="name" value="{{  Auth::user()->name }}" required autofocus>
						@if ( $errors->has('name') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('name') }}</strong>
						</div>
						@endif
					</div>
				</div>
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="email" class="">Correo Electronico</label>
						<input id="email" type="email" class="form-control @if( $errors->has('email')) is-invalid @endif" name="email" value="{{  Auth::user()->email }}" required>
						@if ( $errors->has('email') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('email') }}</strong>
						</div>
						@endif
					</div>
				</div>
				@unless( Auth::user()->isAdmin())
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="contacto" class="">Contacto</label>
						<input id="contacto" type="text" class="form-control @if( $errors->has('contacto')) is-invalid @endif" name="contacto" value="{{  Auth::user()->contacto }}" required>
						@if ( $errors->has('contacto') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('contacto') }}</strong>
						</div>
						@endif
					</div>
				</div>
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="cuentaSkype" class="">Skype</label>
						<input id="cuentaSkype" type="text" class="form-control @if( $errors->has('cuentaSkype')) is-invalid @endif" name="cuentaSkype" value="{{  Auth::user()->cuentaSkype }}" required>
						@if ( $errors->has('cuentaSkype') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('cuentaSkype') }}</strong>
						</div>
						@endif
					</div>
				</div>
				@endunless
				@if( Auth::user()->isClient() )
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="NIF" class="">NIF</label>
						<input id="NIF" type="text" class="form-control @if( $errors->has('NIF')) is-invalid @endif" name="NIF" value="{{  Auth::user()->NIF }}" required>
						@if ( $errors->has('NIF') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('NIF') }}</strong>
						</div>
						@endif
					</div>
				</div>
				@endif
				<div class=" form-row my-3 ">
					<div class="col-sm-6 mx-auto"> 
						<button class="btn btn-lg btn-primary text-center" type="submit">
							Guardar Cambios
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

@endsection