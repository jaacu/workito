@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-4">		
		<div class="col-sm-12">			
			<div class="alert alert-danger">
				<h3 class="alert-heading">
					<strong>Advertencia!</strong>
				</h3>
				<h6>
					Al momento de editar este usuario tenga en cuenta que si cambia el <strong>estado</strong> o la <strong>contraseña</strong> se perderan todos los datos de proyectos y comentarios relacionados con este usuario. 
				</h6>
				@include('user.conteoMIN')
				<h4><strong>Todos estos datos se perdaran.</strong></h4>
			</div>
			<p><span style="color: red;"></span> </p>
			<form action="{{ route('user.edit.admin', $user->id) }}" method="post">
				{{ csrf_field() }}
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="name" class="">Nombre</label>
						<input id="name" type="text" class="form-control @if( $errors->has('name')) is-invalid @endif" name="name" value="{{ $user->name }}" required autofocus>
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
						<input id="email" type="text" class="form-control @if( $errors->has('email')) is-invalid @endif" name="email" value="{{ $user->email }}"  required>
						@if ( $errors->has('email') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('email') }}</strong>
						</div>
						@endif
					</div>
				</div>

				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="NIF" class="">NIF</label>
						<input id="NIF" type="text" class="form-control @if( $errors->has('NIF')) is-invalid @endif" name="NIF" value="{{ $user->NIF }}"  required>
						@if ( $errors->has('NIF') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('NIF') }}</strong>
						</div>
						@endif
					</div>
				</div>

				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="contacto" class="">Contacto</label>
						<input id="contacto" type="text" class="form-control @if( $errors->has('contacto')) is-invalid @endif" name="contacto" value="{{ $user->contacto }}"  required>
						@if ( $errors->has('contacto') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('contacto') }}</strong>
						</div>
						@endif
					</div>
				</div>

				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="cuentaSkype" class="">Cuenta de Skype</label>
						<input id="cuentaSkype" type="text" class="form-control @if( $errors->has('cuentaSkype')) is-invalid @endif" name="cuentaSkype" value="{{ $user->cuentaSkype }}"  required>
						@if ( $errors->has('cuentaSkype') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('cuentaSkype') }}</strong>
						</div>
						@endif
					</div>
				</div>

				<div class=" form-row ">
					<div class="col-sm-6 mx-auto"> 
						<label for="password" class="">Contraseña</label>
						<input id="password" type="text" class="form-control @if( $errors->has('password')) is-invalid @endif" name="password" value="{{ old('password') }}">
						@if ( $errors->has('password') )
						<div class="invalid-feedback">
							<strong> {{ $errors->first('password') }}</strong>
						</div>
						@endif
					</div>
				</div>
				
				<div class=" form-row ">
					<div class="col-sm-6 mx-auto">
						<p>Estado actual: 
							@if( $user->isDeveloper())
							Desarrollador.
							@endif

							@if( $user->isClient())
							Cliente.
							@endif
						</p> 
						<label for="role" class="">Nuevo estado</label>
						<select id="role" class="form-control" name="role" required>
							<option value="1" @if($user->isDeveloper() ) selected @endif> Desarrollador. </option>
							<option value="2" @if($user->isClient() ) selected @endif> Cliente. </option>
							<option value="0"> Admin. </option>
						</select>
					</div>
				</div>
				<div class="form-row my-3">
					<div class="col-sm-6 text-right">
						<button type="submit" class=" mr-2 btn btn-primary btn-lg">
							Guardar Cambios
						</button>
					</div>
					<div class="col-sm-6 text-left ">
						<a href="{{ route('user', $user->id) }}" class="btn btn-dark ml-2 btn-lg">Volver al perfil.</a>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

@endsection