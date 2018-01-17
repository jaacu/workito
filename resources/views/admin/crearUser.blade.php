@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-2">
		<div class="col-sm-12">
			<h3 class="text-center text-primary">
				Creacion de un nuevo usuario.
			</h3>
		</div>
		<div class="col-sm-12">
			<form action="{{ route('user.create.admin') }}" method="POST">
				@include('debug')
				@include('user.crear')
				<div>
					<div class=" form-row ">
						<div class="col-sm-6 mx-auto"> 
							<label for="password" class="">Contraseña</label>
							<input id="password" type="text" class="form-control @if( $errors->has('password')) is-invalid @endif" name="password" required>
							@if ( $errors->has('password') )
							<div class="invalid-feedback">
								<strong> {{ $errors->first('password') }}</strong>
							</div>
							@endif
						</div>
					</div>

					<div class=" form-row ">
						<div class="col-sm-6 mx-auto w-50"> 
							<label for="role" class="">Rol</label>
							<select name="role" id="select" class="selectpicker form-control" required title="Roles" data-header="Selecciona el rol."> 
								<option value="1" > Desarrollador. </option>
								<option value="2" > Cliente. </option>
								<option value="0"> Admin. </option>
							</select>
							@if ( $errors->has('role') )
							<div class="invalid-feedback">
								<strong> {{ $errors->first('role') }}</strong>
							</div>
							@endif
						</div>
					</div>

					<div class="form-row mt-3">
						<div class="col-sm-6 mx-auto">
							<button type="submit" class="btn btn-primary btn-lg">
								Crear
							</button>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
@endsection
